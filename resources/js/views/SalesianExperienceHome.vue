    <!-- Begin template. -->
<template>
    <!-- Begin page content. -->
<div class="container-fluid">

    <!-- Page heading. -->
    <div class="d-sm-flex align-items-center justify-content-center mb-4">
        <h1 class="mb-0 text-gray-800">Vivencia Salesiana Pagina Principal</h1>
    </div>
    
        <!-- Data table. -->
    <div class="card">
            <!-- Header data table. -->
        <div class="card-body d-flex">
            <h4><span><i class="fas fa-table"></i>  Visualización de datos</span></h4>
            <button class="btn btn-success btn-sm ml-auto" @click="showNewSalesianExperienceHomeModal"><span><i class="fa fa-plus"></i></span>Agregar Registro</button>
        </div>
            <!-- Content data table. -->
        <div class="card-body table-responsive  align-items-center justify-content-center">
            <table id="tableRegisters" class="table table-hover table-responsive table-bordered">  
                <thead class="table-dark">
                    <tr>
                        <td>Id</td>
                        <td>Portada</td>
                        <td>Descripcion</td>
                        <td>Año</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(salesianexperiencehome, index) in registers" :key="index">
                        <td>{{salesianexperiencehome.Id}}</td>
                        <td>
                            <img :src="`${$store.state.serverPath}/storage/${salesianexperiencehome.Portada}`" class="table-image">
                        </td>
                        <td>{{salesianexperiencehome.Descripcion}}</td>
                        <td>{{salesianexperiencehome.Año}}</td>
                        <td>
                            <button class="btn btn-success btn-sm" @click="updateDataSalesianExperienceHome(salesianexperiencehome)"><span class="fa fa-edit"></span></button>
                            <button class="btn btn-danger btn-sm" @click="deleteSalesianExperienceHomeRegister(salesianexperiencehome)"><span class="fa fa-trash"></span></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
            <!-- End content data table. -->
    </div>
        <!--End data table. -->

        <!-- Content modal create. -->
    <b-modal ref="modalCreateSalesianExperienceHome" hide-footer size="xl" title="Agregar Nuevo Registro">
        <div class="d-block">
                <!-- Form modal create. -->
            <form v-on:submit.prevent="createRegisterSalesianExperienceHome">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="description">Descripcion:</label>
                        <b-form-textarea :state="salesianexperiencehomeData.Descripcion.length >= 1 && salesianexperiencehomeData.Descripcion.length < 1000" type="text" class="form-control" id="description" v-model="salesianexperiencehomeData.Descripcion" placeholder="Ingresar Descripcion" autocomplete="off"></b-form-textarea>                 
                        <div class="invalid-feedback-validation" v-if="errors.description">{{errors.description[0]}}</div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="year">Año:</label>
                        <b-form-input :state="salesianexperiencehomeData.Año >= 2020 && salesianexperiencehomeData.Año < 2099" type="text" class="form-control" id="year" v-model="salesianexperiencehomeData.Año" placeholder="Ingresar Año" autocomplete="off"></b-form-input>
                        <div class="invalid-feedback-validation" v-if="errors.year">{{errors.year[0]}}</div>                    
                    </div>
                    <div class="form-group col-md-12">
                        <label for="image">Imagen:</label>
                        <div v-if="salesianexperiencehomeData.Portada.name">
                            <img src="" ref="imageSalesianExperienceHomeDisplay" width="700" height="300">  
                        </div>
                        <input type="file" v-on:change="attachImage" ref="imageSalesianExperienceHome" class="form-control" id="image"/>
                        <div class="invalid-feedback-validation" v-if="errors.image">{{errors.image[0]}}</div>                    
                    </div>
                </div>
                <hr>
                <div class="text-center">    
                    <button type="button" class="btn btn-default" @click="hideNewSalesianExperienceHomeModal">Cancelar</button>
                    <button type="submit" class="btn btn-success"><span class="fa fa-check"></span>Aceptar</button>
                </div>
            </form> 
                <!-- End form modal create. -->
        </div>
    </b-modal>
        <!-- End modal create. -->

        <!-- Content modal update. -->
    <b-modal ref="modalUpdateSalesianExperienceHome" hide-footer size="xl" title="Modificar Registro">
        <div class="d-block">
                <!-- Form modal update. -->
            <form v-on:submit.prevent="updateRegisterSalesianExperienceHome">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="description">Descripcion:</label>
                        <b-form-textarea :state="salesianexperiencehomeData.Descripcion.length >= 1 && salesianexperiencehomeData.Descripcion.length < 1000" type="text" class="form-control" id="description" v-model="salesianexperiencehomeData.Descripcion" placeholder="Ingresar Descripcion" autocomplete="off"></b-form-textarea>                 
                        <div class="invalid-feedback-validation" v-if="errors.description">{{errors.description[0]}}</div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="year">Año:</label>
                        <b-form-input :state="salesianexperiencehomeData.Año >= 2020 && salesianexperiencehomeData.Año < 2099" type="text" class="form-control" id="year" v-model="salesianexperiencehomeData.Año" placeholder="Ingresar Año" autocomplete="off"></b-form-input>
                        <div class="invalid-feedback-validation" v-if="errors.year">{{errors.year[0]}}</div>                    
                    </div>
                    <div class="form-group col-md-12">
                        <label for="image">Imagen:</label>
                        <div>
                            <img :src="`${$store.state.serverPath}/storage/${salesianexperiencehomeData.Portada}`" ref="updateImageSalesianExperienceHomeDisplay" width="700" height="300">  
                        </div>
                        <input type="file" v-on:change="updateImage" ref="updateImageSalesianExperienceHome" class="form-control" id="image"/>
                        <div class="invalid-feedback-validation" v-if="errors.image">{{errors.image[0]}}</div>                    
                    </div>
                </div>
                <hr>
                <div class="text-center">    
                    <button type="button" class="btn btn-default" @click="hideUpdateSalesianExperienceHomeModal">Cancelar</button>
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
    import * as SalesianExperienceHomeService from '../services/salesianshome_service';
    
        // Begin export default.
    export default {

        name: 'salesianexperiencehome',

            // Begin data.
        data(){
            return {
                
                    // Declare registers to use to save display data.
                registers: [],

                    // Declare aboutusData to use to send data in form.
                salesianexperiencehomeData: {
                    Portada: '',
                    Descripcion: '',
                    Año: '',
                },

                    // Save errors to response send request.
                errors: {},
                
            };
        },
            // End data.

            // Mounted data for registers in datatable.
        mounted() {
                // Call method function to use load data.
            this.loadRegisterSalesianExperienceHome();
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
                    this.salesianexperiencehomeData.Portada = this.$refs.imageSalesianExperienceHome.files[0];
                    
                        // Declae reader.
                    let reader = new FileReader();
                   
                        // Function save event to use load image.
                    reader.addEventListener('load', function (){
                        this.$refs.imageSalesianExperienceHomeDisplay.src = reader.result;
                    }.bind(this), false);

                        // Load data reader in variable.
                    reader.readAsDataURL(this.salesianexperiencehomeData.Portada);
                        
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
            hideNewSalesianExperienceHomeModal() {
                this.$refs.modalCreateSalesianExperienceHome.hide();
                this.salesianexperiencehomeData = {
                    Portada: '',
                    Descripcion: '',
                    Año: '',
                };
            },
            
                // Event open new modal with clean form create.
            showNewSalesianExperienceHomeModal() {
                this.$refs.modalCreateSalesianExperienceHome.show();
            },
            
                // Function use for save data forma to send request.
            createRegisterSalesianExperienceHome: async function () {
                let formData = new FormData();
                formData.append('image', this.salesianexperiencehomeData.Portada);
                formData.append('description', this.salesianexperiencehomeData.Descripcion);
                formData.append('year', this.salesianexperiencehomeData.Año);

                try {
                        // Call request to create register in service.
                    await SalesianExperienceHomeService.createRegisterSalesianExperienceHome(formData);

                        // Open swet alert to indicate success.                    
                    this.$swal.fire({
                        icon: 'success',
                        title: 'Exito',
                        text: 'El registro ha sido guardado correctamente',
                    });
                        // Clean and close form.
                    this.hideNewSalesianExperienceHomeModal();

                        // Declare variable for save request load register. 
                    const data = await SalesianExperienceHomeService.loadRegisterSalesianExperienceHome();

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
                        this.hideNewSalesianExperienceHomeModal();
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
            loadRegisterSalesianExperienceHome() {
                
                    // Decalre Promise for call request load register.
                SalesianExperienceHomeService.loadRegisterSalesianExperienceHome().then((response)=>{
                     
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
            deleteSalesianExperienceHomeRegister(salesianexperiencehome) {
                
                // Swet alert to use question delete register. 
            this.$swal.fire({
                title: `¿Desea eliminar el registro: ${salesianexperiencehome.Id}?`,
                icon: 'question',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: `Eliminar`,
                denyButtonText: `Cancelar`,
                }).then((result) => {
                        
                        // The result for question in this alert is confirmed.
                    if (result.isConfirmed) {
                            
                            // Send reqeust to use delete register.
                        SalesianExperienceHomeService.deleteSalesianExperienceHomeRegister(salesianexperiencehome.Id).then((response) =>{
                                
                                // Swet alert to use indicate success.
                            this.$swal.fire({
                                icon: 'success',
                                title: `El registro: ${salesianexperiencehome.Id} ha sido eliminado correctamente.`,
                                toast: true,
                                showConfirmButton: false,
                                position: 'top-end',
                                timer: 3000,
                                timerProgressBar: true,
                            });
                                // Decalre Promise for call request load register.
                            SalesianExperienceHomeService.loadRegisterSalesianExperienceHome().then((response) => {
                                
                                    // Declare variable registers to use load data in table.
                                this.registers = response.data.data;

                            });

                        }).catch((error =>{

                            // Swet alert to use indidcate error.
                        this.$swal.fire({
                                icon: 'error',
                                title: `No es posible eliminar el registro: ${salesianexperiencehome.Id} en estos momentos.`,
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
                            title: `El registro; ${salesianexperiencehome.Id}  no ha sido eliminado`,
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
            hideUpdateSalesianExperienceHomeModal(){
                this.$refs.modalUpdateSalesianExperienceHome.hide();
                this.salesianexperiencehomeData = {
                    Portada: '',
                    Descripcion: '',
                    Año: '',
                };
            },

                // Event open update modal with clean form.
            showUpdateSalesianExperienceHomeModal(){
                this.$refs.modalUpdateSalesianExperienceHome.show();
            },

                // Capture dates into form update.
            updateDataSalesianExperienceHome(salesianexperiencehome) {
                this.salesianexperiencehomeData = {...salesianexperiencehome};
                this.showUpdateSalesianExperienceHomeModal();
            },

                // Method for update attach image in form.
            updateImage() {
                try {
                        // Declare value in variable.
                    this.salesianexperiencehomeData.Portada = this.$refs.updateImageSalesianExperienceHome.files[0];

                        // Declae reader.
                    let reader = new FileReader();
                        
                         // Function save event to use load image.
                    reader.addEventListener('load', function (){
                        this.$refs.updateImageSalesianExperienceHomeDisplay.src = reader.result;
                    }.bind(this), false);

                        // Load data reader in variable.
                    reader.readAsDataURL(this.salesianexperiencehomeData.Portada);

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
            updateRegisterSalesianExperienceHome: async function() {
                try {
                        let formData = new FormData();
                    formData.append('image', this.salesianexperiencehomeData.Portada);
                    formData.append('description', this.salesianexperiencehomeData.Descripcion);
                    formData.append('year', this.salesianexperiencehomeData.Año);
                    formData.append('_method', 'put');
                    
                        // Call request in service to update data.
                    await SalesianExperienceHomeService.updateRegisterSalesianExperienceHome(this.salesianexperiencehomeData.Id, formData);
                    
                        // Declare variable for save request load register. 
                    const data = await SalesianExperienceHomeService.loadRegisterSalesianExperienceHome();

                        // Save data in registers.
                    this.registers = data.data.data;
                    
                    this.hideUpdateSalesianExperienceHomeModal();

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
                        this.hideUpdateSalesianExperienceHomeModal();
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