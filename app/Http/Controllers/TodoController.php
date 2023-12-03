<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = $request->query('filter');

        $todosQuery = Todo::where('user_id', auth()->id())->orderBy('order');

        if ($filter === 'completed') {
            $todosQuery->where('completed', true);
        } elseif ($filter === 'pending') {
            $todosQuery->where('completed', false);
        }

        $todos = $todosQuery->get();

        return Inertia::render('Todo', [
            'todos' => $todos,
            'currentFilter' => $filter,
        ]);
    }

    public function completed()
    {
        $todos = Todo::where('user_id', auth()->id())
            ->where('completed', true)
            ->orderBy('order')
            ->get();

        return Inertia::render('Todo', [
            'todos' => $todos,
        ]);
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
        $todo = $request->validate([
            'title' => 'required|string|max:255',
        ]);
        $todo['user_id'] = auth()->id();
        $todo['completed'] = false;
        $todo['order'] = 0;

        Todo::create($todo);

        return redirect('/todos');
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        $todo->update($request->validate([
            'title' => 'required|string|max:255',
            'completed' => 'required|boolean',
            'order' => 'integer',
        ]));

        return redirect('/todos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();

        return redirect('/todos');
    }
}
