    <!-- Begin template. -->
<template>
    <!-- Begin page content. -->
<div class="container-fluid">

    <!-- Page heading. -->
    <div class="d-sm-flex align-items-center justify-content-center mb-4">
        <h1 class="mb-0 text-gray-800">Acerca de</h1>
    </div>

        <!-- Data table. -->
    <div class="card">
            <!-- Header data table. -->
        <div class="card-header d-flex">
            <h4><span><i class="fas fa-table"></i>  Visualización de datos</span></h4>
            <button class="btn btn-success btn-sm ml-auto" @click="showNewAboutUsModal"><span><i class="fa fa-plus"></i></span>Agregar Registro</button>
        </div>
            <!-- Content data table. -->
        <div class="card-body">
            <table class="table"> 
                <thead>
                    <tr>
                        <td>Id</td>
                        <td>Nombre</td>
                        <td>Descripcion</td>
                        <td>Tipo</td>
                        <td>Año</td>
                        <td>Imagen</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(aboutus, index) in registers" :key="index">
                        <td>{{aboutus.Id}}</td>
                        <td>{{aboutus.Titulo}}</td>
                        <td>{{aboutus.Contenido}}</td>
                        <td>{{aboutus.Tipo}}</td>
                        <td>{{aboutus.Año}}</td>
                        <td>
                            <img :src="`${$store.state.serverPath}/storage/${aboutus.Portada}`" :alt="aboutus.Titulo" class="table-image">
                        </td>
                        <td>
                            <button class="btn btn-success btn-sm" @click="updateAboutUsRegister(aboutus)"><span class="fa fa-edit"></span></button>
                            <button class="btn btn-danger btn-sm" @click="deleteAboutUsRegister(aboutus)"><span class="fa fa-trash"></span></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
            <!-- End content data table. -->
    </div>
        <!--End data table. -->

        <!-- Content modal create. -->
    <b-modal ref="modalAboutUs" hide-footer size="xl" title="Agregar Nuevo Registro">
        <div class="d-block">
                <!-- Form modal create. -->
            <form v-on:submit.prevent="createRegisterAboutUs">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Titulo:</label>
                        <b-form-input :state="aboutusData.name.length >= 1 && aboutusData.name.length < 50" type="text" class="form-control" id="name" v-model="aboutusData.name" placeholder="Ingresar Titulo"></b-form-input>
                        <div class="invalid-feedback-validation" v-if="errors.name">{{errors.name[0]}}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="description">Descripcion:</label>
                        <b-form-textarea :state="aboutusData.description.length >= 1 && aboutusData.description.length < 1000" type="text" class="form-control" id="description" v-model="aboutusData.description" placeholder="Ingresar Descripcion"></b-form-textarea>                 
                        <div class="invalid-feedback-validation" v-if="errors.description">{{errors.description[0]}}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="type">Tipo:</label>
                        <b-form-select :state="aboutusData.type.length >= 1" v-model="aboutusData.type" :options="options" id="type" multiple :select-size="4"></b-form-select>
                        <div class="invalid-feedback-validation" v-if="errors.type">{{errors.type[0]}}</div>                    
                    </div>
                    <div class="form-group col-md-6">
                        <label for="year">Año:</label>
                        <b-form-input :state="aboutusData.year >= 2020 && aboutusData.year < 2099" type="text" class="form-control" id="year" v-model="aboutusData.year" placeholder="Ingresar Año"></b-form-input>
                        <div class="invalid-feedback-validation" v-if="errors.year">{{errors.year[0]}}</div>                    
                    </div>
                    <div class="form-group col-md-12">
                        <label for="image">Imagen:</label>
                        <div v-if="aboutusData.image.name">
                            <img src="" ref="imageAboutUsDisplay" width="700" height="300">  
                        </div>
                        <input type="file" v-on:change="attachImage" ref="imageAboutUs" class="form-control" id="image"/>
                        <div class="invalid-feedback-validation" v-if="errors.image">{{errors.image[0]}}</div>                    
                    </div>
                </div>
                <hr>
                <div class="text-center">    
                    <button type="button" class="btn btn-default" @click="hideNewAboutUsModal">Cancelar</button>
                    <button type="submit" class="btn btn-success"><span class="fa fa-check"></span>Aceptar</button>
                </div>
            </form> 
                <!-- End form modal create. -->
        </div>
    </b-modal>
        <!-- End modal create. -->
</div>
<!-- End container fluid. -->
</template>
    <!-- End template. -->

    <!-- Begin script. -->
