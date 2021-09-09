    <!-- Begin template. -->
<template>
    <!-- Begin page content. -->
<div class="container-fluid">

     <!-- Page heading. -->
    <div class="d-sm-flex align-items-center justify-content-center mb-4">
        <h1 class="mb-0 text-gray-800">Carousel</h1>
    </div>

    <!-- Data table. -->
    <div class="card">
            <!-- Header data table. -->
        <div class="card-body d-flex">
            <h4><span><i class="fas fa-table"></i>  Visualización de datos</span></h4>
            <button class="btn btn-success btn-sm ml-auto" @click="showNewCarouselModal"><span><i class="fa fa-plus"></i></span>Agregar Registro</button>
        </div>
            <!-- Content data table. -->
        <div class="card-body table-responsive  align-items-center justify-content-center">
            <table id="tableRegisters" class="table table-hover table-responsive table-bordered">  
                <thead class="table-dark">
                    <tr>
                        <td>Id</td>
                        <td>Titulo</td>
                        <td>Estado</td>
                        <td>Imagen</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(carousel, index) in registers" :key="index">
                        <td>{{carousel.Id}}</td>
                        <td>{{carousel.Titulo}}</td>
                        <td>{{carousel.Estado}}</td>
                        <td>
                            <img :src="`${$store.state.serverPath}/storage/${carousel.Imagen}`" class="table-image">
                        </td>
                        <td>
                            <button class="btn btn-success btn-sm" @click="updateDataCarousel(carousel)"><span class="fa fa-edit"></span></button>
                            <button class="btn btn-danger btn-sm" @click="deleteCarouselRegister(carousel)"><span class="fa fa-trash"></span></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
            <!-- End content data table. -->
    </div>
        <!--End data table. -->

        <!-- Content modal create. -->
    <b-modal ref="modalCreateCarousel" hide-footer size="xl" title="Agregar Nuevo Registro">
        <div class="d-block">
                <!-- Form modal create. -->
            <form v-on:submit.prevent="createRegisterCarousel">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="name">Titulo:</label>
                        <b-form-input :state="carouselData.Titulo.length >= 1 && carouselData.Titulo.length < 50" type="text" class="form-control" id="name" v-model="carouselData.Titulo" placeholder="Ingresar Titulo"></b-form-input>
                        <div class="invalid-feedback-validation" v-if="errors.name">{{errors.name[0]}}</div>
                    </div>
                    <div class="form-group col-md-12">
                        <b-form-checkbox id="state" v-model="carouselData.Estado" name="state" value="Visible" unchecked-value="Disabled">
                        ¿Desea que el contenido sea visible?
                        </b-form-checkbox>       
                        <div class="invalid-feedback-validation" v-if="errors.state">{{errors.state[0]}}</div>      
                    </div>
                    <div class="form-group col-md-12">
                        <label for="image">Imagen:</label>
                        <div v-if="carouselData.Imagen.name">
                            <img src="" ref="imageCarouselDisplay" width="700" height="300">  
                        </div>
                        <input type="file" v-on:change="attachImage" ref="imageCarousel" class="form-control" id="image"/>
                        <div class="invalid-feedback-validation" v-if="errors.image">{{errors.image[0]}}</div>                    
                    </div>
                </div>
                <hr>
                <div class="text-center">    
                    <button type="button" class="btn btn-default" @click="hideNewCarouselModal">Cancelar</button>
                    <button type="submit" class="btn btn-success"><span class="fa fa-check"></span>Aceptar</button>
                </div>
            </form> 
                <!-- End form modal create. -->
        </div>
    </b-modal>
        <!-- End modal create. -->

    <!-- Content modal update. -->
    <b-modal ref="modalUpdateCarousel" hide-footer size="xl" title="Modificar Registro">
        <div class="d-block">
                <!-- Form modal update. -->
            <form v-on:submit.prevent="updateRegisterCarousel">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Titulo:</label>
                        <b-form-input :state="carouselData.Titulo.length >= 1 && carouselData.Titulo.length < 50" type="text" class="form-control" id="name" v-model="carouselData.Titulo" placeholder="Ingresar Titulo"></b-form-input>
                        <div class="invalid-feedback-validation" v-if="errors.name">{{errors.name[0]}}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <b-form-checkbox id="state" v-model="carouselData.Estado" name="state" value="Visible" unchecked-value="Disabled">
                        ¿Desea que el contenido sea visible?
                        </b-form-checkbox>       
                        <div class="invalid-feedback-validation" v-if="errors.state">{{errors.state[0]}}</div>      
                    </div>
                    <div class="form-group col-md-12">
                        <label for="image">Imagen:</label>
                        <div>
                            <img :src="`${$store.state.serverPath}/storage/${carouselData.Imagen}`" ref="updateImageCarouselDisplay" width="700" height="300">  
                        </div>
                        <input type="file" v-on:change="updateImage" ref="imageUpdateCarousel" class="form-control" id="image"/>
                        <div class="invalid-feedback-validation" v-if="errors.image">{{errors.image[0]}}</div>                    
                    </div>
                </div>
                <hr>
                <div class="text-center">    
                    <button type="button" class="btn btn-default" @click="hideUpdateCarouselModal">Cancelar</button>
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
    import * as carouselService from '../services/carousel_service';
    
        // Begin export default.
    export default {

        name: 'carousel',

            // Begin data.
        data(){
            return {
                
                    // Declare registers to use to save display data.
                registers: [],

                    // Declare aboutusData to use to send data in form.
                carouselData: {
                    Titulo: '',
                    Estado: '',
                    Imagen: '',
                },

                    // Save errors to response send request.
                errors: {},
                
            };
        },
            // End data.

            // Mounted data for registers in datatable.
        mounted() {

                // Call method function to use load data.
            this.loadRegisterCarousel();

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
                    this.carouselData.Imagen = this.$refs.imageCarousel.files[0];
                    
                        // Declae reader.
                    let reader = new FileReader();
                   
                        // Function save event to use load image.
                    reader.addEventListener('load', function (){
                        this.$refs.imageCarouselDisplay.src = reader.result;
                    }.bind(this), false);

                        // Load data reader in variable.
                    reader.readAsDataURL(this.carouselData.Imagen);
                        
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
            hideNewCarouselModal() {
                this.$refs.modalCreateCarousel.hide();
                this.carouselData = {
                    Titulo: '',
                    Estado: '',
                    Imagen: '',
                };
                this.errors = {};
            },
            
                // Event open new modal with clean form create.
            showNewCarouselModal() {
                this.$refs.modalCreateCarousel.show();
            },
            
                // Function use for save data forma to send request.
            createRegisterCarousel: async function () {
                let formData = new FormData();
                formData.append('name', this.carouselData.Titulo);
                formData.append('state', this.carouselData.Estado);
                formData.append('image', this.carouselData.Imagen);

                try {
                        // Call request to create register in service.
                    await carouselService.createRegisterCarousel(formData);

                        // Open swet alert to indicate success.                    
                    this.$swal.fire({
                        icon: 'success',
                        title: 'Exito',
                        text: 'El registro ha sido guardado correctamente',
                    });
                        // Clean and close form.
                    this.hideNewCarouselModal();

                        // Declare variable for save request load register. 
                    const data = await carouselService.loadRegisterCarousel();

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
                        this.hideNewCarouselModal();
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
            loadRegisterCarousel() {
                
                    // Decalre Promise for call request load register.
                carouselService.loadRegisterCarousel().then((response)=>{
                     
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
            deleteCarouselRegister(carousel) {
                
                // Swet alert to use question delete register. 
            this.$swal.fire({
                title: `¿Desea eliminar el registro: ${carousel.Titulo}?`,
                icon: 'question',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: `Eliminar`,
                denyButtonText: `Cancelar`,
                }).then((result) => {
                        
                        // The result for question in this alert is confirmed.
                    if (result.isConfirmed) {
                            
                            // Send reqeust to use delete register.
                        carouselService.deleteCarouselRegister(carousel.Id).then((response) =>{
                                
                                // Swet alert to use indicate success.
                            this.$swal.fire({
                                icon: 'success',
                                title: `El registro: ${carousel.Titulo} ha sido eliminado correctamente.`,
                                toast: true,
                                showConfirmButton: false,
                                position: 'top-end',
                                timer: 3000,
                                timerProgressBar: true,
                            });
                                // Decalre Promise for call request load register.
                            carouselService.loadRegisterCarousel().then((response) => {
                                   // Declare variable registers to use load data in table.
                                this.registers = response.data.data;
                            });

                        }).catch((error =>{

                            // Swet alert to use indidcate error.
                        this.$swal.fire({
                                icon: 'error',
                                title: `No es posible eliminar el registro: ${carousel.Titulo} en estos momentos.`,
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
                            title: `El registro;${carousel.Titulo}  no ha sido eliminado`,
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
            hideUpdateCarouselModal(){
                this.$refs.modalUpdateCarousel.hide();
                this.carouselData = {
                    Titulo: '',
                    Estado: '',
                    Imagen: '',
                };
                this.errors = {};
            },

                // Event open update modal with clean form.
            showUpdateCarouselModal(){
                this.$refs.modalUpdateCarousel.show();
            },

                // Capture dates into form update.
            updateDataCarousel(carousel) {
                this.carouselData = {...carousel};
                this.showUpdateCarouselModal();
            },

                // Method for update attach image in form.
            updateImage() {
                try {
                        // Declare value in variable.
                    this.carouselData.Imagen = this.$refs.imageUpdateCarousel.files[0];

                        // Declae reader.
                    let reader = new FileReader();
                        
                         // Function save event to use load image.
                    reader.addEventListener('load', function (){
                        this.$refs.updateImageCarouselDisplay.src = reader.result;
                    }.bind(this), false);

                        // Load data reader in variable.
                    reader.readAsDataURL(this.carouselData.Imagen);

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
            updateRegisterCarousel: async function() {
                try {
                       let formData = new FormData();
                    formData.append('name', this.carouselData.Titulo);
                    formData.append('state', this.carouselData.Estado);
                    formData.append('image', this.carouselData.Imagen);
                    formData.append('_method', 'put');
                    
                    await carouselService.updateRegisterCarousel(this.carouselData.Id, formData);
                    
                        // Declare variable for save request load register. 
                    const data = await carouselService.loadRegisterCarousel();

                        // Save data in registers.
                    this.registers = data.data.data;
                    
                    this.hideUpdateCarouselModal();

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
                        this.hideUpdateCarouselModal();
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