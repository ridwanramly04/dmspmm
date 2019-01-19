<template>
    <div>
        <h1>Staffs</h1>
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
                        <tr v-for="staff in staffss" v-bind:key="staff.id">
                            <td>{{staff.id}}</td>
                            <td>{{staff.name}}</td>
                            <td>{{staff.email}}</td>
                            <td>
                                <button class="btn btn-warning" @click="show(staff.id)" >
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-danger" @click="destroy(staff.id)">
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
                            <input type="text" class="form-control" v-model="staff.name" required>
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" class="form-control" v-model="staff.email" required>
                        </div>
                         <div class="form-group" v-show="!edit">
                            <label for="">Password</label>
                            <input type="password" class="form-control" v-model="staff.password" required>
                        </div>
                        <button v-show="!edit" class="btn btn-primary btn-block" @click="add()">Add</button>
                        <button v-show="edit" class="btn btn-primary btn-block" @click="update(staff.id)">Save</button>
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
        'staffs'
    ],
    data: function(){
        return {
            staff: {},
            staffss: this.staffs,
            message: '',
            edit: false
        }
    },
    methods:{
        add: function(){
            let form = new FormData();
            form.append('name', this.staff.name)
            form.append('email', this.staff.email)
            form.append('password', this.staff.password)

            axios.post('/manager/staff', form).then((data) => {
                this.lists()
                this.message = 'Staff successfully added'
                this.staff = {}
            })
        },
        lists: function(){
            axios.get('/manager/staff').then((data) => {
                this.staffss = data.data.message
            })
        },
        show: function(id)
        {
            axios.get('/manager/staff/'+id).then((data) => {
                this.staff = data.data.message
                this.edit = true
                this.message = ''
            })
        },
        update: function(id){
            let form = new FormData();
            form.append('_method', 'patch')
            form.append('name', this.staff.name)
            form.append('email', this.staff.email)
            form.append('password', this.staff.password)

            axios.post('/manager/staff/up/'+id, form).then((data) => {
                this.staffss = ''
                this.lists()
                this.message = 'Staff updated added'
                this.staff = {}
            })
        },
        cancel: function()
        {
            this.message = ''
            this.edit = false
            this.staff = {}
        },
        destroy: function(id){
            var form = new FormData()
            form.append('_method', 'delete')

            axios.post('/manager/staff/destroy/'+id).then((data) => {
                this.staffss = ''
                this.lists()
                this.message = 'Staff successfully deleted'
            });
        }
    }
}
</script>

