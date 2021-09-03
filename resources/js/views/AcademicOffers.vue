<template>
    <!-- Begin page content. -->
<div class="container-fluid">

            <!-- Page heading. -->
    <div class="d-sm-flex align-items-center justify-content-center mb-4">
        <h1 class="mb-0 text-gray-800">Oferta Academica</h1>
    </div>

        <!-- Data table. -->
    <div class="card">
            <!-- Header data table. -->
        <div class="card-body d-flex">
            <h4><span><i class="fas fa-table"></i>  Visualización de datos</span></h4>
            <button class="btn btn-success btn-sm ml-auto" @click="showNewAcademicOfferModal"><span><i class="fa fa-plus"></i></span>Agregar Registro</button>
        </div>
            <!-- Content data table. -->
        <div class="card-body table-responsive  align-items-center justify-content-center">
            <table id="tableRegisters" class="table table-hover table-responsive table-bordered">  
                <thead class="table-dark">
                    <tr>
                        <td>Id</td>
                        <td>Oferta Academica</td>
                        <td>Descripcion</td>
                        <td>Portada</td>
                        <td>Estado</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(academicoffer, index) in registers" :key="index">
                        <td>{{academicoffer.Id}}</td>
                        <td>{{academicoffer.Oferta}}</td>
                        <td>{{academicoffer.Descripcion}}</td>
                        <td>
                            <img :src="`${$store.state.serverPath}/storage/${academicoffer.Portada}`" :alt="academicoffer.Titulo" class="table-image">
                        </td>
                        <td>{{academicoffer.Estado}}</td>
                        <td>
                            <button class="btn btn-success btn-sm" @click="updateDataAcademicOffer(academicoffer)"><span class="fa fa-edit"></span></button>
                            <button class="btn btn-danger btn-sm" @click="deleteAcademicOfferRegister(academicoffer)"><span class="fa fa-trash"></span></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
            <!-- End content data table. -->
    </div>
        <!--End data table. -->

        <!-- Content modal create. -->
    <b-modal ref="modalCreateAcademicOffer" hide-footer size="xl" title="Agregar Nuevo Registro">
        <div class="d-block">
                <!-- Form modal create. -->
            <form v-on:submit.prevent="createRegisterAcademicOffer">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name_offer">Oferta Academica:</label>
                        <b-form-input :state="academicofferData.Oferta.length >= 1 && academicofferData.Oferta.length < 50" type="text" class="form-control" id="name_offer" v-model="academicofferData.Oferta" placeholder="Ingresar Oferta Academica"></b-form-input>
                        <div class="invalid-feedback-validation" v-if="errors.name_offer">{{errors.name_offer[0]}}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="description">Descripcion:</label>
                        <b-form-textarea :state="academicofferData.Descripcion.length >= 1 && academicofferData.Descripcion.length < 1000" type="text" class="form-control" id="description" v-model="academicofferData.Descripcion" placeholder="Ingresar Descripcion"></b-form-textarea>                 
                        <div class="invalid-feedback-validation" v-if="errors.description">{{errors.description[0]}}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <b-form-checkbox id="state" v-model="academicofferData.Estado" name="state" value="Visible" unchecked-value="Disabled">
                        ¿Desea que el contenido sea visible?
                        </b-form-checkbox> 
                        <div class="invalid-feedback-validation" v-if="errors.state">{{errors.state[0]}}</div>       
                    </div>
                    <div class="form-group col-md-12">
                        <label for="image">Imagen:</label>
                        <div v-if="academicofferData.Portada.name">
                            <img src="" ref="imageAcademicOfferDisplay" width="700" height="300">  
                        </div>
                        <input type="file" v-on:change="attachImage" ref="imageAcademicOffer" class="form-control" id="image"/>
                        <div class="invalid-feedback-validation" v-if="errors.image">{{errors.image[0]}}</div>                    
                    </div>
                </div>
                <hr>
                <div class="text-center">    
                    <button type="button" class="btn btn-default" @click="hideNewAcademicOfferModal">Cancelar</button>
                    <button type="submit" class="btn btn-success"><span class="fa fa-check"></span>Aceptar</button>
                </div>
            </form> 
                <!-- End form modal create. -->
        </div>
    </b-modal>
        <!-- End modal create. -->

        <!-- Content modal update. -->
    <b-modal ref="modalUpdateAcademicOffer" hide-footer size="xl" title="Modificar Registro">
        <div class="d-block">
                <!-- Form modal update. -->
            <form v-on:submit.prevent="updateRegisterAcademicOffer">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name_offer">Oferta Academica:</label>
                        <b-form-input :state="academicofferData.Oferta.length >= 1 && academicofferData.Oferta.length < 50" type="text" class="form-control" id="name_offer" v-model="academicofferData.Oferta" placeholder="Ingresar Oferta Academica"></b-form-input>
                        <div class="invalid-feedback-validation" v-if="errors.name_offer">{{errors.name_offer[0]}}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="description">Descripcion:</label>
                        <b-form-textarea :state="academicofferData.Descripcion.length >= 1 && academicofferData.Descripcion.length < 1000" type="text" class="form-control" id="description" v-model="academicofferData.Descripcion" placeholder="Ingresar Descripcion"></b-form-textarea>                 
                        <div class="invalid-feedback-validation" v-if="errors.description">{{errors.description[0]}}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <b-form-checkbox id="state" v-model="academicofferData.Estado" name="state" value="Visible" unchecked-value="Disabled">
                        ¿Desea que el contenido sea visible?
                        </b-form-checkbox>       
                        <div class="invalid-feedback-validation" v-if="errors.state">{{errors.state[0]}}</div>      
                    </div>
                    <div class="form-group col-md-12">
                        <label for="image">Imagen:</label>
                        <div>
                            <img :src="`${$store.state.serverPath}/storage/${academicofferData.Portada}`" ref="updateImageAcademicOfferDisplay" width="700" height="300">  
                        </div>
                        <input type="file" v-on:change="updateImage" ref="imageUpdateAcademicOffer" class="form-control" id="image"/>
                        <div class="invalid-feedback-validation" v-if="errors.image">{{errors.image[0]}}</div>                    
                    </div>
                </div>
                <hr>
                <div class="text-center">    
                    <button type="button" class="btn btn-default" @click="hideUpdateAcademicOfferModal">Cancelar</button>
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

    <!-- Begin script. -->
