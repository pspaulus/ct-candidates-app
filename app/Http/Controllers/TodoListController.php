<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class TodoListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id(); // Obtener el ID del usuario en sesión

        return Inertia::render('TodoList/Index', [
            'todoListItem' => TodoList::where('user_id', $userId)->with("user:id,name")->latest()->get()
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
        $validated = $request->validate([
            'title' => 'required|string',
            'state' => 'required|boolean'
        ]);
        $request->user()->posts()->create($validated);
        return redirect(route('todolist.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(TodoList $todoList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TodoList $todoList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $userId = Auth::id();
            $idRequest = $request["id"];
            $stateRequest = $request["state"];

            $todoList = TodoList::where('id', $idRequest)
                ->where('user_id', $userId)
                ->first();

            $todoList->update(['state' => $stateRequest]);

            return redirect(route('todolist.index'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $userId = Auth::id();
            $idRequest = $request["id"];

            $todoList = TodoList::where('id', $idRequest)
                ->where('user_id', $userId)
                ->first();

            $todoList->delete();

            return redirect(route('todolist.index'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
