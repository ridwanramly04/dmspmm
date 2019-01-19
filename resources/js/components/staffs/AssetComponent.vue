<template>
    <div class="row">
        <div class="col-md-12">

        </div>
        <div class="col-md-12">
            <br><br>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                     <tr v-for="repor in assets" v-bind:key="repor.id">
                        <td>
                            <input type="text" class="form-control" v-model="repor.name">
                        </td>
                        <td>
                            <input type="text" class="form-control" v-model="repor.price">
                        </td>
                        <td>
                             <button class="btn btn-warning" @click="edit(repor.id)" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-danger" @click="destroy(repor.id)" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" class="form-control" v-model="asset.name">
                        </td>
                        <td>
                            <input type="text" class="form-control" v-model="asset.price">
                        </td>
                        <td>
                            <button class="btn btn-warning" @click="add(report)" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fas fa-plus-square"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    props:[
        'report',
        'ass'
    ],
    data: function(){
        return {
            assets: this.ass,
            asset: {}
        }
    },
    mounted(){
        console.log(this.ass)
    },
    methods: {
        add: function(id) {
            let form = new FormData

            form.append('name',this.asset.name);
            form.append('price', this.asset.price);

            axios.post('/staff/report/asset/add/'+id, form).then((data) => {
                this.lists(id)
            })
        },
        lists: function(id){

            axios.get('/staff/report/asset/'+id).then((data) => {
                this.assets = data.data.assets
            })

        },
        destroy: function(id)
        {   
            let form = new FormData

            form.append('_method', 'delete');
            axios.post('/staff/report/asset/delete/'+id, form).then((data)=> {
                this.lists(this.report)
            })
        }
    }
}
</script>
