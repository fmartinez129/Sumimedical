<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Compañias</div>
  
                    <div class="card-body">
                        <datatable :columns="columns" :data="rows"></datatable>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script>
  
    import DatatableFactory from 'vuejs-datatable';
  
    export default {
        components: { DatatableFactory },
        mounted() {
            console.log('Component mounted.')
        },
        data(){
            return {
                columns: [
                      
                        {label: 'Name', field: 'name'},
                        {label: 'Email', field: 'email'},
                        {label: 'WebSite', field: 'website'}
                        
                    ],
                rows: [],
                page: 1,
                per_page: 10,
            }
        },
        methods:{
            getUsers: function() {
                axios.get('/companies/showCompaniesAll').then(function(response){
                    this.rows = response.data;
                }.bind(this));
            }
        },
        created: function(){
            this.getUsers()
        }
    }
</script>