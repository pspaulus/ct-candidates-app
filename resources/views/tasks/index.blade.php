@extends('layouts.app')

@section('content')
  <h1>Lista de Tareas</h1>

  <form method="POST" action="/tasks" class="d-flex justify-content-between row g-3 align-items-end">
    <div class="form-group col">
      @csrf
      <label for="description">Nueva Tarea</label>
      <input type="text" class="form-control" name="description" style="margin-bottom: 20px;" />
    </div>

    <div class="form-group col-auto">
      <button type="submit" class="btn btn-primary" style="margin-bottom: 20px;">
        Crear Tarea
      </button>
    </div>

    @if($errors->any())
      <div class="alert alert-danger" role="alert" style="margin-top: 20px;">
        @foreach($errors->all() as $error)
          {{ $error }}
        @endforeach
      </div>
    @endif
  </form>

  @foreach($tasks as $task)
    <div class="card @if($task->isCompleted()) border-success @endif" style="margin-bottom: 20px;">
      <div class="card-body d-flex justify-content-between">
        <p class="@if($task->isCompleted()) text-decoration-line-through @endif">
          {{ $task->description }}
          @if($task->isCompleted())
            <span class="badge bg-success" style="margin-left: 10px;">Completo</span>
          @endif
        </p>

        @if(!$task->isCompleted())
          <form action="/tasks/{{ $task->id }}" method="POST">
            @method('PATCH')
            @csrf

            <button class="btn btn-secondary" type="submit"><i class="bi bi-check"></i></button>
          </form>
        @else
          <form action="/tasks/{{ $task->id }}" method="POST">
            @method('DELETE')
            @csrf

            <button class="btn btn-danger" type="submit"><i class="bi bi-x"></i></button>
          </form>
        @endif
      </div>
    </div>
  @endforeach

  
  <div class="d-grid gap-2">
    <a href="/tasks/create" class="btn btn-primary btn-lg btn-block">Nueva Tarea</a>
  </div>

@endsection