<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Notifications\Other as Other;
use App\Models\Admin;
use App\Models\Role;
use App\Models\Categorie;
use App\Models\Path;

use Auth;
use DB;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin.auth:admin');
        $this->middleware('master');
        $this->middleware('masteraccess:Admin.CategoryController');
        $this->per_page = empty(config('settings.config_pagination')) ? 10 : config('settings.config_pagination');
    }

    /**
     * Show the Admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */
    public function index() {
        
        $data = $this->getCategoriesList();        
        return view('admin.pages.category.category_list',compact('data'));
    }

    private function getCategoriesList() {

        DB::statement("SET SQL_MODE=''");//this is the trick use it just before your query
		$sql = "SELECT cp.category_id AS category_id, c1.`status`, c2.created_at, c2.updated_at, GROUP_CONCAT(c2.name ORDER BY cp.level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') AS name, c1.parent_id FROM category_path cp LEFT JOIN categories c1 ON (cp.category_id = c1.category_id) LEFT JOIN categories c2 ON (cp.path_id = c2.category_id)";
		$sql .= " GROUP BY cp.category_id";
		
        $page = !empty($_GET['page']) ? $_GET['page'] : 1 ;
        $size = $this->per_page;
        
        $query = DB::SELECT($sql);
        $collect = collect($query);

        $paginationData = new LengthAwarePaginator(
                                $collect->forPage($page, $size),
                                $collect->count(), 
                                $size, 
                                $page,
                                ['path' => '/admin/category']
                            );
		return $paginationData;
	}

    public function AddCeteroy_Function() {
        return view('admin.pages.category.category_add');
    }

    protected function categoryAddFunction(Request $request) {
        $this->modification('Admin.CategoryController');
        
        $messages = [
            'required'=>'The :attribute field is required'
        ];

        $Validator = Validator::make(
        $request->only('name','parent_id','path','status','category_id'),
            [
                'name'=> 'required|string|max:80',
                'parent_id' => 'nullable|numeric',
                'path' => 'required',
                'status' => 'required|in:0,1',
                // 'category_id' => 'required|exists:categories,category_id',
            ],
            $messages
        );

        if($Validator->fails()){
            $Response = $Validator->messages();
            return redirect(url()->previous())->withErrors($Response)->withInput();   
        }else{
           try{
               if(!empty($request->get('category_id'))) {
                    $exists = Categorie::where('category_id',$request->get('category_id'))->exists();
                    if(!empty($exists)) {
                        $update = Categorie::where('category_id',$request->get('category_id'))->update(array(
                            'name'=>$request->get('name'),
                            'parent_id'=>$request->get('parent_id'),
                            'status'=>$request->get('status')));
                        
                        Path::where('category_id',$request->get('category_id'))->delete();
                        // MySQL Hierarchical Data Closure Table Pattern
                    
                        $level = 0;
                        $query = Path::where('category_id',$request->get('parent_id'))->orderBy('level','asc')->get();
                        
                        foreach ($query as $result) {
                            
                            DB::table('category_path')->insert([
                                'category_id' => $request->get('category_id'),
                                'path_id' => $result['path_id'],
                                'level' => $level,
                            ]);
                            $level++;
                        }
                        DB::table('category_path')->insert([
                            'category_id' => $request->get('category_id'),
                            'path_id' => $request->get('category_id'),
                            'level' => $level,
                        ]);
                        $Response =['success_message'=>'Category update successfully'];
                    } else {
                        $Response =['failure_message'=>'Record doesn\'t exists'];
                    }
               } else {
                    $category = new Categorie([
                        'name' => $request->get('name'),
                        'parent_id' => $request->get('parent_id'),
                        'status' => $request->get('status'),
                    ]);
                    $category->save();
                    $category_id = $category->id;

                    // MySQL Hierarchical Data Closure Table Pattern
                    
                    $level = 0;
                    $query = Path::where('category_id',$request->get('parent_id'))->orderBy('level','asc')->get();
                    
                    foreach ($query as $result) {
                        
                        DB::table('category_path')->insert([
                            'category_id' => $category_id,
                            'path_id' => $result['path_id'],
                            'level' => $level,
                        ]);
                        $level++;
                    }
                    DB::table('category_path')->insert([
                        'category_id' => $category_id,
                        'path_id' => $category_id,
                        'level' => $level,
                    ]);

                    $Response =['success_message'=>'Category added successfully'];
                }
                return redirect(route('admin.category'))->withErrors($Response)->withInput();

            } catch (\Exception $e) {

                $Response =['error_message'=>$e->getMessage()];
                return redirect(url()->previous())->withErrors($Response)->withInput();   
            }
        }

        
    }

    public function editCategoryFunction($id)
    {
        $data = $this->getEditRecord($id);
        
        return view('admin.pages.category.category_edit',compact('data'));
    }

    private function getEditRecord($id) {
        $sql = "SELECT cp.category_id AS category_id, c1.status, c1.name AS name1, GROUP_CONCAT(c2.name ORDER BY cp.level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') AS name, c1.parent_id FROM category_path cp LEFT JOIN categories c1 ON (cp.category_id = c1.category_id) LEFT JOIN categories c2 ON (cp.path_id = c2.category_id)";
		$sql .= " WHERE c1.category_id = '" . $id . "'";
		$sql .= " GROUP BY cp.category_id";        
        DB::statement("SET SQL_MODE=''");//this is the trick use it just before your query
		$query = DB::SELECT($sql);

		return $query;
    }

    protected function CatgoryAutocomplete(Request $request){
        $json = array();
        
		if (isset($request->filter_name)) {
			$filter_data = array(
				'filter_name' => $request->filter_name,
				'sort'        => 'name',
				'order'       => 'ASC',
				'start'       => 0,
				'limit'       => 5
			);

			$results = $this->getCategories($filter_data);
            if(count($results) > 0) {
                foreach ($results as $result) {
                    $json[] = array(
                        'category_id' => $result->category_id,
                        'name'        => strip_tags(html_entity_decode($result->name, ENT_QUOTES, 'UTF-8'))
                    );
                }
            }
		}

		$sort_order = array();

		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['name'];
		}

		array_multisort($sort_order, SORT_ASC, $json);
        return response()->json($json,200);
    }

    private function getCategories($data = array()) {


		$sql = "SELECT cp.category_id AS category_id, GROUP_CONCAT(c2.name ORDER BY cp.level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') AS name, c1.parent_id FROM category_path cp LEFT JOIN categories c1 ON (cp.category_id = c1.category_id) LEFT JOIN categories c2 ON (cp.path_id = c2.category_id)";
		if (!empty($data['filter_name'])) {
			$sql .= " WHERE c1.name LIKE '%" . $data['filter_name'] . "%'";
		}
		$sql .= " GROUP BY cp.category_id";
		$sort_data = array(
			'name',
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
        
        DB::statement("SET SQL_MODE=''");//this is the trick use it just before your query
		$query = DB::SELECT($sql);

		return $query;
	}

    protected function categoryDeleteFunction(Request $request) {
        $this->modification('Admin.CategoryController');
        $messages = [
            'required'=>'The :attribute field is required'
        ];

        $Validator = Validator::make(
        $request->only('selected'),
            [
                'selected*'=> 'required|exists:categories,category_id',
            ],
            $messages
        );

        if($Validator->fails()){
            $Response = $Validator->messages();
        }else{
           try{
                if(!empty($request->get('selected'))) {
                    foreach($request->get('selected') as $key) {
                        Categorie::where('category_id',$key)->delete();
                        Path::where('category_id',$key)->delete();
                    }
                    $Response =['success_message'=>'Record deleted successfully.'];
                } else {
                    $Response =['failure_message'=>'Please select record to delete'];
                }
               
            } catch (\Exception $e) {
                $Response =['error_message'=>$e->getMessage()];
            }
        }

        return redirect(url()->previous())->withErrors($Response)->withInput();   
    }

    protected function modification($controller) {
        $roleCheck = Role::where('id',Auth::guard('admin')->user()->role->role_id)->select('permission')->first()['permission'];        
        if(strpos($controller,'.')) {
            $controller  = str_replace('.','/',$controller);
        }

        if(!empty($roleCheck) && $roleCheck != 'null' && !empty(json_decode($roleCheck,true)['modify']) && in_array($controller,json_decode($roleCheck,true)['modify'])) {
            return true;
        } else {
            return abort(403, 'Warning! You don\'t have modify permission');
        }   
    }

}
