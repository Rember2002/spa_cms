    <!-- Begin template. -->
<template>
    <!-- Begin page content. -->
<div class="container-fluid">

    <!-- Page heading. -->
    <div class="d-sm-flex align-items-center justify-content-center mb-4">
        <h1 class="mb-0 text-gray-800">Recursos</h1>
    </div>
    
        <!-- Data table. -->
    <div class="card">
            <!-- Header data table. -->
        <div class="card-body d-flex">
            <h4><span><i class="fas fa-table"></i>  Visualización de datos</span></h4>
            <button class="btn btn-success btn-sm ml-auto" @click="showNewResourceModal"><span><i class="fa fa-plus"></i></span>Agregar Registro</button>
        </div>
            <!-- Content data table. -->
        <div class="card-body table-responsive  align-items-center justify-content-center">
            <table id="tableRegisters" class="table table-hover table-responsive table-bordered">  
                <thead class="table-dark">
                    <tr>
                        <td>Id</td>
                        <td>Nombre</td>
                        <td>Descripcion</td>
                        <td>Portada</td>
                        <td>Documento</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(resource, index) in registers" :key="index">
                        <td>{{resource.Id}}</td>
                        <td>{{resource.Nombre}}</td>
                        <td>{{resource.Descripcion}}</td>
                        <td class="text-center">
                            <a target="_blank" :href="`${$store.state.serverPath}/storage/${resource.Archivo}`"><button class="btn btn-primary">Documento<i class="fas fa-file-download"></i></button></a>
                        </td>
                        <td>
                            <img :src="`${$store.state.serverPath}/storage/${resource.Portada}`" class="cover-page-image">
                        </td>
                        <td>
                            <button class="btn btn-success btn-sm" @click="updateDataResource(resource)"><span class="fa fa-edit"></span></button>
                            <button class="btn btn-danger btn-sm" @click="deleteResourceRegister(resource)"><span class="fa fa-trash"></span></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
            <!-- End content data table. -->
    </div>
        <!--End data table. -->

        <!-- Content modal create. -->
    <b-modal ref="modalCreateResource" hide-footer size="xl" title="Agregar Nuevo Registro">
        <div class="d-block">
                <!-- Form modal create. -->
            <form v-on:submit.prevent="createRegisterResource">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name_resource">Nombre del Recurso:</label>
                        <b-form-input :state="resourceData.Nombre.length >= 1 && resourceData.Nombre.length < 50" type="text" class="form-control" id="name_resource" v-model="resourceData.Nombre" placeholder="Ingresar Nombre del Recurso" autocomplete="off"></b-form-input>
                        <div class="invalid-feedback-validation" v-if="errors.name">{{errors.name[0]}}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="description">Descripcion:</label>
                        <b-form-textarea :state="resourceData.Descripcion.length >= 1 && resourceData.Descripcion.length < 1000" type="text" class="form-control" id="description" v-model="resourceData.Descripcion" placeholder="Ingresar Descripcion" autocomplete="off"></b-form-textarea>                 
                        <div class="invalid-feedback-validation" v-if="errors.description">{{errors.description[0]}}</div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="image">Imagen:</label>
                        <div v-if="resourceData.Portada.name" class="text-center">
                            <img src="" ref="imageResourceDisplay" width="300" height="350">  
                        </div>
                        <input accept="image/png,image/jpeg" type="file" v-on:change="attachImage" ref="imageResource" class="form-control" id="image"/>
                        <div class="invalid-feedback-validation" v-if="errors.image">{{errors.image[0]}}</div>                    
                    </div>
                    <div class="form-group col-md-12">
                        <label for="document">Documento:</label>
                        <input accept="application/pdf" type="file" v-on:change="attachDocument" ref="documentResource" class="form-control" id="document"/>
                        <div class="invalid-feedback-validation" v-if="errors.document">{{errors.document[0]}}</div>                    
                    </div>
                </div>
                <hr>
                <div class="text-center">    
                    <button type="button" class="btn btn-default" @click="hideNewResourceModal">Cancelar</button>
                    <button type="submit" class="btn btn-success"><span class="fa fa-check"></span>Aceptar</button>
                </div>
            </form> 
                <!-- End form modal create. -->
        </div>
    </b-modal>
        <!-- End modal create. -->

        <!-- Content modal update. -->
    <b-modal ref="modalUpdateResource" hide-footer size="xl" title="Modificar Registro">
        <div class="d-block">
                <!-- Form modal update. -->
            <form v-on:submit.prevent="updateRegisterResource">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name_resource">Nombre del Recurso:</label>
                        <b-form-input :state="resourceData.Nombre.length >= 1 && resourceData.Nombre.length < 50" type="text" class="form-control" id="name_resource" v-model="resourceData.Nombre" placeholder="Ingresar Nombre del Recurso" autocomplete="off"></b-form-input>
                        <div class="invalid-feedback-validation" v-if="errors.name">{{errors.name[0]}}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="description">Descripcion:</label>
                        <b-form-textarea :state="resourceData.Descripcion.length >= 1 && resourceData.Descripcion.length < 1000" type="text" class="form-control" id="description" v-model="resourceData.Descripcion" placeholder="Ingresar Descripcion" autocomplete="off"></b-form-textarea>                 
                        <div class="invalid-feedback-validation" v-if="errors.description">{{errors.description[0]}}</div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="image">Imagen:</label>
                        <div class="text-center">
                            <img :src="`${$store.state.serverPath}/storage/${resourceData.Portada}`" ref="updateImageResourceDisplay" width="300" height="350">  
                        </div>
                        <input accept="image/png,image/jpeg" type="file" v-on:change="updateImage" ref="updateImageResource" class="form-control" id="image"/>
                        <div class="invalid-feedback-validation" v-if="errors.image">{{errors.image[0]}}</div>                    
                    </div>
                    <div class="form-group col-md-12">
                        <label for="document">Documento:</label>
                        <input accept="application/pdf" type="file" v-on:change="updateDocument" ref="updateDocumentResource" class="form-control" id="document"/>
                        <div class="invalid-feedback-validation" v-if="errors.document">{{errors.document[0]}}</div>                    
                    </div>
                </div>
                <hr>
                <div class="text-center">    
                    <button type="button" class="btn btn-default" @click="hideUpdateResourceModal">Cancelar</button>
                    <button type="submit" class="btn btn-success"><span class="fa fa-check"></span>Actualizar</button>
                </div>
            </form> 
                <!-- End form modal update. -->
        </div>
    </b-modal>
        <!-- End modal update. -->    

