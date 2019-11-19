<template>
    <div class="container container-task">
        <div class="row">
            <div class="col-md-6">
                <h2>Lista de compañias</h2>
                <table class="table text-center"><!--Creamos una tabla que mostrará todas las tareas-->
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Email</th>
                                <th scope="col">WebSite</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="company in arrayCompanies" :key="company.id"> 
                                <td v-text="company.name"></td>
                                <td v-text="company.email"></td>
                                <td v-text="company.website"></td>
                                <td>
                                   
                                    <button class="btn" @click="loadFieldsUpdate(company)">Modificar</button>
                                    
                                    <button class="btn" @click="deleteCompany(company)">Borrar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input v-model="name" type="text" class="form-control">

                    <label>Email</label>
                    <input v-model="email" type="text" class="form-control">

                    <label>WebSite</label>
                    <input v-model="website" type="text" class="form-control">
                </div>
                <div class="container-buttons">
                    
                    <button v-if="update == 0" @click="saveCompanies()" class="btn btn-success">Añadir</button>
                    
                    <button v-if="update != 0" @click="updateCompanies()" class="btn btn-warning">Actualizar</button>
                    
                    <button v-if="update != 0" @click="clearFields()" class="btn">Atrás</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
      export default {
        data(){
            return{
                name:"", 
                email:"", 
                website:"", 
                update:0, 
                arrayCompanies:[], 
            }
        },
        methods:{
            getCompanies(){
                let me =this;
                let url = '/companies/getAll' /
                axios.get(url).then(function (response) {
                    
                    me.arrayCompanies = response.data;
                })
                .catch(function (error) {
                    
                    console.log(error);
                });
            },
            saveCompanies(){
                let me =this;
                let url = '/companies/save' 
                axios.post(url,{ 
                    'name':this.name,
                    'email':this.email,
                    'website':this.website,
                }).then(function (response) {
                    me.getCompanies();
                    me.clearFields();
                    console.log(this.name+' '+this.email+' '+this.website);
                })
                .catch(function (error) {
                    console.log(error);
                });   
                
            },
            updateCompanies(){
                let me = this;
                axios.put('/companies/update',{
                    'id':this.update,
                    'name':this.name,
                    'email':this.email,
                    'website':this.website,
                }).then(function (response) {
                   me.getCompanies();
                   me.clearFields();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            loadFieldsUpdate(data){ 
                let me =this;
                let url = '/companies/search?id='+this.update;
                axios.get(url).then(function (response) {
                    me.name= response.data.name;
                    me.email= response.data.email;
                    me.website= response.data.website;
                    
                })
                .catch(function (error) {
                    
                    console.log(error);
                }); 
            },
            deleteCompany(data){
                let me =this;
                let company_id = data.id
                if (confirm('¿Seguro que deseas borrar esta compañia?')) {
                    axios.delete('/companies/delete/'+company_id
                    ).then(function (response) {
                        me.getCompanies();
                    })
                    .catch(function (error) {
                        console.log(error);
                    }); 
                }
            },
            clearFields(){
                this.name = "";
                this.email = "";
                this.website = "";
                this.update = 0;
            }
        },
        mounted() {
           this.getCompanies();
        }
    }
</script>