<script>

    // Import plugin CloudTables.
    import 'datatables.net-bs4';

        // Impoort jquery to use plugin DataTable.
    import $ from 'jquery';

        // Import file academicOfferService that contains functions request routes.
    import * as academicOfferService from '../services/academicoffers_service';

        // Begin export default.
    export default {

        name: 'academicoffer',
        
            //Begin data.
        data(){
            return {

                    // Declare registers to use to save display data.
                registers: [],

                    // Declare aboutusData to use to send data in form.
                academicofferData: {
                    Oferta: '',
                    Descripcion: '',
                    Portada: '',
                    Estado: '',
                },

                    // Save errors to response send request.
                errors: {},

            };
        },
            //End data.

            // Mounted data for registers in datatable.
        mounted() {   
                // Call method function to use load data.
            this.loadRegisterAcademicOffer();
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

                // Method for attach image in form create.
            attachImage() {
                try {
                        // Declare value variable.
                    this.academicofferData.Portada = this.$refs.imageAcademicOffer.files[0];
                        
                        // Declae reader.
                    let reader = new FileReader();
                        
                        // Function save event to use load image.
                    reader.addEventListener('load', function (){
                        this.$refs.imageAcademicOfferDisplay.src = reader.result;
                    }.bind(this), false);

                        // Load data reader in variable.
                    reader.readAsDataURL(this.academicofferData.Portada);

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

                // Close and clear data in form create.
            hideNewAcademicOfferModal() {
                this.$refs.modalCreateAcademicOffer.hide();
                this.academicofferData = {
                    Oferta: '',
                    Descripcion: '',
                    Portada: '',
                    Estado: '',
                };
            },
            
                // Event open new modal with clean form create.
            showNewAcademicOfferModal() {
                this.$refs.modalCreateAcademicOffer.show();
            },
            
                // Function use for save data forma to send request.
            createRegisterAcademicOffer: async function () {
                let formData = new FormData();
                formData.append('name_offer', this.academicofferData.Oferta);
                formData.append('description', this.academicofferData.Descripcion);
                formData.append('image', this.academicofferData.Portada);
                formData.append('state', this.academicofferData.Estado);

                try {
                        // Call request to create register in service.
                    await academicOfferService.createRegisterAcademicOffer(formData);

                        // Open swet alert to indicate success.                    
                    this.$swal.fire({
                        icon: 'success',
                        title: 'Exito',
                        text: 'El registro ha sido guardado correctamente',
                    });
                        // Clean and close form.
                    this.hideNewAcademicOfferModal();

                        // Declare variable for save request load register. 
                    const data = await academicOfferService.loadRegisterAcademicOffer();

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
                        this.hideNewAboutUsModal();
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
            loadRegisterAcademicOffer() {

                    // Decalre Promise for call request load register.
                academicOfferService.loadRegisterAcademicOffer().then((response)=>{
                     
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
            deleteAcademicOfferRegister(academicoffer) {
                
                // Swet alert to use question delete register. 
            this.$swal.fire({
                title: `¿Desea eliminar el registro: ${academicoffer.Oferta}?`,
                icon: 'question',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: `Eliminar`,
                denyButtonText: `Cancelar`,
                }).then((result) => {

                        // The result for question in this alert is confirmed.
                    if (result.isConfirmed) {

                            // Send reqeust to use delete register.
                        academicOfferService.deleteAcademicOfferRegister(academicoffer.Id).then((response) =>{

                                // Swet alert to use indicate success.
                            this.$swal.fire({
                                icon: 'success',
                                title: `El registro: ${academicoffer.Oferta} ha sido eliminado correctamente.`,
                                toast: true,
                                showConfirmButton: false,
                                position: 'top-end',
                                timer: 3000,
                                timerProgressBar: true,
                            });

                                // Decalre Promise for call request load register.
                            academicOfferService.loadRegisterAcademicOffer().then((response) => {
                                
                                    // Declare variable registers to use load data in table.
                                this.registers = response.data.data;

                            });

                        }).catch((error =>{

                            // Swet alert to use indidcate error.
                        this.$swal.fire({
                                icon: 'error',
                                title: `No es posible eliminar el registro: ${academicoffer.Oferta} en estos momentos.`,
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
                            title: `El registro;${academicoffer.Oferta}  no ha sido eliminado`,
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
            hideUpdateAcademicOfferModal(){
                this.$refs.modalUpdateAcademicOffer.hide();
                this.academicofferData = {
                    Oferta: '',
                    Descripcion: '',
                    Portada: '',
                    Estado: '',
                };
            },
            
                // Event open update modal with clean form.
            showUpdateAcademicOfferModal(){
                this.$refs.modalUpdateAcademicOffer.show();
            },

                // Capture dates into form update.
            updateDataAcademicOffer(academicoffer) {
                this.academicofferData = academicoffer;
                this.showUpdateAcademicOfferModal();
            },

                // Method for update attach image in form.
            updateImage() {
                try {
                        
                        // Declare value variable.
                    this.academicofferData.Portada = this.$refs.imageUpdateAcademicOffer.files[0];

                        // Declae reader.
                    let reader = new FileReader();

                        // Function save event to use load image.
                    reader.addEventListener('load', function (){
                        this.$refs.updateImageAcademicOfferDisplay.src = reader.result;
                    }.bind(this), false);

                        // Load data reader in variable.
                    reader.readAsDataURL(this.academicofferData.Portada);
                        
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
            updateRegisterAcademicOffer: async function() {
                try {
                        let formData = new FormData();
                    formData.append('name_offer', this.academicofferData.Oferta);
                    formData.append('description', this.academicofferData.Descripcion);
                    formData.append('image', this.academicofferData.Portada);
                    formData.append('state', this.academicofferData.Estado);
                    formData.append('_method', 'put');
                    
                        // Call request in service to update data.
                    await academicOfferService.updateRegisterAcademicOffer(this.academicofferData.Id, formData);
                    
                        // Declare variable for save request load register. 
                    const data = await academicOfferService.loadRegisterAcademicOffer();

                        // Save data in registers.
                    this.registers = data.data.data;
                    
                    this.hideUpdateAcademicOfferModal();

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
                        this.hideUpdateAcademicOfferModal();
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