</div>
<!-- End container fluid. -->
</template>
    <!-- End template. -->

<!-- Begin script. -->
<script>

        // Import plugin CloudTables.
    import 'datatables.net-bs4';

        // Impoort jquery to use plugin DataTable.
    import $ from 'jquery';

        // Import file resourceService that contains functions request routes.
    import * as resourceService from '../services/resource_service';
    
        // Begin export default.
    export default {

        name: 'resource',

            // Begin data.
        data(){
            return {
                
                    // Declare registers to use to save display data.
                registers: [],

                    // Declare resourceData to use to send data in form.
                resourceData: {
                    Nombre: '',
                    Descripcion: '',
                    Portada: '',
                    Archivo: '',
                },

                    // Save errors to response send request.
                errors: {},
                
            };
        },
            // End data.

            // Mounted data for registers in datatable.
        mounted() {
                // Call method function to use load data.
            this.loadRegisterResource();
            },
            // End mounted data.

            // Declare methods for use in components.
        methods: {

                // Data tabel plugin initialization.
            loadDataTable(){
                this.$nextTick(() => {
                        // Select id component Table.
                    $(`#tableRegisters`).DataTable({
                        'language': {
                            "lengthMenu": "Mostrar   -_MENU_-   registros",
                            "zeroRecords": "No se encontraron resultados",
                            "emptyTable": "Ningún dato disponible en esta tabla",
                            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                            "search": "Buscar:",
                            "infoThousands": ",",
                            "loadingRecords": "Cargando...",
                            "paginate": {
                                "first": "Primero",
                                "last": "Último",
                                "next": "Siguiente",
                                "previous": "Anterior"
                            },
                            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                        },
                    });
                })
            },

                // Method for attach image in form create.
            attachImage() {
                try {

                        // Declare value variable.
                    this.resourceData.Portada = this.$refs.imageResource.files[0];
                    
                        // Declae reader.
                    let reader = new FileReader();
                   
                        // Function save event to use load image.
                    reader.addEventListener('load', function (){
                        this.$refs.imageResourceDisplay.src = reader.result;
                    }.bind(this), false);

                        // Load data reader in variable.
                    reader.readAsDataURL(this.resourceData.Portada);
                        
                        // Open swet alert use to indicate response attach image.
                    this.$swal.fire({
                        icon: 'success',
                        title: 'La imagen ha sido cargada exitosamente',
                        toast: true,
                        position: 'top-end',
                        timer: 3000,
                        timerProgressBar: true,
                        showConfirmButton: false,

                    });
                } catch {
                            // Open swet alert use to indicate response attach image.
                        this.$swal.fire({
                        icon: 'error',
                        title: 'No se ha podido cargar la imagen',
                        toast: true,
                        position: 'top-end',
                        timer: 3000,
                        timerProgressBar: true,
                        showConfirmButton: false,

                    });
                };
            },

            // Method for attach image in form create.
            attachDocument() {
                try {

                        // Declare value variable.
                    this.resourceData.Archivo = this.$refs.documentResource.files[0];
                        
                        // Open swet alert use to indicate response attach image.
                    this.$swal.fire({
                        icon: 'success',
                        title: 'El documento ha sido cargada exitosamente',
                        toast: true,
                        position: 'top-end',
                        timer: 3000,
                        timerProgressBar: true,
                        showConfirmButton: false,

                    });
                } catch {
                            // Open swet alert use to indicate response attach image.
                        this.$swal.fire({
                        icon: 'error',
                        title: 'No se ha podido cargar la imagen',
                        toast: true,
                        position: 'top-end',
                        timer: 3000,
                        timerProgressBar: true,
                        showConfirmButton: false,

                    });
                };
            },

                // Close and clear data in form create.
            hideNewResourceModal() {
                    
                    // Close modal.
                this.$refs.modalCreateResource.hide();

                    // Clean data.
                this.aboutusData = {
                    Nombre: '',
                    Descripcion: '',
                    Portada: '',
                    Archivo: '',
                };

                    // Clean errors.
                this.errors = {};
            },
            
                // Event open new modal with clean form create.
            showNewResourceModal() {

                    // Show modal.
                this.$refs.modalCreateResource.show();
            },
            
                // Function use for save data forma to send request.
            createRegisterResource: async function () {

                            // Declare FormData.
                        let formData = new FormData();
                    formData.append('name_resource', this.resourceData.Nombre);
                    formData.append('description', this.resourceData.Descripcion);
                    formData.append('image', this.resourceData.Portada);
                    formData.append('document', this.resourceData.Archivo);

                try {
                        // Call request to create register in service.
                    await resourceService.createRegisterResource(formData);

                        // Open swet alert to indicate success.                    
                    this.$swal.fire({
                        icon: 'success',
                        title: 'Exito',
                        text: 'El registro ha sido guardado correctamente',
                    });
                        // Clean and close form.
                    this.hideNewResourceModal();

                        // Declare variable for save request load register. 
                    const data = await resourceService.loadRegisterResource();

                        // Save data in registers.
                    this.registers = data.data.data;
                    
                } catch (error) {
                                    
                    // Validate HTTP response status code.
                switch (error.response.status) {
                        // Error 422 HTTP_
                    case 422:
                            // Load error validations.
                        this.errors = error.response.data.errors;
                            // Show swet alert indicate succeso to load data.
                        this.$swal.fire({
                            icon: 'error',
                            title: 'Existen errores en el llenado del formulario',
                            toast: true,
                            position: 'top-end',
                            timer: 3000,
                            timerProgressBar: true,
                            showConfirmButton: false,

                        });
                        break;
                    default:
                            // Clean and close form. 
                        this.hideNewResourceModal();
                            // Open swet alert to indicate errors.
                        this.$swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Ha ocurrido un error, vuelve a intentarlo en otro momento',
                        });
                        break;
                    };
                };
            },  

                // Function use to load and draw data in data table.
            loadRegisterResource() {
                
                    // Decalre Promise for call request load register.
                resourceService.loadRegisterResource().then((response)=>{
                     
                        // Declare variable registers to use load data in table.
                    this.registers = response.data.data;
                        
                        // Call function to use plugin DataTable.
                    this.loadDataTable();

                        // Swet alert represent event success.
                    this.$swal.fire({
                        icon: 'success',
                        title: 'El contenido ha sido cargado correctamente',
                        toast: true,
                        position: 'top-end',
                        timer: 3000,
                        timerProgressBar: true,
                        showConfirmButton: false,
                        })

                }).catch((error) => {
                    
                        // Swet alert represent event error.
                    this.$swal.fire({
                        icon: 'success',
                        title: 'El contenido ha sido cargado correctamente',
                        toast: true,
                        position: 'top-end',
                        timer: 3000,
                        timerProgressBar: true,
                        showConfirmButton: false,
                        });
                });
                

            },

                // Function use to delete register select.
            deleteResourceRegister(resource) {
                
                // Swet alert to use question delete register. 
            this.$swal.fire({
                title: `¿Desea eliminar el registro: ${resource.Nombre}?`,
                icon: 'question',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: `Eliminar`,
                denyButtonText: `Cancelar`,
                }).then((result) => {
                        
                        // The result for question in this alert is confirmed.
                    if (result.isConfirmed) {
                            
                            // Send reqeust to use delete register.
                        resourceService.deleteResourceRegister(resource.Id).then((response) =>{
                                
                                // Swet alert to use indicate success.
                            this.$swal.fire({
                                icon: 'success',
                                title: `El registro: ${resource.Nombre} ha sido eliminado correctamente.`,
                                toast: true,
                                showConfirmButton: false,
                                position: 'top-end',
                                timer: 3000,
                                timerProgressBar: true,
                            });
                                // Decalre Promise for call request load register.
                            resourceService.loadRegisterResource().then((response) => {
                                
                                    // Declare variable registers to use load data in table.
                                this.registers = response.data.data;

                            });

                        }).catch((error =>{

                            // Swet alert to use indidcate error.
                        this.$swal.fire({
                                icon: 'error',
                                title: `No es posible eliminar el registro: ${resource.Nombre} en estos momentos.`,
                                toast: true,
                                showConfirmButton: false,
                                position: 'top-end',
                                timer: 3000,
                                timerProgressBar: true,
                            });
                        }));

                        // The result for question in this alert is denied. 
                    } else if (result.isDenied) {
                    this.$swal.fire({
                            icon: 'warning',
                            title: `El registro;${resource.Nombre}  no ha sido eliminado`,
                            toast: true,
                            showConfirmButton: false,
                            position: 'top-end',
                            timer: 3000,
                            timerProgressBar: true,
                        });
                    };
                });
            },

                // Close and clear data in form update.
            hideUpdateResourceModal(){

                    // Close modal.
                this.$refs.modalUpdateResource.hide();

                    // Clean data.
                this.resourceData = {
                    Nombre: '',
                    Descripcion: '',
                    Portada: '',
                    Archivo: '',
                };

                    // Clean errors.
                this.errors = {};
            },

                // Event open update modal with clean form.
            showUpdateResourceModal(){

                    // Show modal.
                this.$refs.modalUpdateResource.show();
            },

                // Capture dates into form update.
            updateDataResource(resource) {

                    // Save data to use load in inputs.
                this.resourceData = {...resource};

                    // Show modal.
                this.showUpdateResourceModal();
            },

                // Method for update attach image in form.
            updateImage() {
                try {
                        // Declare value in variable.
                    this.resourceData.Portada = this.$refs.updateImageResource.files[0];

                        // Declae reader.
                    let reader = new FileReader();
                        
                         // Function save event to use load image.
                    reader.addEventListener('load', function (){
                        this.$refs.updateImageResourceDisplay.src = reader.result;
                    }.bind(this), false);

                        // Load data reader in variable.
                    reader.readAsDataURL(this.resourceData.Portada);

                        // Open swet alert use to indicate response attach image.
                    this.$swal.fire({
                        icon: 'success',
                        title: 'La imagen ha sido cargada exitosamente',
                        toast: true,
                        position: 'top-end',
                        timer: 3000,
                        timerProgressBar: true,
                        showConfirmButton: false,

                    });
                } catch (error){
                            // Open swet alert use to indicate response attach image.
                        this.$swal.fire({
                        icon: 'error',
                        title: `${error}`,
                        toast: true,
                        position: 'top-end',
                        timer: 3000,
                        timerProgressBar: true,
                        showConfirmButton: false,

                    });
                };
            },
            
            // Method for update attach image in form.
            updateDocument() {
                try {
                        // Declare value in variable.
                    this.resourceData.Archivo = this.$refs.updateDocumentResource.files[0];

                        // Open swet alert use to indicate response attach image.
                    this.$swal.fire({
                        icon: 'success',
                        title: 'La imagen ha sido cargada exitosamente',
                        toast: true,
                        position: 'top-end',
                        timer: 3000,
                        timerProgressBar: true,
                        showConfirmButton: false,

                    });
                } catch (error){
                            // Open swet alert use to indicate response attach image.
                        this.$swal.fire({
                        icon: 'error',
                        title: `${error}`,
                        toast: true,
                        position: 'top-end',
                        timer: 3000,
                        timerProgressBar: true,
                        showConfirmButton: false,

                    });
                };
            },


                // Function to use update register selected.
            updateRegisterResource: async function() {
                try {       
                            // Declare FormData.
                        let formData = new FormData();
                    formData.append('name_resource', this.resourceData.Nombre);
                    formData.append('description', this.resourceData.Descripcion);
                    formData.append('image', this.resourceData.Portada);
                    formData.append('document', this.resourceData.Archivo);
                    formData.append('_method', 'put');
                    
                        // Call request in service to update data.
                    await resourceService.updateRegisterResource(this.resourceData.Id, formData);
                    
                        // Declare variable for save request load register. 
                    const data = await resourceService.loadRegisterResource();

                        // Save data in registers.
                    this.registers = data.data.data;
                    
                    this.hideUpdateResourceModal();

                        // Open swet alert to indicate success.                    
                    this.$swal.fire({
                        icon: 'success',
                        title: 'Exito',
                        text: `El registro ha sido modificado correctamente`,
                    });

                } catch (error) {

                    // Validate HTTP response status code.
                switch (error.response.status) {
                        // Error 422 HTTP_
                    case 422:
                            // Load error validations.
                        this.errors = error.response.data.errors;
                            // Show swet alert indicate succeso to load data.
                        this.$swal.fire({
                            icon: 'error',
                            title: 'Existen errores en el llenado del formulario',
                            toast: true,
                            position: 'top-end',
                            timer: 3000,
                            timerProgressBar: true,
                            showConfirmButton: false,

                        });

                        
                        break;
                    default:
                            // Clean and close form. 
                        this.hideUpdateResourceModal();
                            // Open swet alert to indicate errors.
                        this.$swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Ha ocurrido un error, vuelve a intentarlo en otro momento',
                        });
                        break;
                    };
                    
                }
            }
            
        },
            // End declare methods.
    }
</script>   
    <!-- End script. -->
