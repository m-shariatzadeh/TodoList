<template>
    <div class="col">
        <select name="usersList" class="form-select" v-model="users_id" @change="getUsers()" multiple>
            <option v-for="user in users" :value="user.id" :id="user.id">{{ user.name }}</option>
        </select>
    </div>
</template>

<script>

    export default {
        data() {
            return {
                users: [],
                users_id:[]
            }
        },
        mounted() {
            axios.get('/api/usersList').then(res =>{
                this.users = res.data.users;
            }).catch(err => {
                console.log(err)
            })
        },
        methods:{
            getUsers: function (){
                axios.get('/api/usersList/'+this.users_id).then(res =>{
                    // res.data.user;
                    // console.log(res.data.user)
                    socket.emit('getUsers', res.data.user);
                }).catch(err => {
                    console.log(err)
                })
            }
        }
    }
</script>
