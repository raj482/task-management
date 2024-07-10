<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Jobs\TaskCreateNotify;
use App\Jobs\TaskUpdateNotify;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('status', 'pending')->get();
        return TaskResource::collection($tasks);
    }
    public function store(StoreTaskRequest $request)
    {
        $validated = $request->validated();
        if($request->input('task_id')){
            Task::where('id', $request->input('task_id'))->update($validated);
            $task = Task::find($request->input('task_id'));
            TaskUpdateNotify::dispatch($task)->afterCommit();
            return response()->json(['status' => true, 'message' => 'updated successfully']);
        }else{
            $task = Task::create($validated);
            TaskCreateNotify::dispatch($task)->afterCommit();
            return new TaskResource($task);
        }  
    }
    public function show($id)
    {
        $task = Task::find($id);
        return new TaskResource($task);
    }

    public function changeStatus($id)
    {
        Task::where('id',$id)->update(['status' => 'completed']);
        return response()->json(['sucess' => true, 'message' => 'Changed successfull']);
    }

    public function destroy(Request $request)
    {
        $task = Task::find($request->input('id'));
        $task->delete();
        return response()->json(['sucess' => true, 'message' => 'delete successfull']);
    }
}
