    <!-- Begin template. -->
<template>
    <!-- Begin page content. -->
<div class="container-fluid">

    <!-- Page heading. -->
    <div class="d-sm-flex align-items-center justify-content-center mb-4">
        <h1 class="mb-0 text-gray-800">Vivencias Salesianas Eventos</h1>
    </div>
    
        <!-- Data table. -->
    <div class="card">
            <!-- Header data table. -->
        <div class="card-body d-flex">
            <h4><span><i class="fas fa-table"></i>  Visualización de datos</span></h4>
            <button class="btn btn-success btn-sm ml-auto" @click="showNewSalesianExperienceModal"><span><i class="fa fa-plus"></i></span>Agregar Registro</button>
        </div>
            <!-- Content data table. -->
        <div class="card-body table-responsive  align-items-center justify-content-center">
            <table id="tableRegisters" class="table table-hover table-responsive table-bordered">  
                <thead class="table-dark">
                    <tr>
                        <td>Id</td>
                        <td>Evento</td>
                        <td>Descripcion</td>
                        <td>Fecha</td>
                        <td>Lugar</td>
                        <td>Portada</td>
                        <td>Vivencia</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(salesianexperience, index) in registers" :key="index">
                        <td>{{salesianexperience.Id}}</td>
                        <td>{{salesianexperience.Evento}}</td>
                        <td>{{salesianexperience.Descripcion}}</td>
                        <td>{{salesianexperience.Fecha}}</td>
                        <td>{{salesianexperience.Lugar}}</td>
                        <td>
                            <img :src="`${$store.state.serverPath}/storage/${salesianexperience.Portada}`" class="table-image">
                        </td>
                        <td>{{salesianexperience.Vivencia}}</td>
                        <td>
                            <button class="btn btn-success btn-sm" @click="updateDataSalesianExperience(salesianexperience)"><span class="fa fa-edit"></span></button>
                            <button class="btn btn-danger btn-sm" @click="deleteSalesianExperienceRegister(salesianexperience)"><span class="fa fa-trash"></span></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
            <!-- End content data table. -->
    </div>
        <!--End data table. -->

        <!-- Content modal create. -->
    <b-modal ref="modalCreateSalesianExperience" hide-footer size="xl" title="Agregar Nuevo Registro">
        <div class="d-block">
                <!-- Form modal create. -->
            <form v-on:submit.prevent="createRegisterSalesianExperience">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name_event">Evento:</label>
                        <b-form-input :state="salesianexperienceData.Evento.length >= 1 && salesianexperienceData.Evento.length < 50" type="text" class="form-control" id="name_event" v-model="salesianexperienceData.Evento" placeholder="Ingresar nombre del Evento" autocomplete="off"></b-form-input>
                        <div class="invalid-feedback-validation" v-if="errors.name_event">{{errors.name_event[0]}}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="description">Descripcion:</label>
                        <b-form-textarea :state="salesianexperienceData.Descripcion.length >= 1 && salesianexperienceData.Descripcion.length < 1000" type="text" class="form-control" id="description" v-model="salesianexperienceData.Descripcion" placeholder="Ingresar Descripcion" autocomplete="off"></b-form-textarea>                 
                        <div class="invalid-feedback-validation" v-if="errors.description">{{errors.description[0]}}</div>
                    </div>
                    <div class="col-md-6">
                        <label for="date-pick">Fecha del Evento:</label>
                        <b-form-datepicker style="display: contents" :state="salesianexperienceData.Fecha != ''" placeholder="Seleccione una fecha para el evento" :min="min" :max="max" class="mb-2" menu-class="w-80" calendar-width="100%" id="date-pick" v-model="salesianexperienceData.Fecha"></b-form-datepicker>
                        <div class="invalid-feedback-validation" v-if="errors.date">{{errors.date[0]}}</div>                    
                    </div>
                    <div class="form-group col-md-6">
                        <label for="place">Lugar:</label>
                        <b-form-input :state="salesianexperienceData.Lugar.length >= 1 && salesianexperienceData.Lugar.length < 50" type="text" class="form-control" id="place" v-model="salesianexperienceData.Lugar" placeholder="Ingresar el luagr de realizacion del evento." autocomplete="off"></b-form-input>
                        <div class="invalid-feedback-validation" v-if="errors.place">{{errors.place[0]}}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="type">Vivencia:</label>
                        <b-form-select :state="salesianexperienceData.Vivencia != ''" v-model="salesianexperienceData.Vivencia" :options="options" id="type" multiple :select-size="4"></b-form-select>
                        <div class="invalid-feedback-validation" v-if="errors.type">{{errors.type[0]}}</div> 
                    </div>
                    <div class="form-group col-md-12">
                        <label for="image">Imagen:</label>
                        <div v-if="salesianexperienceData.Portada.name">
                            <img src="" ref="imageSalesianExperienceDisplay" width="700" height="300">  
                        </div>
                        <input accept="image/png,image/jpeg" type="file" v-on:change="attachImage" ref="imageSalesianExperience" class="form-control" id="image"/>
                        <div class="invalid-feedback-validation" v-if="errors.image">{{errors.image[0]}}</div>                    
                    </div>
                </div>
                <hr>
                <div class="text-center">    
                    <button type="button" class="btn btn-default" @click="hideNewSalesianExperienceModal">Cancelar</button>
                    <button type="submit" class="btn btn-success"><span class="fa fa-check"></span>Aceptar</button>
                </div>
            </form> 
                <!-- End form modal create. -->
        </div>
    </b-modal>
        <!-- End modal create. -->

        <!-- Content modal update. -->
    <b-modal ref="modalUpdateSalesianExperience" hide-footer size="xl" title="Modificar Registro">
        <div class="d-block">
                <!-- Form modal update. -->
            <form v-on:submit.prevent="updateRegisterSalesianExperience">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name_event">Evento:</label>
                        <b-form-input :state="salesianexperienceData.Evento.length >= 1 && salesianexperienceData.Evento.length < 50" type="text" class="form-control" id="name_event" v-model="salesianexperienceData.Evento" placeholder="Ingresar nombre del Evento" autocomplete="off"></b-form-input>
                        <div class="invalid-feedback-validation" v-if="errors.name_event">{{errors.name_event[0]}}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="description">Descripcion:</label>
                        <b-form-textarea :state="salesianexperienceData.Descripcion.length >= 1 && salesianexperienceData.Descripcion.length < 1000" type="text" class="form-control" id="description" v-model="salesianexperienceData.Descripcion" placeholder="Ingresar Descripcion" autocomplete="off"></b-form-textarea>                 
                        <div class="invalid-feedback-validation" v-if="errors.description">{{errors.description[0]}}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="date">Fecha del Evento:</label>
                        <b-form-datepicker style="display: contents" :state="salesianexperienceData.Fecha != ''" placeholder="Seleccione una fecha para el evento" :min="min" :max="max" class="mb-2" menu-class="w-80" calendar-width="100%" id="date-pick" v-model="salesianexperienceData.Fecha"></b-form-datepicker>
                        <div class="invalid-feedback-validation" v-if="errors.date">{{errors.date[0]}}</div>                    
                    </div>
                    <div class="form-group col-md-6">
                        <label for="place">Lugar:</label>
                        <b-form-input :state="salesianexperienceData.Lugar.length >= 1 && salesianexperienceData.Lugar.length < 50" type="text" class="form-control" id="place" v-model="salesianexperienceData.Lugar" placeholder="Ingresar el luagr de realizacion del evento." autocomplete="off"></b-form-input>
                        <div class="invalid-feedback-validation" v-if="errors.place">{{errors.place[0]}}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="type">Vivencia:</label>
                        <b-form-select :state="salesianexperienceData.Vivencia != ''" v-model="salesianexperienceData.Vivencia" :options="options" id="type" multiple :select-size="4"></b-form-select>
                        <div class="invalid-feedback-validation" v-if="errors.type">{{errors.type[0]}}</div> 
                    </div>
                    <div class="form-group col-md-12">
                        <label for="image">Imagen:</label>
                        <div>
                            <img :src="`${$store.state.serverPath}/storage/${salesianexperienceData.Portada}`" ref="updateImageSalesianExperienceDisplay" width="700" height="300">  
                        </div>
                        <input accept="image/png,image/jpeg" type="file" v-on:change="updateImage" ref="updateImageSalesianExperience" class="form-control" id="image"/>
                        <div class="invalid-feedback-validation" v-if="errors.image">{{errors.image[0]}}</div>                    
                    </div>
                </div>
                <hr>
                <div class="text-center">    
                    <button type="button" class="btn btn-default" @click="hideUpdateSalesianExperienceModal">Cancelar</button>
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
    import * as salesianexperienceService from '../services/salesianexperience_service';
    
        // Begin export default.
    export default {

        name: 'salesianexperience',

            // Begin data.
        data(){

                // Save actual date in variable.
            const now = new Date()

                // Save covert date now in determinate format (YYYY-MM-DD).
            const today = new Date(now.getFullYear(), now.getMonth(), now.getDate())

                // Save actual date in variable.
            const minDate = new Date(today)

                // Config the minimum value to select date (the minimum value is now).
            minDate.setMonth(minDate.getMonth())
            minDate.setDate(minDate.getDate())

                // Save actual date in variable.
            const maxDate = new Date(today)

                 // Config the maximum value to select date (the maximum value is December 31).
            maxDate.setMonth(11)
            maxDate.setDate(31)
            
            return {

                    // Declare min value for component datepicker.
                min: minDate,
                
                    // Declare max value for component datepicker.
                max: maxDate,
                
                    // Declare registers to use to save display data.
                registers: [],

                    // Declare aboutusData to use to send data in form.
                salesianexperienceData: {
                    Evento: '',
                    Descripcion: '',
                    Fecha: '',
                    Lugar: '',
                    Portada: '',
                    Vivencia: '',
                },

                    // Save default variables for use select component.    
                options: [
                    { value: 'Coro', text: 'Coro' },
                    { value: 'Orquesta', text: 'Orquesta' },
                    { value: 'Selecciones deportivas', text: 'Selecciones Deportivas' },
                    { value: 'Coreografia', text: 'Coreografia' },
                    { value: 'Oratorio', text: 'Oratorio' },
                ],

                    // Save errors to response send request.
                errors: {},
                
            };
        },
            // End data.

            // Mounted data for registers in datatable.
        mounted() {
                // Call method function to use load data.
            this.loadRegisterSalesianExperience();
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
                    this.salesianexperienceData.Portada = this.$refs.imageSalesianExperience.files[0];
                    
                        // Declae reader.
                    let reader = new FileReader();
                   
                        // Function save event to use load image.
                    reader.addEventListener('load', function (){
                        this.$refs.imageSalesianExperienceDisplay.src = reader.result;
                    }.bind(this), false);

                        // Load data reader in variable.
                    reader.readAsDataURL(this.salesianexperienceData.Portada);
                        
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
            hideNewSalesianExperienceModal() {
                this.$refs.modalCreateSalesianExperience.hide();
                this.salesianexperienceData = {
                    Evento: '',
                    Descripcion: '',
                    Fecha: '',
                    Lugar: '',
                    Portada: '',
                    Vivencia: '',
                };
                this.errors = {};
            },
            
                // Event open new modal with clean form create.
            showNewSalesianExperienceModal() {
                this.$refs.modalCreateSalesianExperience.show();
            },
            
                // Function use for save data forma to send request.
            createRegisterSalesianExperience: async function () {
                let formData = new FormData();
                formData.append('name_event', this.salesianexperienceData.Evento);
                formData.append('description', this.salesianexperienceData.Descripcion);
                formData.append('date', this.salesianexperienceData.Fecha);
                formData.append('place', this.salesianexperienceData.Lugar);
                formData.append('image', this.salesianexperienceData.Portada);
                formData.append('type', this.salesianexperienceData.Vivencia);

                try {
                        // Call request to create register in service.
                    await salesianexperienceService.createRegisterSalesianExperience(formData);

                        // Open swet alert to indicate success.                    
                    this.$swal.fire({
                        icon: 'success',
                        title: 'Exito',
                        text: 'El registro ha sido guardado correctamente',
                    });
                        // Clean and close form.
                    this.hideNewSalesianExperienceModal();

                        // Declare variable for save request load register. 
                    const data = await salesianexperienceService.loadRegisterSalesianExperience();

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
                        this.hideNewSalesianExperienceModal();
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
            loadRegisterSalesianExperience() {
                
                    // Decalre Promise for call request load register.
                salesianexperienceService.loadRegisterSalesianExperience().then((response)=>{
                     
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
            deleteSalesianExperienceRegister(salesianexperience) {
                
                // Swet alert to use question delete register. 
            this.$swal.fire({
                title: `¿Desea eliminar el registro: ${salesianexperience.Evento}?`,
                icon: 'question',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: `Eliminar`,
                denyButtonText: `Cancelar`,
                }).then((result) => {
                        
                        // The result for question in this alert is confirmed.
                    if (result.isConfirmed) {
                            
                            // Send reqeust to use delete register.
                        salesianexperienceService.deleteSalesianExperienceRegister(salesianexperience.Id).then((response) =>{
                                
                                // Swet alert to use indicate success.
                            this.$swal.fire({
                                icon: 'success',
                                title: `El registro: ${salesianexperience.Evento} ha sido eliminado correctamente.`,
                                toast: true,
                                showConfirmButton: false,
                                position: 'top-end',
                                timer: 3000,
                                timerProgressBar: true,
                            });
                                // Decalre Promise for call request load register.
                            salesianexperienceService.loadRegisterSalesianExperience().then((response) => {
                                
                                    // Declare variable registers to use load data in table.
                                this.registers = response.data.data;

                            });

                        }).catch((error =>{

                            // Swet alert to use indidcate error.
                        this.$swal.fire({
                                icon: 'error',
                                title: `No es posible eliminar el registro: ${salesianexperience.Evento} en estos momentos.`,
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
                            title: `El registro;${salesianexperience.Evento}  no ha sido eliminado`,
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
            hideUpdateSalesianExperienceModal(){
                this.$refs.modalUpdateSalesianExperience.hide();
                this.salesianexperienceData = {
                    Evento: '',
                    Descripcion: '',
                    Fecha: '',
                    Lugar: '',
                    Portada: '',
                    Vivencia: '',
                };
                this.errors = {};
            },

                // Event open update modal with clean form.
            showUpdateSalesianExperienceModal(){
                this.$refs.modalUpdateSalesianExperience.show();
            },

                // Capture dates into form update.
            updateDataSalesianExperience(salesianexperience) {
                this.salesianexperienceData = {...salesianexperience};
                this.showUpdateSalesianExperienceModal();
            },

                // Method for update attach image in form.
            updateImage() {
                try {
                        // Declare value in variable.
                    this.salesianexperienceData.Portada = this.$refs.updateImageSalesianExperience.files[0];

                        // Declae reader.
                    let reader = new FileReader();
                        
                         // Function save event to use load image.
                    reader.addEventListener('load', function (){
                        this.$refs.updateImageSalesianExperienceDisplay.src = reader.result;
                    }.bind(this), false);

                        // Load data reader in variable.
                    reader.readAsDataURL(this.salesianexperienceData.Portada);

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
            updateRegisterSalesianExperience: async function() {
                try {
                        let formData = new FormData();
                    formData.append('name_event', this.salesianexperienceData.Evento);
                    formData.append('description', this.salesianexperienceData.Descripcion);
                    formData.append('date', this.salesianexperienceData.Fecha);
                    formData.append('place', this.salesianexperienceData.Lugar);
                    formData.append('image', this.salesianexperienceData.Portada);
                    formData.append('type', this.salesianexperienceData.Vivencia);
                    formData.append('_method', 'put');
                    
                        // Call request in service to update data.
                    await salesianexperienceService.updateRegisterSalesianExperience(this.salesianexperienceData.Id, formData);
                    
                        // Declare variable for save request load register. 
                    const data = await salesianexperienceService.loadRegisterSalesianExperience();

                        // Save data in registers.
                    this.registers = data.data.data;
                    
                    this.hideUpdateSalesianExperienceModal();

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
                        this.hideUpdateSalesianExperienceModal();
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
