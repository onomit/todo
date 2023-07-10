<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;
use App\Models\Folder;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(int $id)
    {
        //return "Hello world";
        $folders = Folder::all();
        
        //return view('tasks/index', ['folders' => $folders,]);
        // 選ばれたフォルダを取得する
        $current_folder = Folder::find($id);
        
        // 選ばれたフォルダに紐づくタスクを取得する
        $tasks = Task::where('folder_id', $current_folder->id)->get();

        return view(
            'tasks/index', [
            'folders' => $folders,
            'current_folder_id' => $current_folder->id,
            'tasks' => $tasks,
            ]
        );
    }
    
    /**
     * GET /folders/{id}/tasks/create
     */
    public function showCreateForm(int $id)
    {
        return view(
            'tasks/create', [
            'folder_id' => $id
            ]
        );
    }
    
    /**
     * POST /folders/{id}/tasks/create
     */
    public function create(int $id, CreateTask $request)
    {
        $current_folder = Folder::find($id);

        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;

        $current_folder->tasks()->save($task);

        return redirect()->route(
            'tasks.index', [
            'id' => $current_folder->id,
            ]
        );
    }
    
    /**
     * GET /folders/{id}/tasks/{task_id}/edit
     */
    public function showEditForm(int $id, int $task_id)
    {
        $task = Task::find($task_id);

        return view('tasks/edit', ['task' => $task,]);
    }

    /**
     * GET /folders/{id}/tasks/{task_id}/delete
     */
    public function showDeleteForm(int $id, int $task_id)
    {
        $task = Task::find($task_id);

        return view('tasks/delete', ['task' => $task,]);
    }    

    
    public function edit(int $id, int $task_id, EditTask $request)
    {
        // 1
        $task = Task::find($task_id);

        // 2
        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();

        // 3
        return redirect()->route(
            'tasks.index', [
            'id' => $task->folder_id,
            ]
        );
    }
    
    
    public function delete(int $id, int $task_id)
    {
        // 1
        $task = Task::find($task_id);

        // 2
        $task->delete();

        // 3
        return redirect()->route(
            'tasks.index', [
            'id' => $task->folder_id,
            ]
        );
    }
}
