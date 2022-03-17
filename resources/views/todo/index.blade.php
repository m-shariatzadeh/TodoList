@extends('layouts.master')

@section('style')
    <style>
        #task{
            border: 1px inset gray;
        }
    </style>
@endsection
@section('content')
    <div class="row mx-0 mt-lg-5"  id="app">
        <div class="col">
            <div class="form-inline">
                <div class="row">
                    <div class="col-md-4 offset-md-3">
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" name="taskInput" id="taskInput" placeholder="Enter task">
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-primary" id="btn_Add">Add Task</button>
                            </div>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success text-center mb-0 mt-4">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @can('task-assign')
                <todo-list assign="{{ true }}"></todo-list>
            @else
                <todo-list assign="{{ false }}"></todo-list>
            @endcan
        </div>
    </div>
@endsection

@section('script')

    <script>
        let ip_address = '127.0.0.1';
        let port = '3000';
        let socket = io(ip_address + ':' + port);

        $(function (){

            let taskInput = $('#taskInput');
            let btn_add = $('#btn_Add');
            let todo_id;

            btn_add.click(async function () {

                if (!taskInput.val() == "") {
                    let todo_name = taskInput.val();

                    socket.emit('receiveTask', todo_name);
                    axios.post('/api/todos', {'task': todo_name}).then(res => {
                        // console.log($('#list li').id);
                        if ($('#list tr td#undefined'))
                        {
                            $('#list tr td#undefined').attr('id',res.data.todo.id)
                        }
                        if ($("[href='api/todos/undefined/edit']"))
                        {
                            $("[href='api/todos/undefined/edit']").attr('href',`api/todos/${res.data.todo.id}/edit`)
                        }
                    }).catch(err => {
                        console.log(err)
                    })

                    taskInput.val('');
                    return false;
                }
            })

            socket.on('AddTask', (task) => {
                $('#list').append(`<tr>
                <td> ${task} </td>
                <td id="${todo_id}">
                    <button class="btn btn-danger" onclick="removeTodo(event)">Delete</button>
                @if (\Illuminate\Support\Facades\Gate::allows('task-assign',auth()->user()))
                    <a class="btn btn-warning" href="api/todos/undefined/edit">Assign Todo</a>
                @endif
                </td></tr>`);
                // console.log(task)
            })

            socket.on('removeTask', (task) => {
                $(`#${task}`).parent().remove();
            })

        });

        function removeTodo(e)
        {
            // console.log(e)
            let task = e.target.parentElement.id;
            socket.emit('removeTask', task);

            axios.delete('/api/todos/' + task).then(res =>{
                console.log(res.data)
            }).catch(err => {
                console.log(err)
            })
        }
    </script>
@endsection
