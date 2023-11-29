<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use App\Http\Controllers\Controller;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Filtrar por estado completado o no
        $completed = $request->get('completed');
        $tasks = Tasks::when($completed !== null, function ($query) use ($completed) {
            return $query->where('is_completed', $completed);
        });

        // Ordenar por campo específico (por defecto, por id de forma descendente)
        $sortField = $request->get('sort_field', 'id');
        $sortOrder = $request->get('sort_order', 'desc');
        $tasks->orderBy($sortField, $sortOrder);

        // Obtener las tareas
        $tasks = Tasks::all();

        return response()->json($tasks, 200);
    }




    public function create(Request $request)
    {
        // Validación de los datos recibidos

        $request->validate([
            'name' => 'required|string|max:255',
            'order' => 'required|string',
            'status' => 'required|in:pending,completed',
        ]);

        // Crear una nueva tarea
        $task = Tasks::create([
            'name' => $request->input('name'),
            'status' => $request->input('status'),
            'order' => $request->input('order'),
            'active' => true,
        ]);

        // Devolver la respuesta
        return response()->json($task, 201);
    }


    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $task = Tasks::find($id);

        if (!$task) {
            return response()->json(['error' => 'Tarea no encontrada'], 404);
        }

        return response()->json($task, 200);
    }



    public function edit(Tasks $tasks)
    {
        //
    }
    public function update(Request $request, $id)
    {
        $task = Tasks::findOrFail($id);

        if (!$task) {
            return response()->json(['error' => 'Tarea no encontrada'], 404);
        }

        $request->validate([
            'status' => 'required|in:pending,completed',
        ]);

        $task->update([
            'status' => $request->input('status'),
        ]);

        return response()->json($task, 200);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = Tasks::find($id);

        if (!$task) {
            return response()->json(['message' => 'Tarea no encontrada'], 404);
        }

        $task->update(['active' => false]);

        return response()->json(['message' => 'Tarea marcada como inactiva']);
    }
}
