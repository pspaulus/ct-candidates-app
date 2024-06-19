<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TaskService;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index()
    {
        $userId = Auth::id();
        return response()->json($this->taskService->getAllTasks($userId));
    }

    public function show($id)
    {
        $userId = Auth::id();
        return response()->json($this->taskService->getTaskById($id, $userId));
    }

    public function store(Request $request)
    {
        $userId = Auth::id();
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'order' => 'integer',
            'status' => 'in:pending,in progress,completed',
        ]);
        $validated['users_id'] = $userId;

        return response()->json($this->taskService->createTask($validated), 201);
    }

    public function update(Request $request, $id)
    {
        $userId = Auth::id();
        $validated = $request->validate([
            'title' => 'string|max:255',
            'order' => 'integer',
            'status' => 'in:pending,in progress,completed',
        ]);

        return response()->json($this->taskService->updateTask($id, $validated, $userId));
    }

    public function destroy($id)
    {
        $userId = Auth::id();
        $this->taskService->deleteTask($id, $userId);
        return response()->noContent();
    }
}
