<template>

        <div class="row">
            <div class="col-md-4 offset-md-3" id="todoItems">
                <table class="table table-hover table-striped mt-3 text-center">
                    <thead>
                        <tr>
                            <th>Task</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="list">
                        <tr v-for="todo in allTodos">
                            <td>{{ todo.name }}</td>
                            <td :id="todo.id"><button class="btn btn-danger" @click="removeTodo($event)">Delete</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
</template>

<script>

    export default {
        data() {
            return {
                allTodos: [],
                task: '',
            }
        },
        mounted() {
            this.allTodos = this.getTodo()
        },
        methods:{
            getTodo: function (){
                axios.get('/api/todos').then(res =>{
                    this.allTodos = res.data.todos;
                    // console.log(this.allTodos)
                }).catch(err => {
                    console.log(err)
                })
            },
            removeTodo: function (e){
                this.task = e.target.parentElement.id;
                socket.emit('removeTask', this.task);

                axios.delete('/api/todos/' + this.task).then(res =>{
                    // console.log(res.data)
                }).catch(err => {
                    console.log(err)
                })
            }
        }
    }
</script>
