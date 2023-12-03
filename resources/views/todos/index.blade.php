@extends('layouts.app')
@section('css')
    <style>
        table.dataTable tbody > tr {
            border-bottom: 1px solid #ddd;
            vertical-align: middle;
        }

        #todos-table_wrapper > div:first-child > div:first-child {
            display: none;
        }

        #todos-table_wrapper > div:first-child > div:nth-child(2) {
            display: flex;
        }

        #todos-table_wrapper > div:first-child > div:nth-child(2) > div {
            align-self: start;
        }

        table.dataTable tbody th, table.dataTable tbody td {
            padding: 0px 10px;
        }
        .completed-title {
            text-decoration: line-through;
            text-decoration-color: #3498db;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Awesome Todo List</div>
                    <div class="card-body px-5">
                        <form class="form-horizontal mb-3"
                              id="add-form">
                            @csrf
                            <div class="form-group row col-12">
                                <div class="col-sm-10 col-lg-11 pe-0">
                                    <input type="text" class="form-control" id="titleInput" name="title"
                                           placeholder="What do you need to do today?" required>
                                </div>
                                <div class="col-sm-2 col-lg-1">
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                            </div>
                        </form>
                        <table id="todos-table" class="table" style="width: 100% !important;">
                            <thead>
                            <tr>
                                <th>Order</th>
                                <th>Completed</th>
                                <th>Title</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        let csrf_token = $('meta[name="csrf-token"]').attr('content');

        // Datatable
        $(document).ready(function () {
            let userId = {!! auth()->check() ? auth()->user()->id : 'null' !!};
            $('#todos-table').DataTable({
                paging: false,
                info: false,
                order: [[0, "asc"]],
                processing: true,
                serverSide: true,
                ajax: {
                    "type": "GET",
                    "url": "/api/todos",
                    data: {user_id: userId},
                    "error": function (reason) {
                        console.log(reason);
                    }
                },
                columns: [
                    {data: 'order', name: 'order'},
                    {data: 'completed', name: 'completed'},
                    {data: 'title', name: 'title'},
                    {data: 'action', name: 'action', className: 'text-right'}
                ]
            });

            // Add To-do Form
            $('form').submit(function (e) {
                e.preventDefault();
                let formData = $(this).serialize();
                let table = $('#todos-table').DataTable();
                $.ajax({
                    type: 'POST',
                    url: '/todos',
                    data: formData,
                    success: function (data) {
                        table.ajax.reload();
                        $('#titleInput').val('');
                    },
                    error: function (error) {
                        console.log('Error:', error);
                    },
                });
            });

            // Edit to-do status
            $(document).on('change', '.statusCheckbox', function () {
                let todoId = $(this).data('todoid');
                let completed = $(this).is(':checked') ? 1 : 0;

                $.ajax({
                    type: 'PUT',
                    url: '/todos/update-completed/' + todoId,
                    data: {
                        _token: csrf_token,
                        todoId: todoId,
                        completed: completed
                    },
                    success: function (data) {
                        if (completed) {
                            $('.todo-title-' + todoId).addClass('completed-title');
                        } else {
                            $('.todo-title-' + todoId).removeClass('completed-title');
                        }
                    },
                    error: function (error) {
                        console.log('Error updating todo status:', error);
                    }
                });
            });

            // Edit to-do order
            $(document).on('click', '.edit-icon', function () {
                let todoId = $(this).data('todoid');

                let orderValue = $('.order-cell-' + todoId).contents().filter(function() {
                    return this.nodeType === 3; // Filtrar nodos de tipo texto
                }).text().trim();
                $('.order-cell-' + todoId).html('<input type="number" class="edit-order-input form-control" value="' + orderValue + '" data-todoid="'+todoId+'">');

                $('.edit-order-input').focus();
            });

            // Edit to-do order
            $(document).on('blur', '.edit-order-input', function () {
                let table = $('#todos-table').DataTable();
                let newOrderValue = $(this).val();
                let todoId = $(this).data('todoid');

                $.ajax({
                    type: 'PUT',
                    url: '/todos/update-order/'+todoId,
                    data: {
                        _token: csrf_token,
                        order: newOrderValue
                    },
                    success: function (data) {
                        table.ajax.reload();
                    },
                    error: function (error) {
                        console.log('Error updating todo order:', error);
                    }
                });
            });

            // Delete To-do
            $(document).on('click', '.btn-delete', function (e) {
                e.preventDefault();
                let todoId = $(this).closest('form').attr('action').split('/').pop();

                $.ajax({
                    type: 'DELETE',
                    url: '{{ route("todos.destroy", ["id" => ":todoId"]) }}'.replace(':todoId', todoId),
                    data: {
                        _token: csrf_token,
                        todoId: todoId
                    },
                    success: function (data) {
                        $('#todos-table').DataTable().row('.order-cell-' + todoId).remove().draw();
                    },
                    error: function (error) {
                        console.log('Error deleting todo:', error);
                    }
                });
            });
        });
    </script>
@endsection
