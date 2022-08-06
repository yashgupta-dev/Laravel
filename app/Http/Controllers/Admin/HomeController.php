<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;

use App\Models\Account;
use App\Models\Addre;
use App\Models\Admin;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Role;

use Auth;
use App\Notifications\Other as Other;
use Illuminate\Auth\Authenticatable;
use DB;

class HomeController extends Controller
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
        $this->middleware('masteraccess:Admin.HomeController');
        $this->per_page = empty(config('settings.config_pagination')) ? 10 : config('settings.config_pagination');
    }

    /**
     * Show the Admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */
    public function index() {
        
        return view('admin.home');
    }

    // read notification function;
    protected function MarkAsReadFunction(Request $request){
        try{
            Auth::guard('admin')->user()
                ->unreadNotifications
                ->when($request->input('id'), function ($query) use ($request) {
                    return $query->where('id', $request->input('id'));
                })
                ->markAsRead();
        } catch (\Exception $e) {

        }
        return response()->noContent();
    }

    // make chart

    protected function makeChartFunction() {
        $json = [];
        
        try {
            $activearray = [];
            $activenew = [];
            $closearray = [];
            $closeenew = [];
            $allnew = [];
            $allarray = [];
            $days = [];
            $urgentArraynew = [];
            $urgentArray = [];
            $normalArrayArraynew = [];
            $normalArray = [];
            $userArray = [];
            $userNewArray = [];
            $accountArray = [];
            $accountNewArray = [];
            $addressArray = [];
            $addressNewArray = [];
            $weekStartDate = \Carbon\Carbon::now()->startOfWeek()->format('Y-m-d H:i:s');
            $weekEndDate = \Carbon\Carbon::now()->endOfWeek()->format('Y-m-d H:i:s');
            $period = \Carbon\CarbonPeriod::create($weekStartDate, $weekEndDate);
            foreach ($period as $key) {
                $days[] = $key->format('D');
            }
            // user daily records;
            $user =   User::select([
                            DB::raw('count(id) as `count`'), 
                            DB::raw('DATE(created_at) as date')
                        ])->groupBy('date')->where('created_at', '>=', \Carbon\Carbon::now()->subWeeks(1))->get();

                        foreach($user as $entry) {
                            $userArray[$entry->date] = $entry->count;
                        }
                        foreach ($period as $date) {
                            if(array_key_exists($date->format('Y-m-d'),$userArray)){
                                $userNewArray[] = $userArray[$date->format('Y-m-d')];
                            } else {
                                $userNewArray[] = 0;
                            }
                        }
            // close
            // user daily records;
            $account =   Account::select([
                            DB::raw('count(id) as `count`'), 
                            DB::raw('DATE(created_at) as date')
                        ])->groupBy('date')->where('created_at', '>=', \Carbon\Carbon::now()->subWeeks(1))->get();

                        foreach($account as $entry) {
                            $accountArray[$entry->date] = $entry->count;
                        }
                        foreach ($period as $date) {
                            if(array_key_exists($date->format('Y-m-d'),$accountArray)){
                                $accountNewArray[] = $accountArray[$date->format('Y-m-d')];
                            } else {
                                $accountNewArray[] = 0;
                            }
                        }
            // close
             // user daily records;
             $address =   Addre::select([
                            DB::raw('count(id) as `count`'), 
                            DB::raw('DATE(created_at) as date')
                        ])->groupBy('date')->where('created_at', '>=', \Carbon\Carbon::now()->subWeeks(1))->get();

                        foreach($address as $entry) {
                            $addressArray[$entry->date] = $entry->count;
                        }
                        foreach ($period as $date) {
                            if(array_key_exists($date->format('Y-m-d'),$addressArray)){
                                $addressNewArray[] = $addressArray[$date->format('Y-m-d')];
                            } else {
                                $addressNewArray[] = 0;
                            }
                        }
            // close
            // active records;
            $active =   Ticket::select([
                            DB::raw('count(id) as `count`'), 
                            DB::raw('DATE(created_at) as date')
                        ])->groupBy('date')->where('status','0')->where('created_at', '>=', \Carbon\Carbon::now()->subWeeks(1))->get();

                        foreach($active as $entry) {
                            $activearray[$entry->date] = $entry->count;
                        }
                        foreach ($period as $date) {
                            if(array_key_exists($date->format('Y-m-d'),$activearray)){
                                $activenew[] = $activearray[$date->format('Y-m-d')];
                            } else {
                                $activenew[] = 0;
                            }
                        }
            // close
            // close records;
            $close =   Ticket::select([
                            DB::raw('count(id) as `count`'), 
                            DB::raw('DATE(updated_at) as date')
                        ])->groupBy('date')->where('status','1')->where('updated_at', '>=', \Carbon\Carbon::now()->subWeeks(1))->get();

                        foreach($close as $entry) {
                            $closearray[$entry->date] = $entry->count;
                        }
                        foreach ($period as $date) {
                            if(array_key_exists($date->format('Y-m-d'),$closearray)){
                                $closeenew[] = $closearray[$date->format('Y-m-d')];
                            } else {
                                $closeenew[] = 0;
                            }
                        }
            // close
            // all records;
            $all =   Ticket::select([
                        DB::raw('count(id) as `count`'), 
                        DB::raw('DATE(created_at) as date')
                    ])->groupBy('date')->where('priority','1')->where('created_at', '>=', \Carbon\Carbon::now()->subWeeks(1))->get();

                    foreach($all as $entry) {
                        $allarray[$entry->date] = $entry->count;
                    }
                    foreach ($period as $date) {
                        if(array_key_exists($date->format('Y-m-d'),$allarray)){
                            $allnew[] = $allarray[$date->format('Y-m-d')];
                        } else {
                            $allnew[] = 0;
                        }
                    }
            // close
            // urgent records;
            $urgent =   Ticket::select([
                        DB::raw('count(id) as `count`'), 
                        DB::raw('DATE(created_at) as date')
                    ])->groupBy('date')->where('priority','2')->where('created_at', '>=', \Carbon\Carbon::now()->subWeeks(1))->get();

                    foreach($urgent as $entry) {
                        $urgentArray[$entry->date] = $entry->count;
                    }
                    foreach ($period as $date) {
                        if(array_key_exists($date->format('Y-m-d'),$urgentArray)){
                            $urgentArraynew[] = $urgentArray[$date->format('Y-m-d')];
                        } else {
                            $urgentArraynew[] = 0;
                        }
                    }
            // close
            // normal records;
            $normal =   Ticket::select([
                            DB::raw('count(id) as `count`'), 
                            DB::raw('DATE(created_at) as date')
                        ])->groupBy('date')->where('priority','0')->where('created_at', '>=', \Carbon\Carbon::now()->subWeeks(1))->get();

                        foreach($normal as $entry) {
                            $normalArray[$entry->date] = $entry->count;
                        }
                        foreach ($period as $date) {
                            if(array_key_exists($date->format('Y-m-d'),$normalArray)){
                                $normalArrayArraynew[] = $normalArray[$date->format('Y-m-d')];
                            } else {
                                $normalArrayArraynew[] = 0;
                            }
                        }
            // close
            
            $json = [
                'status'    => true,
                'user'      => User::whereBetween('created_at', [$weekStartDate, $weekEndDate])->count(),
                'userDaily' => $userNewArray,
                'accountDaily'=> $accountNewArray,
                'addressDaily'=> $addressNewArray,
                'address'   => Addre::whereBetween('created_at', [$weekStartDate, $weekEndDate])->count(),
                'account'   => Account::whereBetween('created_at', [$weekStartDate, $weekEndDate])->count(),
                'tickets'   => [
                    'weekTickets' => Ticket::whereBetween('created_at', [$weekStartDate, $weekEndDate])->count(),
                ],
                'tickets_bar'   => [
                    'days'          => $days,
                    'hightTickets' => $allnew,
                    'urgentTickets' => $urgentArraynew,
                    'normalTickets' => $normalArrayArraynew,
                    'dailyActiveTickets' => $activenew,
                    'dailyCloseTickets' => $closeenew,
                ],
            ];
        } catch (\Exception $e) {
            $json = [
                'status'    => $e->getMessage(),
            ];
        }

        return json_encode($json);

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
