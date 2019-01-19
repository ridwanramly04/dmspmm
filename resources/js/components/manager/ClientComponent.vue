<template>
    <div>
        <h1>clients</h1>
        <div class="row">
            <div class="col-md-8">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="client in clientss" v-bind:key="client.id">
                            <td>{{client.id}}</td>
                            <td>{{client.name}}</td>
                            <td>{{client.email}}</td>
                            <td>
                                <button class="btn btn-warning" @click="show(client.id)">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-danger" @click="destroy(client.id)">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <div class="alert alert-success" v-if="message != ''">
                    {{message}}
                </div>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" v-model="client.name" required>
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" class="form-control" v-model="client.email" required>
                        </div>
                        <div class="form-group">
                            <label for="">Company</label>
                            <input type="text" class="form-control" v-model="client.company_name" required>
                        </div>
                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="text" class="form-control" v-model="client.phone" required>
                        </div>
                         <div class="form-group" v-show="!edit">
                            <label for="">Password</label>
                            <input type="password" class="form-control" v-model="client.password" required>
                        </div>
                        <button v-show="!edit" class="btn btn-primary btn-block" @click="add()">Add</button>
                        <button v-show="edit" class="btn btn-primary btn-block" @click="update(client.id)">Save</button>
                        <button v-show="edit" class="btn btn-warning btn-block" @click="cancel()">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
export default {
    props:[
        'roles',
        'clients'
    ],
    data: function(){
        return {
            client: {},
            clientss: this.clients,
            message: '',
            edit: false
        }
    },
    methods:{
        add: function(){
            let form = new FormData();
            form.append('name', this.client.name)
            form.append('email', this.client.email)
            form.append('password', this.client.password)
            form.append('phone', this.client.phone)
            form.append('role_id', 3)
            form.append('company_name', this.client.company_name)
            axios.post('/manager/client', form).then((data) => {
                this.lists()
                this.message = 'client successfully added'
                this.client = {}
            })
        },
        lists: function(){
            axios.get('/manager/client').then((data) => {
                this.clientss = data.data.message
            })
        },
        show: function(id)
        {
            axios.get('/manager/client/'+id).then((data) => {
                this.client = data.data.user
                this.edit = true
                this.message = ''
            })
        },
        update: function(id){
            let form = new FormData();
            form.append('_method', 'patch')
            form.append('name', this.client.name)
            form.append('email', this.client.email)
            form.append('password', this.client.password)
            form.append('phone', this.client.phone)
            form.append('company_name', this.client.company_name)

            axios.post('/manager/client/up/'+id, form).then((data) => {
                this.clientss = ''
                this.lists()
                this.message = 'Client Successfully updated'
                this.client = {}
            })
        },
        cancel: function()
        {
            this.message = ''
            this.edit = false
            this.client = {}
        },
        destroy: function(id){
            var form = new FormData()
            form.append('_method', 'delete')

            axios.post('/manager/staff/destroy/'+id).then((data) => {
                this.clientss = ''
                this.lists()
                this.message = 'client successfully deleted'
            });
        }
    }
}
</script>