<script>
    
        // Import file aboutUsService that contains functions request routes.
    import * as aboutUsService from '../services/aboutus_service';
        // Begin export default.
    export default {

        name: 'aboutus',

        data(){
            return {
                
                    // Declare HTTP status code.
                HTTP_UNPROCESSABLE_ENTITY : 422,


                    // Declare registers to use to save display data.
                registers: [],

                    // Declare aboutusData to use to save data form.
                aboutusData: {
                    name: '',
                    description: '',
                    type: '',
                    year: '',
                    image: '',
                },

                    // Save default variables for use select component.    
                options: [
                    { value: 'Mission', text: 'Mision' },
                    { value: 'View', text: 'Vision' },
                    { value: 'Value', text: 'Valor' },
                ],

                    // Save errors to response send request.
                errors: {},
                
                    // Declare object save data for update.
                updateAboutUsData: {},
            }
        },

            // Mounted data for registers in datatable.
        mounted() {

                    // Call method function.
                this.loadRegisterAboutUs();
            },

            // Declare methods for use in components.
        methods: {

                // Method for attach image in form.
            attachImage() {
                this.aboutusData.image = this.$refs.imageAboutUs.files[0];
                let reader = new FileReader();
                reader.addEventListener('load', function (){
                    this.$refs.imageAboutUsDisplay.src = reader.result;
                }.bind(this), false);

                reader.readAsDataURL(this.aboutusData.image);
            },

                // Close and clear data in form.
            hideNewAboutUsModal() {
                this.$refs.modalAboutUs.hide();
                this.aboutusData = {
                    name: '',
                    description: '',
                    type: '',
                    year: '',
                    image: '',
                };
            },
            
                // Event open new modal with clean form.
            showNewAboutUsModal() {
                this.$refs.modalAboutUs.show();
            },
            
                // Function use for save data forma to send request.
            createRegisterAboutUs: async function () {
                let formData = new FormData();
                formData.append('name', this.aboutusData.name);
                formData.append('description', this.aboutusData.description);
                formData.append('type', this.aboutusData.type);
                formData.append('year', this.aboutusData.year);
                formData.append('image', this.aboutusData.image);

                try {

                    await aboutUsService.createRegisterAboutUs(formData);
                        // Refresh data in datatalbe.
                    this.loadRegisterAboutUs();
                        // Clean and close form.
                    this.hideNewAboutUsModal();
                        // Open swet alert to indicate success.
                    this.$swal.fire({
                        icon: 'success',
                        title: 'Exito',
                        text: 'El registro ha sido guardado correctamente',
                    });
                    
                } catch (error) {
                    // Validate HTTP response status code.
                switch (error.response.status) {
                        // Error 422 HTTP_
                    case HTTP_UNPROCESSABLE_ENTITY:
                        // Load error validations.
                        this.errors = error.response.data.errors;
                        break;
                    default:
                            // Clean and close form. 
                        this.hideNewAboutUsModal();
                            // Open swet alert to indicate errors.
                        this.$swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Ha ocurrido un error, vuelve a intentarlo en otro momento',
                        });
                        break;
                    }
                }
            },  

                // Funciont use to load and draw data in data table.
            loadRegisterAboutUs: async function() {
                try {
                    const response = await aboutUsService.loadRegisterAboutUs();
                        // Save data in variable.
                    this.registers = response.data.data;
                        // Show swet alert indicate succeso to load data.
                    this.$swal.fire({
                        icon: 'success',
                        title: 'El contenido ha sido cargado',
                        toast: true,
                        position: 'top-end',
                        timer: 3000,
                        timerProgressBar: true,
                        showConfirmButton: false,

                    });

                } catch (error) {
                        // Show swet alert to indicate error.
                    this.$swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'No es posible cargar el contenido en estos momentos',
                    });
                };
            },
                // Function use to delete register select.
            deleteAboutUsRegister: async function(aboutus) {

                    // Open swet dialog for question to delete register.
                this.$swal.fire({
                    icon: 'question',
                    title: `Desea eliminar: ${aboutus.Titulo}?`,
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: `Aceptar`,
                    denyButtonText: `Cancelar`,
                        // Handling response to dialog.
                }).then((result) => {
                            // Response is true delete record.
                    if (result.isConfirmed) {
                            // Call request service.
                        aboutUsService.deleteAboutUsRegister(aboutus.Id);
                            // Capture id register selected.
                        this.registers = this.registers.filter(obj => {
                            return obj.id != aboutus.Id;
                        });
                            // Show swet alert to indicate delete name register.
                        this.$swal.fire({
                            toast: true,
                            showConfirmButton: false,
                            position: 'top-end',  
                            timer: 3000,
                            timerProgressBar: true,
                            icon: 'success',
                            title: `Se ha eliminado correctamente: ${aboutus.Titulo}?`
                        });
                            // Refresh data table.
                        this.loadRegisterAboutUs();
                            // Response is false delete record.
                    } else if (result.isDenied) {
                            // Show swet alert to indicate response false delete register.
                        this.$swal.fire({
                            toast: true,
                            showConfirmButton: false,
                            position: 'top-end',  
                            timer: 3000,
                            timerProgressBar: true,
                            icon: 'warning',
                            title: `Ha cancelado la operacion de eliminar: ${aboutus.Titulo}`
                        });
                    };
                    
                });

            },
            
                // Function use to update dates to register select.
            updateRegisterAboutUs: async function() {
                this.updateRegisterAboutUs = aboutus;
            },
        },
    }
</script>
