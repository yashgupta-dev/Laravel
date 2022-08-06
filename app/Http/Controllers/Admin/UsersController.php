<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;

use App\Models\User;
use Auth;
use App\Notifications\Other as Other;

class UsersController extends Controller
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
        $this->middleware('masteraccess:Admin.UsersController');
        $this->per_page = empty(config('settings.config_pagination')) ? 10 : config('settings.config_pagination');
    }

    /**
     * Show the Admin Users.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function clientsTable(){
        $client = $this->_getClientsRecord();
        return view('admin.pages.clients',compact('client'));
    }
    private function _getClientsRecord(){
        return User::paginate($this->per_page);
    }

}
