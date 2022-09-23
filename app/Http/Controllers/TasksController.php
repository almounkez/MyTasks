<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Tasks;
use App\Models\Tasks_List;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoretasksRequest;
use App\Http\Requests\UpdatetasksRequest;

class TasksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {

         $tasks = Tasks_List::where('user_id',Auth::id())->orderBy('task_duedate','desc')->paginate(10);

        $url = route('tasks.index');
        $projects = Tasks::select('project_name')->distinct()->where('user_id', Auth::id())->orderBy('project_name')->pluck('project_name');
        return view('tasks.index', compact('projects', 'url','tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = Tasks::select('project_name')->distinct()->where('user_id', Auth::id())->pluck('project_name');
        return view('tasks.crud', compact('projects'));
    }
    public function show()
    {

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoretasksRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoretasksRequest $request)
    {
        $data= $request->validated();
        // dd($data, $request);
        $data = array_merge($data, ['user_id' => Auth::id()]);
        if($request->has('task_finished')){
            $data=array_merge($data,['task_finished'=>1]);
        }
        else{
            $data = array_merge($data, ['task_finished' => 0]);
        }
        Tasks::create($data);
        return back()->with('success', 'Task created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tasks  $tasks
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function edit(Tasks $task)
    {

        $projects = Tasks::select('project_name')->distinct()->where('user_id', Auth::id())->pluck('project_name');

        return view('tasks.crud', compact('task', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatetasksRequest  $request
     * @param  \App\Models\Tasks  $task
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatetasksRequest $request, Tasks $task)
    {
        $data = $request->validated();
        // dd($data, $request);
        if ($request->has('task_finished')) {
            $data = array_merge($data, ['task_finished' => 1]);
        } else {
            $data = array_merge($data, ['task_finished' => 0]);
        }
        $task->update($request->validated());

        return back()->with('success', 'Task Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tasks  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tasks $task)
    {

        $task->delete();
        return back()->with('success', 'Task deleted successfully');
    }
    public function unfinished(Request $request)
    {

            $tasks =
            Tasks_List::where('user_id', Auth::id())
            ->where('task_finished', false)->paginate(10);



        $url = route('tasks.unfinished');
        $projects = Tasks::select('project_name')->distinct()->where('user_id', Auth::id())->pluck('project_name');
        return view('tasks.index', compact('projects', 'url','tasks'));
    }
    public function byproject(Request $request, $project)
    {

            $tasks = Tasks_List::where('user_id', Auth::id())->where('project_name', $project)->paginate(10);

        $url = route('tasks.byproject', $project);
        $projects = Tasks::select('project_name')->distinct()->where('user_id', Auth::id())->pluck('project_name');

        return view('tasks.index', compact('projects', 'url','tasks'));
    }

    public function finished(Request $request)
    {

            $tasks = Tasks_List::where('user_id', Auth::id())->where('task_finished', true)->paginate(10);


        $url=route('tasks.finished');
        $projects = Tasks::select('project_name')->distinct()->where('user_id', Auth::id())->pluck('project_name');
        return view('tasks.index', compact('projects','url','tasks'));
    }


    public function getdata($data)
    {
        return DataTables::of($data)
            ->addColumn('action', function ($row) {
                $btn = '<div class="btn-group shadow-0" role="group">
                                <a class="btn rounded-end rounded-start btn-outline-warning mx-1 px-3 btn-edit" href="' . route('tasks.edit', $row->id) . '" data-rowid="' . $row->id . '">
                                    <i class="zmdi zmdi-edit"></i>
                                </a>
                                <button data-rowid="' . $row->id . '" class="btn rounded-circle btn-outline-danger mx-1  px-3 btn-delete">
                                    <i class="zmdi zmdi-delete"></i>
                                </button>
                            </div>';
                return $btn;
            })
            ->editColumn('task_finished', function ($row) {
                $check = '<div class="form-check">
                          <input type="checkbox" class="form-check-input finish" name="task_finished" value="1" data-rowid="' . $row->id . '"';
                if ($row->task_finished) {
                    $check .= 'checked';
                }

                return $check . '></div>';
            })

            // ->addcolumn('duedays',function($row){

            //     return (date_diff(date_create($row->task_duedate), date_create('now'))->days);
            // })
            // ->addcolumn('taskdays', function ($row) {
            // return (date_diff(date_create($row->updated_at), date_create($row->created_at))->days);
            // })
            ->addIndexColumn()
            ->rawColumns(['action', 'task_finished'])->make(true);
    }
    public function setfinished(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
        ]);
        $task = Tasks::findOrfail($request->id);
        $task->task_finished = !$task->task_finished;
        $task->save();
        return ['success' => true, 'message' => __('messages.finished')];
    }


}
