<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->get();
        return response()->json($tasks);
    }

    public function store(Request $request)
    {
        // Obtener el último valor de orderTask y sumar 1
        $lastOrderTask = Task::max('orderTask') ?? 0;
        $newOrderTask = $lastOrderTask + 1;

        // Crear la tarea con el nuevo valor de orderTask
        $task = Task::create([
            'title' => $request->input('title'),
            'orderTask' => $newOrderTask,
            'fulfilled' => $request->input('fulfilled', false),
            'user_id' => Auth::id(),
        ]);

        return response()->json($task, 201);
    }

    public function show(Task $task)
    {
        return response()->json($task);
    }

    public function update(Request $request, Task $task)
    {
        $task->update([
            'title' => $request->input('title'),
            'fulfilled' => $request->input('fulfilled', $task->fulfilled),
        ]);

        return response()->json($task);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(null, 204);
    }

    public function complete(Task $task)
    {
        $task->update(['fulfilled' => true]);

        return response()->json($task);
    }
}
