<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Task;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class taskController extends Controller
{
    public function tasks()
    {
        $data = [];
        $task = Task::all();

        if ($task->isEmpty()) {
            $data = [
                'data' => [],
                'message' => 'Tasks not found',
                'status' => 200
            ];
        } else {
            $data = [
                'data' => $task,
                'message' => 'Tasks found',
                'status' => 200
            ];
        }

        return response()->json($data);
    }

    public function task($id)
    {
        $task = Task::find($id);

        if (!$task) {
            $data = [
                'data' => null,
                'message' => 'Task not found',
                'status' => 200
            ];
        } else {
            $data = [
                'data' => $task,
                'message' => 'Task found',
                'status' => 200
            ];
        }

        return response()->json($data);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:75',
            'order' => 'required',
            'status' => 'required|in:pending,progress,completed',
        ]);

        if ($validator->fails()) {
            $data = [
                'data' => null,
                'message' => $validator->errors(),
                'status' => 500
            ];
        } else {
            $task = Task::create([
                'title' => $request->title,
                'order' => $request->order,
                'status' => $request->status
            ]);

            if (!$task) {
                $data = [
                    'data' => null,
                    'message' => 'Error creating a new task',
                    'status' => 500
                ];
            } else {
                $data = [
                    'data' => $task,
                    'message' => 'Task created',
                    'status' => 200
                ];
            }
        }

        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id);

        if (!$task) {
            $data = [
                'data' => null,
                'message' => 'Task not found',
                'status' => 200
            ];
        } else {

            $validator = Validator::make($request->all(), [
                'title' => 'required|max:75',
                'order' => 'required',
                'status' => 'required|in:pending,progress,completed',
            ]);

            if ($validator->fails()) {
                $data = [
                    'data' => null,
                    'message' => $validator->errors(),
                    'status' => 500
                ];
            } else {
                $task->title = $request->title;
                $task->order = $request->order;
                $task->status = $request->status;

                $task->save();

                $data = [
                    'data' => [1],
                    'message' => 'Updated task',
                    'status' => 200
                ];
            }
        }

        return response()->json($data);
    }

    public function delete($id)
    {
        $task = Task::find($id);

        if (!$task) {
            $data = [
                'data' => null,
                'message' => 'Task not found',
                'status' => 200
            ];
        } else {

            $task->delete();

            $data = [
                'data' => [1],
                'message' => 'Task deleted',
                'status' => 200
            ];
        }

        return response()->json($data);
    }
}
