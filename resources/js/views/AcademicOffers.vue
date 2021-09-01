<template>
    <!-- Begin page content. -->
<div class="container-fluid">

            <!-- Page heading. -->
    <div class="d-sm-flex align-items-center justify-content-center mb-4">
        <h1 class="mb-0 text-gray-800">Oferta Academica</h1>
    </div>

        <!-- Content modal create. -->
    <b-modal ref="modalCreateAcademicOffer" hide-footer size="xl" title="Agregar Nuevo Registro">
        <div class="d-block">
                <!-- Form modal create. -->
            <form v-on:submit.prevent="createRegisterAcademicOffer">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Oferta Academica:</label>
                        <b-form-input :state="academicoffer.Oferta.length >= 1 && academicoffer.Oferta.length < 50" type="text" class="form-control" id="name" v-model="academicoffer.Oferta" placeholder="Ingresar Oferta Academica"></b-form-input>
                        <div class="invalid-feedback-validation" v-if="errors.Oferta">{{errors.Oferta[0]}}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="description">Descripcion:</label>
                        <b-form-textarea :state="academicoffer.Decripcion.length >= 1 && academicoffer.Decripcion.length < 1000" type="text" class="form-control" id="description" v-model="academicoffer.Decripcion" placeholder="Ingresar Descripcion"></b-form-textarea>                 
                        <div class="invalid-feedback-validation" v-if="errors.Decripcion">{{errors.Decripcion[0]}}</div>
                    </div>
                    <div class="form-group col-md-6">
                            <b-form-checkbox id="state" v-model="academicoffer.Estado" name="state" value="Visible" unchecked-value="Disabled">
                            ¿Desea que el contenido sea visible?
                            </b-form-checkbox>        
                    </div>
                    <div class="form-group col-md-12">
                        <label for="image">Imagen:</label>
                        <div v-if="academicoffer.Portada.name">
                            <img src="" ref="imageAcademicOfferDisplay" width="700" height="300">  
                        </div>
                        <input type="file" v-on:change="attachImage" ref="imageAcademicOffer" class="form-control" id="image"/>
                        <div class="invalid-feedback-validation" v-if="errors.Portada">{{errors.Portada[0]}}</div>                    
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
                        <label for="name">Oferta Academica:</label>
                        <b-form-input :state="academicofferData.Oferta.length >= 1 && academicofferData.Oferta.length < 50" type="text" class="form-control" id="name" v-model="academicofferData.Oferta" placeholder="Ingresar Oferta Academica"></b-form-input>
                        <div class="invalid-feedback-validation" v-if="errors.Oferta">{{errors.Oferta[0]}}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="description">Descripcion:</label>
                        <b-form-textarea :state="academicofferData.Decripcion.length >= 1 && academicofferData.Decripcion.length < 1000" type="text" class="form-control" id="description" v-model="academicofferData.Decripcion" placeholder="Ingresar Descripcion"></b-form-textarea>                 
                        <div class="invalid-feedback-validation" v-if="errors.Decripcion">{{errors.Decripcion[0]}}</div>
                    </div>
                    <div class="form-group col-md-6">
                            <b-form-checkbox id="state" v-model="academicofferData.Estado" name="state" value="Visible" unchecked-value="Disabled">
                            ¿Desea que el contenido sea visible?
                            </b-form-checkbox>        
                    </div>
                    <div class="form-group col-md-12">
                        <label for="image">Imagen:</label>
                        <div>
                            <img src="" ref="imageAcademicOfferDisplay" width="700" height="300">  
                        </div>
                        <input type="file" v-on:change="attachImage" ref="imageAcademicOffer" class="form-control" id="image"/>
                        <div class="invalid-feedback-validation" v-if="errors.Portada">{{errors.Portada[0]}}</div>                    
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

        // Import file aboutUsService that contains functions request routes.
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
                    Decripcion: '',
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
            
        },
        
            // Declare methods for use in components.
        methods: {
                // Method for attach image in form.
            attachImage() {
                try {
                    this.academicofferData.Portada = this.$refs.imageAcademicOffer.files[0];
                    let reader = new FileReader();
                    reader.addEventListener('load', function (){
                        this.$refs.imageAcademicOfferDisplay.src = reader.result;
                    }.bind(this), false);

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
                    Decripcion: '',
                    Portada: '',
                    Estado: '',
                };
            },

                // Event open new modal with clean form.
            showNewAcademicOfferModal() {
                this.$refs.modalCreateAcademicOffer.show();
            },

                // Function use for save data forma to send request.
            createRegisterAcademicOffer: async function () {
                let formData = new FormData();
                formData.append('name', this.academicofferData.Oferta);
                formData.append('description', this.academicofferData.Decripcion);
                formData.append('state', this.academicofferData.Estado);
                formData.append('image', this.academicofferData.Portada);

                try {

                    await academicOfferService.createRegisterAcademicOffer(formData);
                        // Open swet alert to indicate success.                    
                    this.$swal.fire({
                        icon: 'success',
                        title: 'Exito',
                        text: 'El registro ha sido guardado correctamente',
                    });
                        // Clean and close form.
                    this.hideNewAcademicOfferModal();
                    
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
                        this.hideNewAcademicOfferModal();
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
            loadRegisterAcademicOffer: async function() {
                try {
                    const response = await academicOfferService.loadRegisterAcademicOffer();
                        // Save data in variable.
                    this.registers = response.data.data;
                        // Show swet alert indicate succeso to load data.
                    this.$swal.fire({
                        icon: 'success',
                        title: 'El contenido ha sido cargado correctamente',
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
            deleteAcademicOfferRegister: async function(academicoffer) {

                    // Open swet dialog for question to delete register.
                this.$swal.fire({
                    icon: 'question',
                    title: `Desea eliminar: ${academicoffer.Titulo}?`,
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: `Aceptar`,
                    denyButtonText: `Cancelar`,
                        // Handling response to dialog.
                }).then((result) => {
                            // Response is true delete record.
                    if (result.isConfirmed) {
                            // Call request service.
                        academicOfferService.deleteAcademicOfferRegister(academicoffer.Id);
                            // Capture id register selected.
                        this.registers = this.registers.filter(obj => {
                            return obj.id != academicoffer.Id;
                        });
                            // Show swet alert to indicate delete name register.
                        this.$swal.fire({
                            toast: true,
                            showConfirmButton: false,
                            position: 'top-end',  
                            timer: 3000,
                            timerProgressBar: true,
                            icon: 'success',
                            title: `Se ha eliminado correctamente: ${academicoffer.Titulo}.`,
                        });
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
                            title: `Ha cancelado la operacion de eliminar: ${academicoffer.Titulo}.`
                        });
                    };
                    
                });
            },

                // Close and clear data in form update.
            hideUpdateAcademicOfferModal(){
                this.$refs.modalUpdateAcademicOffer.hide();
                this.academicofferData = {
                    Oferta: '',
                    Decripcion: '',
                    Portada: '',
                    Estado: '',
                };
            },

                // Event open update modal with clean form.
            showUpdateAcademicOfferModal(){
                this.$refs.modalUpdateAcademicOffer.show();
            },

            // Capture dates into form update.
            updateDataAcademicOffer(aboutus) {
                this.academicofferData = academicoffer;
                this.showUpdateAboutUsModal();
            },

        }
            // End declare methods.
    }
         // End export default.   
</script>
    <!-- End script. -->
