<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TodoController extends Controller
{
    public function index()
    {
        $todos = auth()->user()->todos;
        return view('todos.index', with(compact('todos')));
    }

    public function getTodosDT(Request $request)
    {
        $userId = $request->input('user_id');
        $todos = Todo::where('user_id', $userId)->select(['id', 'order', 'completed', 'title'])->get();

        return DataTables::of($todos)
            ->addColumn('order', function ($todo) {
                $orderHtml = '<div class="order-'.$todo->order.' order-cell-'.$todo->id.'">'. $todo->order .'<i class="ri-pencil-line edit-icon" data-todoid="' . $todo->id . '"></i></div>';
                return $orderHtml;

            })
            ->addColumn('completed', function ($todo) {
                return view('todos.checkbox-dt', compact('todo'));
            })
            ->addColumn('title', function ($todo) {
                if ($todo->completed) {
                    $titleHtml = '<div class="completed-title todo-title-'. $todo->id . '">' . $todo->title . '</div>';
                } else {
                    $titleHtml = '<div class="todo-title-'. $todo->id . '">' . $todo->title . '</div>';
                }
                return $titleHtml;
            })
            ->addColumn('action', function ($todo) {
                return view('todos.dt-action', compact('todo'));
            })
            ->rawColumns(['order', 'action', 'title', 'completed'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $order = 1;

        if ($user->todos->max('order')) {
            $order = $user->todos->max('order') + 1;
        }

        Todo::create([
            'title' => $request->get('title'),
            'order' => $order,
            'completed' => false,
            'user_id' => $user->id,
        ]);

        return response()->json(['message' => 'Todo created successfully'], 201);
    }

    public function updateCompleted(Request $request, $id)
    {
        $todo = Todo::findOrFail($id);
        $todo->update([
            'completed' => $request->completed,
        ]);

        return response()->json(['message' => 'Todo updated successfully'], 201);
    }

    public function updateOrder(Request $request, $id)
    {
        $todo = Todo::findOrFail($id);
        $todo->update([
            'order' => $request->order,
        ]);

        return response()->json(['message' => 'Todo updated successfully'], 201);
    }

    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();

        return response()->json(['message' => 'Todo deleted successfully'], 201);
    }
}
