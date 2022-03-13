<template>
    <div>
        <div class="row">
            <div class="col" id="todoItems">
                <ul id="list">
                    <li v-for="todo in allTodos" :id="todo.id">
                        {{ todo.name }}
                        <button class="btn text-danger" @click="removeTodo($event)">&times;</button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        data() {
            return {
                allTodos: [],
                task: ''
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
