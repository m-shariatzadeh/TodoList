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
        <div class="col-md-3 offset-md-4">
            <div class="form-inline">
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" name="taskInput" id="taskInput" placeholder="Enter task">
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-primary" id="btn_Add">Add Task</button>
                    </div>
                </div>
                <todo-list></todo-list>
            </div>
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
                        if ($('#list li#undefined'))
                        {
                            $('#list li#undefined').attr('id',res.data.todo.id)
                        }
                    }).catch(err => {
                        console.log(err)
                    })
                    // console.log(res)
                    taskInput.val('');
                    return false;
                }
            })

            socket.on('AddTask', (task) => {
                $('#list').append(`<li id="${todo_id}">
                    ${task}
                    <button class="btn text-danger" onclick="removeTodo(event)">&times;</button>
                </li>`);
                // console.log(task)
            })

            socket.on('removeTask', (task) => {
                $(`#${task}`).remove();
            })

        });

        function removeTodo(e)
        {
            // console.log(e)
            let task = e.target.parentElement.id;
            socket.emit('removeTask', task);

            axios.delete('/api/todos/' + task).then(res =>{
                // console.log(res.data)
            }).catch(err => {
                console.log(err)
            })
        }
    </script>
@endsection
