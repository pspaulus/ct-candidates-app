<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Task;
use App\Models\TaskUser;

class TaskController extends Controller
{
    public function getTasks()
    {
        try {
            $id_user = Auth::user()->id;
            $tasks = TaskUser::select(
                'tasks.id_task',
                'tasks.title',
                'tasks.order',
                'tasks.status',
            )
            ->where('id_user',$id_user)
            ->join('tasks','task_users.id_task','tasks.id_task')
            ->get();
            return response()->json([
                'data'=>$tasks
            ], 201);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json([
                'message'=>$e->getMessage()
            ], 400);
        }
    }
    public function getSingleTask($id)
    {
        try {
            $task = Task::find($id);
            return response()->json([
                'data'=>$task
            ], 201);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json([
                'message'=>$e->getMessage()
            ], 400);
        }
    }
    public function deleteTask($id){
        try {
            $task = Task::findOrFail($id);
            $task->delete();
            return response()->json(['ok'=>true,'message' => 'Task deleted successfully']);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json([
                'message'=>$e->getMessage()
            ], 400);
        }
    }
    public function updateTask(Request $request, $id){
        try {
            $task = Task::find($id);
            if (!$task) {
                return response()->json(['message' => 'Task not found'], 404);
            }
            if(isset($request->status)){
                $task->status = $request->status;
            }
            if(isset($request->order)){
                $task->order = $request->order;
            }
            if(isset($request->title)){
                $task->title = $request->title;
            }
            $task->save();

            return response()->json(['message' => 'Task updated successfully', 'task' => $task], 200);
            
        }catch (\Exception $e) {
            Log::error($e);
            return response()->json([
                'message'=>$e->getMessage()
            ], 400);
        }
    }
    public function addTask(Request $request){
        try {
            $id_user = Auth::user()->id;
            $task = Task::create([
                'title'=>$request->task,
                'order'=>0,
                'status'=>0,
            ]);

            Log::info($task);

            TaskUser::create([
                'id_user'=>$id_user,
                'id_task'=>$task->id_task,
            ]);
            return response()->json([
                'ok'=>true
            ], 201);

        }  catch (\Exception $e) {
            Log::error($e);
            return response()->json([
                'message'=>$e->getMessage()
            ], 400);
        }
    }
}
