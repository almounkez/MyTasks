<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tasks;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



class InfoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $appusers=User::count();
        $apptasks=Tasks::count();
        $appactivity= DB::select('select users.id,users.company,users.name,users.email,ifnull(count(tasks.id),0 ) as cnt from tasks right outer join users on user_id=users.id group by users.id,users.company,users.name,users.email;');

        return view('info',compact('appusers','apptasks','appactivity'));
    }
}
