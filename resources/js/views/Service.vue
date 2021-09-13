    <!-- Begin template. -->
<template>
    <!-- Begin page content. -->
<div class="container-fluid">

    <!-- Page heading. -->
    <div class="d-sm-flex align-items-center justify-content-center mb-4">
        <h1 class="mb-0 text-gray-800">Servicios</h1>
    </div>
    
        <!-- Data table. -->
    <div class="card">
            <!-- Header data table. -->
        <div class="card-body d-flex">
            <h4><span><i class="fas fa-table"></i>  Visualización de datos</span></h4>
            <button class="btn btn-success btn-sm ml-auto" @click="showNewServiceModal"><span><i class="fa fa-plus"></i></span>Agregar Registro</button>
        </div>
            <!-- Content data table. -->
        <div class="card-body table-responsive align-items-center justify-content-center">
            <table id="tableRegisters" class="table table-hover table-responsive table-bordered">  
                <thead class="table-dark">
                    <tr>
                        <td>Id</td>
                        <td>Servicio</td>
                        <td>Descripcion</td>
                        <td>Enlace</td>
                        <td>Estado</td>
                        <td>Categorias</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(service, index) in registers" :key="index">
                        <td>{{service.Id}}</td>
                        <td>{{service.Servicio}}</td>
                        <td>{{service.Descripcion}}</td>
                        <td><a target="_blank" :href="`${service.Enlace}`"><button class="btn btn-primary"><span class="fas fa-external-link-square-alt"></span>Abiir enlace</button></a></td>
                        <td>{{service.Estado}}</td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm" @click="ShowModalCategorieService(service.Id, service.Servicio)"><span class="fa fa-eye"></span></button>
                                <button class="btn btn-success btn-sm" @click="showNewCategorieServiceModal(service)"><span class="fa fa-plus"></span></button>
                            </td>
                        <td>
                            <button class="btn btn-success btn-sm" @click="updateDataService(service)"><span class="fa fa-edit"></span></button>
                            <button class="btn btn-danger btn-sm" @click="deleteServiceRegister(service)"><span class="fa fa-trash"></span></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
            <!-- End content data table. -->
    </div>
        <!--End data table. -->

        <!-- Begin show table modal -->

    <b-modal ref="modalShowCategorieService" hide-footer size="xl" title="Categorias Servicio">
        <div class="card">
                <table id="tableRegistersCategorie" class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <td>Categoria</td>
                        <td>Descripcion</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(service, index) in categories" :key="index">
                        <td>{{service.Categoria}}</td>
                        <td>{{service.Descripcion}}</td>
                        <td>
                            <button class="btn btn-success btn-sm" @click="updateDataCategorieService(service)"><span class="fa fa-edit"></span></button>
                            <button class="btn btn-danger btn-sm" @click="deleteCategorieServiceRegister(service)"><span class="fa fa-trash"></span></button>
                        </td>
                    </tr>
                </tbody>
               </table>
        </div>
    </b-modal>

        <!-- End show table modal -->

        <!-- Begin table modal create -->

    <b-modal ref="modalCreateCategorieService" hide-footer size="sm" title="Agregar Categoria">
        <div class="d-block">
            <!-- Form modal create. -->
            <form v-on:submit.prevent="createRegisterCategorieService">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="name_categorie">Nombre:</label>
                        <b-form-input :state="categorieServiceData.Categoria.length >= 1 && categorieServiceData.Categoria.length < 50" type="text" class="form-control" id="name_categorie" v-model="categorieServiceData.Categoria" placeholder="Ingresar Nombre" autocomplete="off"></b-form-input>
                        <div class="invalid-feedback-validation" v-if="errors.name_categorie">{{errors.name_categorie[0]}}</div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="description">Descripcion:</label>
                        <ckeditor id="description" :editor="editor" v-model="categorieServiceData.Descripcion" :config="editorConfig"></ckeditor>                 
                        <div class="invalid-feedback-validation" v-if="errors.description">{{errors.description[0]}}</div>
                    </div>
                    <b-form-input id="id_service" v-model="categorieServiceData.ServicioId" class="hidden"></b-form-input>
                </div>
                <hr>
                <div class="text-center">    
                    <button type="button" class="btn btn-default" @click="hideNewCategorieServiceModal">Cancelar</button>
                    <button type="submit" class="btn btn-success"><span class="fa fa-check"></span>Aceptar</button>
                </div>
            </form> 
                <!-- End form modal create. -->
        </div>
    </b-modal>

        <!-- End table modal create -->

        <!-- Begin show modal update -->

    <b-modal ref="modalUpdateCategorieService" hide-footer size="sm" title="Modificar Categoria">
        <div class="d-block">
            <!-- Form modal update. -->
            <form v-on:submit.prevent="updateRegisterCategorieService">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="name_categorie">Nombre:</label>
                        <b-form-input :state="categorieServiceData.Categoria.length >= 1 && categorieServiceData.Categoria.length < 50" type="text" class="form-control" id="name_categorie" v-model="categorieServiceData.Categoria" placeholder="Ingresar Nombre" autocomplete="off"></b-form-input>
                        <div class="invalid-feedback-validation" v-if="errors.name_categorie">{{errors.name_categorie[0]}}</div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="description">Descripcion:</label>
                        <ckeditor id="description" :editor="editor" v-model="categorieServiceData.Descripcion" :config="editorConfig"></ckeditor>                 
                        <div class="invalid-feedback-validation" v-if="errors.description">{{errors.description[0]}}</div>
                    </div>
                    <b-form-input id="id_service" v-model="categorieServiceData.ServicioId" class="hidden"></b-form-input>
                </div>
                <hr>
                <div class="text-center">    
                    <button type="button" class="btn btn-default" @click="hideUpdateCategorieServiceModal(categorieServiceData.ServicioId)">Cancelar</button>
                    <button type="submit" class="btn btn-success"><span class="fa fa-check"></span>Aceptar</button>
                </div>
            </form> 
                <!-- End form modal update. -->
        </div>
    </b-modal>

        <!-- End show modal update -->    

        <!-- Content modal create. -->
    <b-modal ref="modalCreateService" hide-footer size="xl" title="Agregar Nuevo Registro">
        <div class="d-block">
                <!-- Form modal create. -->
            <form v-on:submit.prevent="createRegisterService">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name_service">Nombre:</label>
                        <b-form-input :state="serviceData.Servicio.length >= 1 && serviceData.Servicio.length < 50" type="text" class="form-control" id="name_service" v-model="serviceData.Servicio" placeholder="Ingresar Nombre del Servicio" autocomplete="off"></b-form-input>
                        <div class="invalid-feedback-validation" v-if="errors.name_service">{{errors.name_service[0]}}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="description">Descripcion:</label>
                        <ckeditor id="description" :editor="editor" v-model="serviceData.Descripcion" :config="editorConfig"></ckeditor>                 }
                        <div class="invalid-feedback-validation" v-if="errors.description">{{errors.description[0]}}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="link">Enlace:</label>
                        <b-form-input :state="serviceData.Enlace.length >= 1 && serviceData.Enlace.length < 50" type="text" class="form-control" id="link" v-model="serviceData.Enlace" placeholder="Ingresar Direccion de Enlace" autocomplete="off"></b-form-input>
                        <div class="invalid-feedback-validation" v-if="errors.link">{{errors.link[0]}}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <b-form-checkbox id="state" v-model="serviceData.Estado" name="state" value="Visible" unchecked-value="Disabled">
                        ¿Desea que el contenido sea visible?
                        </b-form-checkbox>       
                        <div class="invalid-feedback-validation" v-if="errors.state">{{errors.state[0]}}</div>      
                    </div>
                </div>
                <hr>
                <div class="text-center">    
                    <button type="button" class="btn btn-default" @click="hideNewServiceModal">Cancelar</button>
                    <button type="submit" class="btn btn-success"><span class="fa fa-check"></span>Aceptar</button>
                </div>
            </form> 
                <!-- End form modal create. -->
        </div>
    </b-modal>
        <!-- End modal create. -->

        <!-- Content modal update. -->
    <b-modal ref="modalUpdateService" hide-footer size="xl" title="Modificar Registro">
        <div class="d-block">
                <!-- Form modal update. -->
            <form v-on:submit.prevent="updateRegisterService">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name_service">Nombre:</label>
                        <b-form-input :state="serviceData.Servicio.length >= 1 && serviceData.Servicio.length < 50" type="text" class="form-control" id="name_service" v-model="serviceData.Servicio" placeholder="Ingresar Nombre del Servicio" autocomplete="off"></b-form-input>
                        <div class="invalid-feedback-validation" v-if="errors.name_service">{{errors.name_service[0]}}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="description">Descripcion:</label>
                        <ckeditor id="description" :editor="editor" v-model="serviceData.Descripcion" :config="editorConfig"></ckeditor>                 }
                        <div class="invalid-feedback-validation" v-if="errors.description">{{errors.description[0]}}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="link">Enlace:</label>
                        <b-form-input :state="serviceData.Enlace.length >= 1 && serviceData.Enlace.length < 50" type="text" class="form-control" id="link" v-model="serviceData.Enlace" placeholder="Ingresar Direccion de Enlace" autocomplete="off"></b-form-input>
                        <div class="invalid-feedback-validation" v-if="errors.link">{{errors.link[0]}}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <b-form-checkbox id="state" v-model="serviceData.Estado" name="state" value="Visible" unchecked-value="Disabled">
                        ¿Desea que el contenido sea visible?
                        </b-form-checkbox>       
                        <div class="invalid-feedback-validation" v-if="errors.state">{{errors.state[0]}}</div>      
                    </div>
                </div>
                <hr>
                <div class="text-center">    
                    <button type="button" class="btn btn-default" @click="hideUpdateServiceModal">Cancelar</button>
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

        // Import file servicesService that contains functions request routes.
    import * as servicesService from '../services/services_service';

        // Import file categorieServicesService that contains functions request routes.
    import * as categorieservicesService from '../services/categorieservices_service';

        // Import ClassicEditor to use in component long text.
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

        // Begin export default.
    export default {

        name: 'service',
        
            //Begin data.
        data(){
            return {

                    // Declare classic editor.
                editor: ClassicEditor,
               
                editorConfig: {
                    // The configuration of the editor.
                },

                    // Declare registers to use to save display data.
                categories: [],

                    // Declare registers to use to save display data.
                registers: [],

                    // Declare serviceData to use to send data in form.
                serviceData: {
                    Servicio: '',
                    Descripcion: '',
                    Enlace: '',
                    Estado: '',
                },

                    // Declare categorieServiceData to use to send data in form.
                categorieServiceData: {
                    Categoria: '',
                    Descripcion: '',
                    ServicioId: '',
                    Servicio: '',
                },

                    // Save errors to response send request.
                errors: {},

            };
        },
            //End data.

            // Mounted data for registers in datatable.
        mounted() {   
                // Call method function to use load data.
            this.loadRegisterService();

        },
        
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

                // Close and clear data in form create.
            hideNewServiceModal() {

                    // Close modal.
                this.$refs.modalCreateService.hide();

                    // Clean data.
                this.serviceData = {
                    Servicio: '',
                    Descripcion: '',
                    Enlace: '',
                    Estado: '',
                };

                    // Clean errors.
                this.errors = {};
                
            },
            
                // Event open new modal with clean form create.
            showNewServiceModal() {

                    // Show modal.
                this.$refs.modalCreateService.show();
            },

                // Close and clear data in form create.
            hideNewCategorieServiceModal() {

                    // Close modal.
                this.$refs.modalCreateCategorieService.hide();

                    // Clean data.
                this.categorieServiceData = {
                    Categoria: '',
                    Descripcion: '',
                    ServicioId: '',
                    Servicio: '',
                },

                    // Clean errors.
                this.errors = {};
                
            },
            
                // Event open new modal with clean form create.
            showNewCategorieServiceModal(service) {

                    // Show modal.
                this.$refs.modalCreateCategorieService.show();

                    // Save data to load in inputs.
                this.categorieServiceData.ServicioId = service.Id;
            },

                // Event open modal show data in table.
            ShowModalCategorieService(service) {

                    // Modal open.
                this.$refs.modalShowCategorieService.show();

                    // Call fuction to load data.
                this.loadRegisteCategorierService(service);
            },
            
                // Function use for save data forma to send request.
            createRegisterService: async function () { 

                            // Declare FormData.
                        let formData = new FormData();
                    formData.append('name_service', this.serviceData.Servicio);
                    formData.append('description', this.serviceData.Descripcion);
                    formData.append('link', this.serviceData.Enlace);
                    formData.append('state', this.serviceData.Estado);

                try {
                        // Call request to create register in service.
                    await servicesService.createRegisterService(formData);

                        // Open swet alert to indicate success.                    
                    this.$swal.fire({
                        icon: 'success',
                        title: 'Exito',
                        text: 'El registro ha sido guardado correctamente',
                    });
                        // Clean and close form.
                    this.hideNewServiceModal();

                        // Declare variable for save request load register. 
                    const data = await servicesService.loadRegisterService();

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
                        this.hideNewServiceModal();
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
            
                // Function use for save data forma to send request.
            createRegisterCategorieService: async function () {

                            // Declare FormData.
                        let formData = new FormData();
                    formData.append('name_categorie', this.categorieServiceData.Categoria);
                    formData.append('description', this.categorieServiceData.Descripcion);
                    formData.append('id_service', this.categorieServiceData.ServicioId)
                try {
                        // Call request to create register in service.
                    await categorieservicesService.createRegisterCategorieService(formData);

                        // Open swet alert to indicate success.                    
                    this.$swal.fire({
                        icon: 'success',
                        title: 'Exito',
                        text: 'El registro ha sido guardado correctamente',
                    });
                        // Clean and close form.
                    this.hideNewCategorieServiceModal();
                    
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
                        this.hideNewCategorieServiceModal();
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
            loadRegisterService() {

                    // Decalre Promise for call request load register.
                servicesService.loadRegisterService().then((response)=>{
                     
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

                // Function use to load and draw data in data table.
            loadRegisteCategorierService(service) {

                    // Decalre Promise for call request load register.
                categorieservicesService.loadRegisterCategorieService(service).then((response)=>{
                     
                    // Declare variable registers to use load data in table.
                this.categories = response.data.data;

                }).catch((error) => {
                    console.error(error);
                });
                

            },


                // Function use to delete register select.
            deleteServiceRegister(service) {
                
                // Swet alert to use question delete register. 
            this.$swal.fire({
                title: `¿Desea eliminar el registro: ${service.Servicio}?`,
                icon: 'question',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: `Eliminar`,
                denyButtonText: `Cancelar`,
                }).then((result) => {

                        // The result for question in this alert is confirmed.
                    if (result.isConfirmed) {

                            // Send reqeust to use delete register.
                        servicesService.deleteServiceRegister(service.Id).then((response) =>{

                                // Swet alert to use indicate success.
                            this.$swal.fire({
                                icon: 'success',
                                title: `El registro: ${service.Servicio} ha sido eliminado correctamente.`,
                                toast: true,
                                showConfirmButton: false,
                                position: 'top-end',
                                timer: 3000,
                                timerProgressBar: true,
                            });

                                // Decalre Promise for call request load register.
                            servicesService.loadRegisterService().then((response) => {
                                
                                    // Declare variable registers to use load data in table.
                                this.registers = response.data.data;

                            });

                        }).catch((error =>{

                            // Swet alert to use indidcate error.
                        this.$swal.fire({
                                icon: 'error',
                                title: `No es posible eliminar el registro: ${service.Servicio} en estos momentos.`,
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
                            title: `El registro;${service.Servicio}  no ha sido eliminado`,
                            toast: true,
                            showConfirmButton: false,
                            position: 'top-end',
                            timer: 3000,
                            timerProgressBar: true,
                        });
                    };
                });
            },

                // Function use to delete register select.
            deleteCategorieServiceRegister(service) {
                
                // Swet alert to use question delete register. 
            this.$swal.fire({
                title: `¿Desea eliminar el registro: ${service.Categoria}?`,
                icon: 'question',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: `Eliminar`,
                denyButtonText: `Cancelar`,
                }).then((result) => {

                        // The result for question in this alert is confirmed.
                    if (result.isConfirmed) {

                            // Send reqeust to use delete register.
                        categorieservicesService.deleteCategorieServiceRegister(service.Id).then((response) =>{

                                // Swet alert to use indicate success.
                            this.$swal.fire({
                                icon: 'success',
                                title: `El registro: ${service.Categoria} ha sido eliminado correctamente.`,
                                toast: true,
                                showConfirmButton: false,
                                position: 'top-end',
                                timer: 3000,
                                timerProgressBar: true,
                            });

                                // Call function to use load data.
                            this.loadRegisteCategorierService(service.ServicioId);

                        }).catch((error =>{

                            // Swet alert to use indidcate error.
                        this.$swal.fire({
                                icon: 'error',
                                title: `No es posible eliminar el registro: ${service.Categoria} en estos momentos.`,
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
                            title: `El registro: ${service.Categoria}  no ha sido eliminado`,
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
            hideUpdateServiceModal(){

                    // Close modal.
                this.$refs.modalUpdateService.hide();

                    // Clean data.
                this.serviceData = {
                    Servicio: '',
                    Descripcion: '',
                    Enlace: '',
                    Estado: '',
                };

                    // Clean errors.
                this.errors = {};
            },
            
                // Event open update modal with clean form.
            showUpdateServiceModal(){

                    // Show modal.
                this.$refs.modalUpdateService.show();
            },

                // Close and clear data in form update.
            hideUpdateCategorieServiceModal(service){
                
                    // Close modal.
                this.$refs.modalUpdateCategorieService.hide();
                
                    // Clean data.
                this.categorieServiceData = {
                    Categoria: '',
                    Descripcion: '',
                    ServicioId: '',
                    Servicio: '',
                },

                    // Clean error.
                this.errors = {};

                    // Load data.
                this.loadRegisteCategorierService(service);
            },
            
                // Event open update modal with clean form.
            showUpdateCategorieServiceModal(){

                    // Show modal.
                this.$refs.modalUpdateCategorieService.show();
            },

                // Capture dates into form update.
            updateDataService(service) {

                    // Save data to use load in inputs.
                this.serviceData = {...service};
                
                    // Show modal.
                this.showUpdateServiceModal();
            },

                // Capture dates into form update.
            updateDataCategorieService(service) {

                    // Save data to use laod in inputs.
                this.categorieServiceData = {...service};

                    // Modal show.
                this.showUpdateCategorieServiceModal();
            },

                // Function to use update register selected.
            updateRegisterService: async function() {
                try {       
                            // Declare FormData.
                        let formData = new FormData();
                    formData.append('name_service', this.serviceData.Servicio);
                    formData.append('description', this.serviceData.Descripcion);
                    formData.append('link', this.serviceData.Enlace);
                    formData.append('state', this.serviceData.Estado);
                    formData.append('_method', 'put');
                    
                        // Call request in service to update data.
                    await servicesService.updateRegisterService(this.serviceData.Id, formData);
                    
                        // Declare variable for save request load register. 
                    const data = await servicesService.loadRegisterService();

                        // Save data in registers.
                    this.registers = data.data.data;
                    
                    this.hideUpdateServiceModal();

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
                        this.hideUpdateServiceModal();
                            // Open swet alert to indicate errors.
                        this.$swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Ha ocurrido un error, vuelve a intentarlo en otro momento',
                        });
                        break;
                    };
                    
                }
            },

                // Function to use update register selected.
            updateRegisterCategorieService: async function() {

                try {   
                            // Declare FormData.
                        let formData = new FormData();
                    formData.append('name_categorie', this.categorieServiceData.Categoria);
                    formData.append('description', this.categorieServiceData.Descripcion);
                    formData.append('id_service', this.categorieServiceData.ServicioId);
                    formData.append('_method', 'put');

                    
                        // Call request in service to update data.
                    await categorieservicesService.updateRegisterCategorieService(this.categorieServiceData.Id, formData);

                        // Call fuction close modal.        
                    this.hideUpdateCategorieServiceModal(this.categorieServiceData.ServicioId);

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
                       this.hideUpdateCategorieServiceModal(this.categorieServiceData.Id);

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

        }
            // End declare methods.
    }
        // End export default.   
</script>
    <!-- End script. -->
