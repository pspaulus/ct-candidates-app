<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class ApiTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userId = auth()->id();
        if ($request->has('title')) {
            $tasks = Task::where('title', 'like', '%' . $request->title . '%')
            ->where('usercreate', $userId)                 
            ->get();
        } else {
            $tasks = Task::where('usercreate', $userId)->get();
        }
        return response()->json($tasks);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $task = Task::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Task Created successful',
            'task' => $task
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validatedData = $request->validate([
            'completed' => 'required|boolean',
        ]);
    
        // Actualizar solo el campo completed
        $task->completed = $validatedData['completed'];
        $task->save();
    
        // Devolver una respuesta JSON
        return response()->json([
            'message' => 'Task updated successfully',
            'task' => $task
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = Task::find($id);

        if ($task) {
            $task->delete();
            return response()->json(['message' => 'Task deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Task not found'], 404);
        }
        
    }
}
