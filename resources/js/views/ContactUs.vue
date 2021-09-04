    <!-- Begin template. -->
<template>
    <!-- Begin page content. -->
<div class="container-fluid">

    <!-- Page heading. -->
    <div class="d-sm-flex align-items-center justify-content-center mb-4">
        <h1 class="mb-0 text-gray-800">Contactenos</h1>
    </div>
    
        <!-- Data table. -->
    <div class="card">
            <!-- Header data table. -->
        <div class="card-body d-flex">
            <h4><span><i class="fas fa-table"></i>  Visualización de datos</span></h4>
            <button class="btn btn-success btn-sm ml-auto" @click="showNewContactUsModal"><span><i class="fa fa-plus"></i></span>Agregar Registro</button>
        </div>
            <!-- Content data table. -->
        <div class="card-body table-responsive align-items-center justify-content-center">
            <table id="tableRegisters" class="table table-bordered">  
                <thead class="table-dark">
                    <tr>
                        <td>Id</td>
                        <td>Telefono</td>
                        <td>Direccion</td>
                        <td>Correspondiente</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody> 
                    <tr v-for="(contactus, index) in registers" :key="index">
                        <td>{{contactus.Id}}</td>
                        <td>{{contactus.Telefono}}</td>
                        <td>{{contactus.Direccion}}</td>
                        <td>{{contactus.Correspondiente}}</td>
                        <td>
                            <button class="btn btn-success btn-sm" @click="updateDataContactUs(contactus)"><span class="fa fa-edit"></span></button>
                            <button class="btn btn-danger btn-sm" @click="deleteContactUsRegister(contactus)"><span class="fa fa-trash"></span></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
            <!-- End content data table. -->
    </div>
        <!--End data table. -->

        <!-- Content modal create. -->
    <b-modal ref="modalCreateContactUs" hide-footer size="xl" title="Agregar Nuevo Registro">
        <div class="d-block">
                <!-- Form modal create. -->
            <form v-on:submit.prevent="createRegisterContactUs">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="phone">Telefono:</label>
                        <b-form-input :state="contactusData.Telefono.length >= 1 && contactusData.Telefono.length < 50" type="text" class="form-control" id="phone" v-model="contactusData.Telefono" placeholder="Ingresar Telefono" autocomplete="off"></b-form-input>
                        <div class="invalid-feedback-validation" v-if="errors.phone">{{errors.phone[0]}}</div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="direction">Direccion:</label>
                        <b-form-textarea :state="contactusData.Direccion.length >= 1 && contactusData.Direccion.length < 1000" type="text" class="form-control" id="direction" v-model="contactusData.Direccion" placeholder="Ingresar Direccion" autocomplete="off"></b-form-textarea>                 
                        <div class="invalid-feedback-validation" v-if="errors.direction">{{errors.direction[0]}}</div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="year">Correspondiente a:</label>
                        <b-form-input :state="contactusData.Correspondiente >= 2020 && contactusData.Correspondiente < 2099" type="text" class="form-control" id="year" v-model="contactusData.Correspondiente" placeholder="Ingresar Año" autocomplete="off"></b-form-input>
                        <div class="invalid-feedback-validation" v-if="errors.year">{{errors.year[0]}}</div>                    
                    </div>
                </div>
                <hr>
                <div class="text-center">    
                    <button type="button" class="btn btn-default" @click="hideNewContactUsModal">Cancelar</button>
                    <button type="submit" class="btn btn-success"><span class="fa fa-check"></span>Aceptar</button>
                </div>
            </form> 
                <!-- End form modal create. -->
        </div>
    </b-modal>
        <!-- End modal create. -->

        <!-- Content modal update. -->
    <b-modal ref="modalUpdateContactUs" hide-footer size="xl" title="Modificar Registro">
        <div class="d-block">
                <!-- Form modal update. -->
            <form v-on:submit.prevent="updateRegisterContactUs">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="phone">Telefono:</label>
                        <b-form-input :state="contactusData.Telefono.length >= 1 && contactusData.Telefono.length < 50" type="text" class="form-control" id="phone" v-model="contactusData.Telefono" placeholder="Ingresar Telefono" autocomplete="off"></b-form-input>
                        <div class="invalid-feedback-validation" v-if="errors.phone">{{errors.phone[0]}}</div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="direction">Direccion:</label>
                        <b-form-textarea :state="contactusData.Direccion.length >= 1 && contactusData.Direccion.length < 1000" type="text" class="form-control" id="direction" v-model="contactusData.Direccion" placeholder="Ingresar Direccion" autocomplete="off"></b-form-textarea>                 
                        <div class="invalid-feedback-validation" v-if="errors.direction">{{errors.direction[0]}}</div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="year">Correspondiente a:</label> 
                        <b-form-input :state="contactusData.Correspondiente >= 2020 && contactusData.Correspondiente < 2099" type="text" class="form-control" id="year" v-model="contactusData.Correspondiente" placeholder="Ingresar Año" autocomplete="off"></b-form-input>
                        <div class="invalid-feedback-validation" v-if="errors.year">{{errors.year[0]}}</div>                    
                    </div>
                </div>
                <hr>
                <div class="text-center">    
                    <button type="button" class="btn btn-default" @click="hideUpdateContactUsModal">Cancelar</button>
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

        // Import file aboutUsService that contains functions request routes.
    import * as contactUsService from '../services/contactus_service';
    
        // Begin export default.
    export default {

        name: 'contactus',

            // Begin data.
        data(){
            return {
                
                    // Declare registers to use to save display data.
                registers: [],

                    // Declare aboutusData to use to send data in form.
                contactusData: {
                    Telefono: '',
                    Direccion: '',
                    Correspondiente: '',
                },

                    // Save errors to response send request.
                errors: {},
                
            };
        },
            // End data.

            // Mounted data for registers in datatable.
        mounted() {
                // Call method function to use load data.
            this.loadRegisterContactUs();
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

                // Close and clear data in form create.
            hideNewContactUsModal() {
                this.$refs.modalCreateContactUs.hide();
                this.contactusData = {
                    Telefono: '',
                    Direccion: '',
                    Correspondiente: '',
                };
            },
            
                // Event open new modal with clean form create.
            showNewContactUsModal() {
                this.$refs.modalCreateContactUs.show();
            },
            
                // Function use for save data forma to send request.
            createRegisterContactUs: async function () {
                    let formData = new FormData();
                formData.append('phone', this.contactusData.Telefono);
                formData.append('direction', this.contactusData.Direccion);
                formData.append('year', this.contactusData.Correspondiente);

                try {
                        // Call request to create register in service.
                    await contactUsService.createRegisterContactUs(formData);

                        // Open swet alert to indicate success.                    
                    this.$swal.fire({
                        icon: 'success',
                        title: 'Exito',
                        text: 'El registro ha sido guardado correctamente',
                    });
                        // Clean and close form.
                    this.hideNewContactUsModal();

                        // Declare variable for save request load register. 
                    const data = await contactUsService.loadRegisterContactUs();

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
                        this.hideNewContactUsModal();
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
            loadRegisterContactUs() {
                
                    // Decalre Promise for call request load register.
                contactUsService.loadRegisterContactUs().then((response)=>{
                     
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
            deleteContactUsRegister(contactus) {
                
                // Swet alert to use question delete register. 
            this.$swal.fire({
                title: `¿Desea eliminar el registro: ${contactus.Correspondiente}?`,
                icon: 'question',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: `Eliminar`,
                denyButtonText: `Cancelar`,
                }).then((result) => {
                        
                        // The result for question in this alert is confirmed.
                    if (result.isConfirmed) {
                            
                            // Send reqeust to use delete register.
                        contactUsService.deleteContactUsRegister(contactus.Id).then((response) =>{
                                
                                // Swet alert to use indicate success.
                            this.$swal.fire({
                                icon: 'success',
                                title: `El registro: ${contactus.Correspondiente} ha sido eliminado correctamente.`,
                                toast: true,
                                showConfirmButton: false,
                                position: 'top-end',
                                timer: 3000,
                                timerProgressBar: true,
                            });
                                // Decalre Promise for call request load register.
                            contactUsService.loadRegisterContactUs().then((response) => {
                                
                                    // Declare variable registers to use load data in table.
                                this.registers = response.data.data;

                            });

                        }).catch((error =>{

                            // Swet alert to use indidcate error.
                        this.$swal.fire({
                                icon: 'error',
                                title: `No es posible eliminar el registro: ${contactus.Correspondiente} en estos momentos.`,
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
                            title: `El registro;${contactus.Correspondiente}  no ha sido eliminado`,
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
            hideUpdateContactUsModal(){
                this.$refs.modalUpdateContactUs.hide();
                this.contactusData = {
                    Telefono: '',
                    Direccion: '',
                    Correspondiente: '',
                };
            },

                // Event open update modal with clean form.
            showUpdateContactUsModal(){
                this.$refs.modalUpdateContactUs.show();
            },

                // Capture dates into form update.
            updateDataContactUs(contactus) {
                this.contactusData = {...contactus};
                this.showUpdateContactUsModal();
            },

                // Function to use update register selected.
            updateRegisterContactUs: async function() {
                try {
                        let formData = new FormData();
                    formData.append('phone', this.contactusData.Telefono);
                    formData.append('direction', this.contactusData.Direccion);
                    formData.append('year', this.contactusData.Correspondiente);
                    formData.append('_method', 'put');
                    
                        // Call request in service to update data.
                    await contactUsService.updateRegisterContactUs(this.contactusData.Id, formData);
                    
                        // Declare variable for save request load register. 
                    const data = await contactUsService.loadRegisterContactUs();

                        // Save data in registers.
                    this.registers = data.data.data;
                    
                    this.hideUpdateContactUsModal();

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
                        this.hideUpdateContactUsModal();
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
