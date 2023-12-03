<input
    class="form-check-input form-check-sm statusCheckbox"
    type="checkbox"
    value="{{ $todo->completed }}"
    data-todoid="{{ $todo->id }}" {{ $todo->completed == 1 ? 'checked' : '' }}
    style="transform: scale(1.25);"
>
