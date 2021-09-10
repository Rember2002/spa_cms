    <!-- Begin template. -->
<template>
    <!-- Begin page content. -->
<div class="container-fluid">

    <!-- Page heading. -->
    <div class="d-sm-flex align-items-center justify-content-center mb-4">
        <h1 class="mb-0 text-gray-800">Integrantes de Comisiones Estudiantiles</h1>
    </div>
    
        <!-- Data table. -->
    <div class="card">
            <!-- Header data table. -->
        <div class="card-body d-flex">
            <h4><span><i class="fas fa-table"></i>  Visualización de datos</span></h4>
            <button class="btn btn-success btn-sm ml-auto" @click="showNewIntegrantModal"><span><i class="fa fa-plus"></i></span>Agregar Registro</button>
        </div>
            <!-- Content data table. -->
        <div class="card-body table-responsive  align-items-center justify-content-center">
            <table id="tableRegisters" class="table table-hover table-responsive table-bordered">  
                <thead class="table-dark">
                    <tr>
                        <td>Id</td>
                        <td>Integrante</td>
                        <td>Perfil</td>
                        <td>Comision</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(integrant, index) in registers" :key="index">
                        <td>{{integrant.Id}}</td>
                        <td>{{integrant.Integrante}}</td>
                        <td>
                            <img :src="`${$store.state.serverPath}/storage/${integrant.Perfil}`" class="integrant-image">
                        </td>
                        <td>Comision de {{integrant.Comision}} perteneciente al Consejo Estudiantil {{integrant.Consejo}}</td>
                        <td>
                            <button class="btn btn-success btn-sm" @click="updateDataIntegrant(integrant)"><span class="fa fa-edit"></span></button>
                            <button class="btn btn-danger btn-sm" @click="deleteIntegrantRegister(integrant)"><span class="fa fa-trash"></span></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
            <!-- End content data table. -->
    </div>
        <!--End data table. -->

        <!-- Content modal create. -->
    <b-modal ref="modalCreateIntegrant" hide-footer size="xl" title="Agregar Nuevo Registro">
        <div class="d-block">
                <!-- Form modal create. -->
            <form v-on:submit.prevent="createRegisterIntegrant">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name_integrant">Nombre Integrante:</label>
                        <b-form-input :state="integrantData.Integrante.length >= 1 && integrantData.Integrante.length < 50" type="text" class="form-control" id="name_integrant" v-model="integrantData.Integrante" placeholder="Ingresar Nombre de Integrante" autocomplete="off"></b-form-input>
                        <div class="invalid-feedback-validation" v-if="errors.name_integrant">{{errors.name_integrant[0]}}</div>
                    </div>
                    <div class="form-group col-md-6" >
                        <label for="id_commission">Comision:</label>
                        <br>
                        <b-form-select placeholder="Seleccione una opcion" v-model="integrantData.ComisionId" :state="integrantData.ComisionId != ''" class="form-select" id="id_commission">
                            <b-form-select-option value='' disabled selected>Selecciona una opción</b-form-select-option>
                            <b-form-select-option v-for="(integrant, index) in options" :key="index" :value="integrant.Id">Comision de {{integrant.Comision}} del Consejo Estudiantil {{integrant.Año}}</b-form-select-option>
                        </b-form-select>
                        <div class="invalid-feedback-validation" v-if="errors.id_commission">{{errors.id_commission[0]}}</div>                    
                    </div>
                    <div class="form-group col-md-12">
                        <label for="image">Perfil:</label>
                        <div v-if="integrantData.Perfil.name">
                            <img src="" ref="imageIntegrantDisplay" width="225" height="225">  
                        </div>
                        <input accept="image/png,image/jpeg" type="file" v-on:change="attachImage" ref="imageIntegrant" class="form-control" id="image"/>
                        <div class="invalid-feedback-validation" v-if="errors.image">{{errors.image[0]}}</div>                    
                    </div>
                </div>
                <hr>
                <div class="text-center">    
                    <button type="button" class="btn btn-default" @click="hideNewIntegrantModal">Cancelar</button>
                    <button type="submit" class="btn btn-success"><span class="fa fa-check"></span>Aceptar</button>
                </div>
            </form> 
                <!-- End form modal create. -->
        </div>
    </b-modal>
        <!-- End modal create. -->

        <!-- Content modal update. -->
    <b-modal ref="modalUpdateIntegrant" hide-footer size="xl" title="Modificar Registro">
        <div class="d-block">
                <!-- Form modal update. -->
            <form v-on:submit.prevent="updateRegisterIntegrant">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name_integrant">Nombre Integrante:</label>
                        <b-form-input :state="integrantData.Integrante.length >= 1 && integrantData.Integrante.length < 50" type="text" class="form-control" id="name_integrant" v-model="integrantData.Integrante" placeholder="Ingresar Nombre de Integrante" autocomplete="off"></b-form-input>
                        <div class="invalid-feedback-validation" v-if="errors.name_integrant">{{errors.name_integrant[0]}}</div>
                    </div>
                    <div class="form-group col-md-6" >
                        <label for="id_commission">Comision:</label>
                        <br>
                        <b-form-select placeholder="Seleccione una opcion" v-model="integrantData.ComisionId" :state="integrantData.ComisionId != ''" class="form-select" id="id_commission">
                            <b-form-select-option value='' disabled selected>Selecciona una opción</b-form-select-option>
                            <b-form-select-option v-for="(integrant, index) in options" :key="index" :value="integrant.Id">Comision de {{integrant.Comision}} del Consejo Estudiantil {{integrant.Año}}</b-form-select-option>
                        </b-form-select>
                        <h1>{{integrantData.ComisionId}}</h1>
                        <div class="invalid-feedback-validation" v-if="errors.id_commission">{{errors.id_commission[0]}}</div>                    
                    </div>
                    <div class="form-group col-md-12">
                        <label for="image">Perfil:</label>
                        <div>
                            <img :src="`${$store.state.serverPath}/storage/${integrantData.Perfil}`" ref="updateImageIntegrantDisplay" width="225" height="225">  
                        </div>
                        <input accept="image/png,image/jpeg" type="file" v-on:change="updateImage" ref="updateImageIntegrant" class="form-control" id="image"/>
                        <div class="invalid-feedback-validation" v-if="errors.image">{{errors.image[0]}}</div>                    
                    </div>
                </div>
                <hr>
                <div class="text-center">    
                    <button type="button" class="btn btn-default" @click="hideUpdateIntegrantModal">Cancelar</button>
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
    import * as integrantService from '../services/instegrant_service';

         // Import file aboutUsService that contains functions request routes.
    import * as commissionService from '../services/commission_service';
    
        // Begin export default.
    export default {

        name: 'integrant',
        
            // Begin data.
        data(){
            return {
                
                    // Declare registers to use to save display data.
                registers: [],

                    // Declare aboutusData to use to send data in form.
                integrantData: {
                    Integrante: '',
                    Perfil: '',
                    ComisionId: '',
                },

                    // Save default variables for use select component.    
                options: [],

                    // Save errors to response send request.
                errors: {},
                
            };
        },
            // End data.

            // Mounted data for registers in datatable.
        mounted() {

                // Call method function to use load data.
            this.loadRegisterIntegrant();

                // Call method fuction to use load data in component select.
            this.loadRegisterCommission();

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
                    this.integrantData.Perfil = this.$refs.imageIntegrant.files[0];
                    
                        // Declae reader.
                    let reader = new FileReader();
                   
                        // Function save event to use load image.
                    reader.addEventListener('load', function (){
                        this.$refs.imageIntegrantDisplay.src = reader.result;
                    }.bind(this), false);

                        // Load data reader in variable.
                    reader.readAsDataURL(this.integrantData.Perfil);
                        
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
            hideNewIntegrantModal() {
                this.$refs.modalCreateIntegrant.hide();
                this.integrantData = {
                    Integrante: '',
                    Perfil: '',
                    Comision: '',
                    ComisionId: '',
                };
                this.errors = {};
            },
            
                // Event open new modal with clean form create.
            showNewIntegrantModal() {
                this.$refs.modalCreateIntegrant.show();
            },
            
                // Function use for save data forma to send request.
            createRegisterIntegrant: async function () {
                let formData = new FormData();
                formData.append('name_integrant', this.integrantData.Integrante);
                formData.append('id_commission', this.integrantData.ComisionId);
                formData.append('image', this.integrantData.Perfil);

                try {
                        // Call request to create register in service.
                    await integrantService.createRegisterIntegrant(formData);

                        // Open swet alert to indicate success.                    
                    this.$swal.fire({
                        icon: 'success',
                        title: 'Exito',
                        text: 'El registro ha sido guardado correctamente',
                    });
                        // Clean and close form.
                    this.hideNewIntegrantModal();

                        // Declare variable for save request load register. 
                    const data = await integrantService.loadRegisterIntegrant();

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
                        this.hideNewIntegrantModal();
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
            loadRegisterIntegrant() {
                
                    // Decalre Promise for call request load register.
                integrantService.loadRegisterIntegrant().then((response)=>{
                     
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
                        showConfirmButton: false,options
                        });
                });
                

            },

                // Function use to load and draw data in component select.
            loadRegisterCommission() {
                
                    // Declare Promise for call request load data in select component.
                commissionService.loadRegisterCommission().then((response) => {

                        // Declare variable registers to use load data in select.
                    this.options = response.data.data;

                }).catch((error) => {
                    
                     // Declare variable registers to use load data in table.
                    this.options = response.data.data;

                        // Swet alert to use indicate warning.
                    this.$swal.fire({
                        icon: 'warning',
                        title: `No ha sido posible cargar las Comisiones`,
                        toast: true,
                        showConfirmButton: false,
                        position: 'top-end',
                        timer: 3000,
                        timerProgressBar: true,
                    });
                });
            },

                // Function use to delete register select.
            deleteIntegrantRegister(integrant) {
                
                // Swet alert to use question delete register. 
            this.$swal.fire({
                title: `¿Desea eliminar el registro: ${integrant.Integrante}?`,
                icon: 'question',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: `Eliminar`,
                denyButtonText: `Cancelar`,
                }).then((result) => {
                        
                        // The result for question in this alert is confirmed.
                    if (result.isConfirmed) {
                            
                            // Send reqeust to use delete register.
                        integrantService.deleteIntegrantRegister(integrant.Id).then((response) =>{
                                
                                // Swet alert to use indicate success.
                            this.$swal.fire({
                                icon: 'success',
                                title: `El registro: ${integrant.Integrante} ha sido eliminado correctamente.`,
                                toast: true,
                                showConfirmButton: false,
                                position: 'top-end',
                                timer: 3000,
                                timerProgressBar: true,
                            });
                                // Decalre Promise for call request load register.
                            integrantService.loadRegisterIntegrant().then((response) => {
                                
                                    // Declare variable registers to use load data in table.
                                this.registers = response.data.data;

                            });

                        }).catch((error =>{

                            // Swet alert to use indidcate error.
                        this.$swal.fire({
                                icon: 'error',
                                title: `No es posible eliminar el registro: ${integrant.Integrante} en estos momentos.`,
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
                            title: `El registro: ${integrant.Integrante}  no ha sido eliminado`,
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
            hideUpdateIntegrantModal(){
                this.$refs.modalUpdateIntegrant.hide();
                this.integrantData = {
                    Integrante: '',
                    Perfil: '',
                    Comision: '',
                    ComisionId: '',
                };
                this.errors = {};
            },

                // Event open update modal with clean form.
            showUpdateIntegrantModal(){
                this.$refs.modalUpdateIntegrant.show();
            },

                // Capture dates into form update.
            updateDataIntegrant(integrant) {
                this.integrantData = {...integrant};
                this.showUpdateIntegrantModal();
            },

                // Method for update attach image in form.
            updateImage() {
                try {
                        // Declare value in variable.
                    this.integrantData.Perfil = this.$refs.updateImageIntegrant.files[0];

                        // Declae reader.
                    let reader = new FileReader();
                        
                         // Function save event to use load image.
                    reader.addEventListener('load', function (){
                        this.$refs.updateImageIntegrantDisplay.src = reader.result;
                    }.bind(this), false);

                        // Load data reader in variable.
                    reader.readAsDataURL(this.integrantData.Perfil);

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
            updateRegisterIntegrant: async function() {
                try {
                        let formData = new FormData();
                    formData.append('name_integrant', this.integrantData.Integrante);
                    formData.append('id_commission', this.integrantData.ComisionId);
                    formData.append('image', this.integrantData.Perfil);
                    formData.append('_method', 'put');
                    
                        // Call request in service to update data.
                    await integrantService.updateRegisterIntegrant(this.integrantData.Id, formData);
                    
                        // Declare variable for save request load register. 
                    const data = await integrantService.loadRegisterIntegrant();

                        // Save data in registers.
                    this.registers = data.data.data;
                    
                    this.hideUpdateIntegrantModal();

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
                        this.hideUpdateIntegrantModal();
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