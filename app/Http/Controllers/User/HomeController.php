<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// same all new created controller
use App\Models\Role;
use App\Models\Admin;
use App\Models\User;
use Auth;

use DB;
use App\Models\Hotel;
use App\Models\Country;
use App\Models\Zone;
use App\Models\Customerpartner;
use App\Models\Hotelpermission;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth' => 'verified']);
        $this->middleware('role');
        $this->middleware('access:User.HomeController');
        $this->per_page = empty(config('settings.config_pagination')) ? 10 : config('settings.config_pagination');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        
        return view('user.home');
    }

    protected function MarkAsReadFunction(Request $request){
        try{
            auth()->user()
                ->unreadNotifications
                ->when($request->input('id'), function ($query) use ($request) {
                    return $query->where('id', $request->input('id'));
                })
                ->markAsRead();
        } catch (\Exception $e) {

        }
        return response()->noContent();
    }
}
