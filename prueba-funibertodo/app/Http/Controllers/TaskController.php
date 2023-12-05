<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Task::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->input();
        $e = Task::create($inputs);
        return response()->json([
            'data' => $e,
            'message' => "Task registered successfully",
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $e = Task::find($id);
        if (isset($e)) {
            return response()->json([
                'data' => $e,
                'message' => "Task found successfully",
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => "The task does not exist",
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $e = Task::find($id);
        if (isset($e)) {
            $e->title = $request->title;
            $e->order = $request->order;
            $e->completed = $request->completed;
            if ($e->save()) {
                return response()->json([
                    'data' => $e,
                    'message' => "Task updated successfully",
                ]);
            } else {
                return response()->json([
                    'error' => true,
                    'message' => "The task was not updated",
                ]);
            }
        } else {
            return response()->json([
                'error' => true,
                'message' => "The task does not exist",
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $e = Task::find($id);
        if (isset($e)) {
            $res = Task::destroy($id);
            if ($res) {
                return response()->json([
                    'data' => $e,
                    'message' => "Task deleted successfully",
                ]);
            } else {
                return response()->json([
                    'data' => $e,
                    'message' => "The task does not exist",
                ]);
            }
        } else {
            return response()->json([
                'error' => true,
                'message' => "The task does not exist",
            ]);
        }
    }
}
