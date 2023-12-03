<div class="d-flex justify-content-end align-items-center gap-1 me-2">
    <form action="{{ route('todos.destroy', $todo->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-transparent text-danger btn-delete">
            <i class="ri-close-circle-line fs-4"></i>
        </button>
    </form>
</div>
