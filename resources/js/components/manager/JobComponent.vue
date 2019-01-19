<template>
    <div>
        <h1>Job/Work Assigment <button class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModal">Add</button></h1>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Dateline</th>
                            <th>Status</th>
                            <th>Assign</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="report in reportss" v-bind:key="report.id">
                            <td>{{report.id}}</td>
                            <td>{{report.title}}</td>
                            <td>{{report.dateline}}</td>
                            <td>{{report.status}}</td>
                            <td>{{report.assign_id}}</td>
                            <td>
                                <button class="btn btn-warning" @click="show(report.id)" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-danger" @click="destroy(report.id)">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!--
                    Modal
                -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Report</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-success" v-if="message != ''">
                            {{message}}
                        </div>
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" class="form-control" v-model="report.title">
                        </div>
                        <div class="form-group">
                            <label for="">Dateline</label>
                            <input type="date" class="form-control" v-model="report.dateline">
                        </div>
                        <div class="form-group">
                            <label for="">Assign To</label>
                            <select class="form-control" v-model="report.assign_id">
                                <option v-for="staff in staffs" v-bind:key="staff.id" v-bind:value="staff.id">{{staff.name}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Client</label>
                            <select class="form-control" v-model="report.client_id">
                                <option v-for="client in clients" v-bind:key="client.id" v-bind:value="client.id">{{client.company_name}}</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button v-show="edit" type="button" class="btn btn-primary" @click="update(report.id)">Save changes</button>
                        <button v-show="!edit" type="button" class="btn btn-primary" @click="add()">Add</button>
                    </div>
                    </div>
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
        'reports',
        'clients',
        'staffs'
    ],
    data: function(){
        return{
            report: {},
            edit:false,
            reportss: this.reports,
            message: ''
        }
    },
    mounted(){
        this.lists()
    },
    methods:{
        add: function()
        {
            let form = new FormData()

            form.append('name', this.report.title)
            form.append('staff', this.report.assign_id)
            form.append('client_id', this.report.client_id)
            form.append('dateline', this.report.dateline)

            axios.post('/manager/report', form).then((data) => {
                this.lists()
                this.message = 'Report successfully added'
            })
        },
        lists: function(){
            axios.get('/manager/report').then((data) => {
                this.reportss = data.data.reports
            })
        },
        show: function(id)
        {
            axios.get('/manager/report/'+id).then((data) => {
                this.report = data.data.report
                this.edit = true
                this.message = ''
            })
        },
        update: function(id){
            let form = new FormData();
            form.append('_method', 'patch')
            form.append('name', this.report.title)
            form.append('staff', this.report.assign_id)
            form.append('client_id', this.report.client_id)
            form.append('dateline', this.report.dateline)

            axios.post('/manager/report/up/'+id, form).then((data) => {
                this.reportss = ''
                this.lists()
                this.message = 'Staff updated added'
                this.report = {}
            })
        },
        cancel: function()
        {
            this.message = ''
            this.edit = false
            this.report = {}
        },
        destroy: function(id){
            var form = new FormData()
            form.append('_method', 'delete')

            axios.post('/manager/report/destroy/'+id).then((data) => {
                this.reportss = ''
                this.lists()
                this.message = 'Staff successfully deleted'
            });
        }
    }
}
</script>
