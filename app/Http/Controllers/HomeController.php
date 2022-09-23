<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use App\Models\Tasks_List;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //     $labelx=Tasks::select(DB::raw('MONTH(created_at) month'))
        // ->where('user_id',Auth::id())
        // ->groupBy( DB::raw('MONTH(created_at)'))
        // ->orderBy('month')
        // ->pluck('month');

        $labelx = DB::select(
            'SELECT seq   FROM seq_1_to_12 LEFT JOIN (select *  FROM tasks_period
        WHERE tyear= year(CURRENT_DATE)  AND  `user_id` = ?    ) pt
        ON seq = pt.tmonth',
            [Auth::id()]
        );
        $collection = collect($labelx);
        $labelx = $collection->pluck('seq');

        $data1 = DB::select(
            'SELECT   cnt  FROM seq_1_to_12
LEFT JOIN (select *  FROM tasks_period
WHERE tyear= year(CURRENT_DATE)  AND  `user_id` = ?    ) pt
ON seq = pt.tmonth',
            [Auth::id()]
        );

        $collection = collect($data1);
        $data1 = $collection->pluck('cnt');

        $data2 = DB::select(
            'SELECT   finished FROM seq_1_to_12
LEFT JOIN (select *  FROM tasks_period
WHERE tyear= year(CURRENT_DATE)  AND  `user_id` = ?    ) pt
ON seq = pt.tmonth',
            [Auth::id()]
        );
        $collection = collect($data2);
        $data2 = $collection->pluck('finished');

        $data3 = DB::select(
            'SELECT  unfinished FROM seq_1_to_12
LEFT JOIN (select *  FROM tasks_period
WHERE tyear= year(CURRENT_DATE)  AND  `user_id` = ?    ) pt
ON seq = pt.tmonth',
            [Auth::id()]
        );
        $collection = collect($data3);
        $data3 = $collection->pluck('unfinished');

        // $data1
        // = Tasks::select(DB::raw('MONTH(created_at) month'), DB::raw('count(id) cnt'))
        // ->where('user_id', Auth::id())
        // ->groupBy(DB::raw('MONTH(created_at)'))
        // ->orderBy('month')
        // ->pluck('cnt');
        // $data2
        // = Tasks::select(DB::raw('MONTH(created_at) month'), DB::raw('count(id) cnt'))
        // ->where('user_id', Auth::id())
        //     ->where('task_finished', true)
        // ->groupBy(DB::raw('MONTH(created_at)'))
        // ->orderBy('month')
        // ->pluck('cnt');
        // $data3
        // = Tasks::select(DB::raw('MONTH(created_at) month'), DB::raw('count(id) cnt'))
        // ->where('user_id', Auth::id())
        //     ->where('task_finished', false)
        // ->groupBy(DB::raw('MONTH(created_at)'))
        // ->orderBy('month')
        // ->pluck('cnt');

        // dd($data1);
        // $labelx
        $projects = Tasks::select('project_name')->distinct()->where('user_id', Auth::id())->pluck('project_name');
        $projsum =
            DB::select('select * from proj_summary where unfinished	 > 0 And user_id = ?', [Auth::id()]);
        $toplates = Tasks_List::where('user_id', Auth::id())->where('duedays', '<>', '0')->orderBy('duedays')->take(10)->get();
        $longtasks = Tasks_List::where('user_id', Auth::id())->where('taskdays', '<>', '0')->orderBy('taskdays', 'DESC')->take(10)->get();

        return view('home', compact('labelx', 'data1', 'data2', 'data3', 'projects', 'projsum', 'toplates', 'longtasks'));
    }
}
