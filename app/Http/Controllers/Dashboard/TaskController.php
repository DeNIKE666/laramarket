<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Gate;
use Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('role-admin')) {
            $tasks = Task::orderBy("id", "desc")->paginate(20);
            return view('dashboard.task.index', compact('tasks'));
        } else {

            $userId = Auth::user()->id;
            $tasks = Task::where('user_id', '=', $userId)->orderBy("id", "desc")->paginate(20);
            return view('dashboard.task.index', compact('tasks'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.task.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);

        $data = [
            'title' => $request['title'],
            //'content' => $request['content'],
            'status' => Task::STATUS_TASK_ACTIVE,
            'user_id' => Auth::user()->id,
        ];

        $task = Task::create($data);

        $dataMessage = [
            'content' => $request['content'],
            'user_id' => Auth::user()->id,
            'task_id' => $task->id
        ];

        Message::create($dataMessage);

        return redirect()->route('tasks.show', $task->id)->with('status', 'Сообщение отправлено');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);
        abort_if(Gate::denies('update-post', $task), 403, 'Sorry, you are not an admin');

        if (Gate::allows('role-admin')) {
            $tasks = Task::orderBy("id", "desc")->paginate(20);
        } else {
            $userId = Auth::user()->id;
            $tasks = Task::where('user_id', '=', $userId)->orderBy("id", "desc")->paginate(20);
        }

        return view('dashboard.task.show', compact('task', 'tasks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'content' => 'required',
        ]);
        $task = Task::findOrFail($id);
        abort_if(Gate::denies('update-post', $task), 403, 'Sorry, you are not an admin');
        $dataMessage = [
            'content' => $request['content'],
            'user_id' => Auth::user()->id,
            'task_id' => $id
        ];
        if (Gate::allows('role-admin')) {
            //если ответ админа
            $task->status = Task::STATUS_TASK_CLOSE;
            $task->save();
        }
        Message::create($dataMessage);

        return redirect()->route('tasks.show', $task->id)->with('status', 'Сообщение отправлено');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
