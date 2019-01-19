<template>
    <div>
        <h1>Reports</h1>
        <div class="row">
            <div class="col-md-12" v-if="!edit">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Dateline</th>
                            <th>Client</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="report in reports" v-bind:key="report.id">
                            <td>{{report.id}}</td>
                            <td>{{report.title}}</td>
                            <td>{{report.status}}</td>
                            <td>{{report.dateline}}</td>
                            <td>{{report.company_name}}</td>
                            <td>
                                <button class="btn btn-warning" @click="show(report.id)" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12 p-3" v-else>
                <div class="card shadow-sm ">
                    <div class="card-header">
                        Reports
                    </div>
                    <div class="card-body">
                        <!-- Asset And Liability -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Asset</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Liability</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                
                                <asset-component v-bind:report="report.id" v-bind:ass="assets"/>

                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <liability-component v-bind:report="report.id" v-bind:ass="assets"/>
                            </div>
                        </div>
                         <!-- End Asset And Liability -->

                         <div class="form-row">
                             <div class="col-12">
                                 <div class="alert alert-success" v-if="updateStatus != ''">{{updateStatus}}</div>
                             </div>
                             <div class="col-8">
                                 <div class="form-group">
                                    <select v-model="report.status" class="form-control">
                                        <option value="pending">Pending</option>
                                        <option value="complete">Complete</option>
                                    </select>
                                </div>
                             </div>
                             <div class="col-4">
                                 <button class="btn btn-outline-primary btn-block" @click="status(report.id)">Update Status</button>
                             </div>
                         </div>

                         <table class="table">
                             <thead class="thead-dark">
                                 <tr>
                                     <th>#</th>
                                     <th>File</th>
                                     <th>Action</th>
                                 </tr>
                             </thead>
                         </table>
                         <div class="form-row">
                             <div class="col-12">
                                 <div class="alert alert-success" v-if="updateMessage != ''">
                                     {{updateMessage}}
                                 </div>
                             </div>
                             <div class="col-8">
                                 <input type="text" class="form-control" placeholder="Message" v-model="report.message">
                             </div>
                            <div class="col-4">
                                <button class="btn btn-primary btn-block" @click="message(report.id)">Update Message</button>
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
import AssetComponent from './AssetComponent';
import LiabilityComponent from './LiabilityComponent';

export default {
    data: function(){
        return {
            edit: false,
            reports: {},
            report: {},
            assets: {},
            updateMessage: '',
            updateStatus: ''
        }
    },
    components:{
        AssetComponent,
        LiabilityComponent
    },
    mounted(){
        this.rep();
    },
    methods:{
        rep: function(){
            axios.get('/staff/report').then((data) => {
                this.reports = data.data.reports
            })
        },
        show: function(id){
            this.edit = true
            axios.get('/staff/report/'+id).then((data) => {
                this.report = data.data.report
                this.assets = data.data.asset
                console.log(data.data.asset)
            })
        },
        message: function(id){
            let form = new FormData()
            form.append('message', this.report.message)

            axios.post('/staff/report/message/'+id, form).then((data) => {
                this.updateMessage = 'Message Update'
            })
        },
        status: function(id){
            let form = new FormData()
            form.append('status', this.report.status)

            axios.post('/staff/report/status/'+id, form).then((data) => {
                this.updateStatus = 'Status Updated'
            })
        }
    }
}
</script>

