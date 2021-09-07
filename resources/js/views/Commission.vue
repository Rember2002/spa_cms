    <!-- Begin template. -->
<template>
    <!-- Begin page content. -->
<div class="container-fluid">

    <!-- Page heading. -->
    <div class="d-sm-flex align-items-center justify-content-center mb-4">
        <h1 class="mb-0 text-gray-800">Comisiones Estudiantiles</h1>
    </div>
    
        <!-- Data table. -->
    <div class="card">
            <!-- Header data table. -->
        <div class="card-body d-flex">
            <h4><span><i class="fas fa-table"></i>  Visualización de datos</span></h4>
            <button class="btn btn-success btn-sm ml-auto" @click="showNewCommissionModal"><span><i class="fa fa-plus"></i></span>Agregar Registro</button>
        </div>
            <!-- Content data table. -->
        <div class="card-body table-responsive  align-items-center justify-content-center">
            <table id="tableRegisters" class="table table-hover table-responsive table-bordered">  
                <thead class="table-dark">
                    <tr>
                        <td>Id</td>
                        <td>Comision</td>
                        <td>Consejo</td>
                        <td>Imagen</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(commission, index) in registers" :key="index">
                        <td>{{commission.Id}}</td>
                        <td>{{commission.Comision}}</td>
                        <td>Consejo Estudiantil: {{commission.Año}}</td>
                        <td>
                            <img :src="`${$store.state.serverPath}/storage/${commission.Imagen}`" class="table-image">
                        </td>
                        <td>
                            <button class="btn btn-success btn-sm" @click="updateDataCommission(commission)"><span class="fa fa-edit"></span></button>
                            <button class="btn btn-danger btn-sm" @click="deleteCommissionRegister(commission)"><span class="fa fa-trash"></span></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
            <!-- End content data table. -->
    </div>
        <!--End data table. -->

        <!-- Content modal create. -->
    <b-modal ref="modalCreateCommission" hide-footer size="xl" title="Agregar Nuevo Registro">
        <div class="d-block">
                <!-- Form modal create. -->
            <form v-on:submit.prevent="createRegisterCommission">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name_commission">Nombre Comision:</label>
                        <b-form-input :state="commissionData.Comision.length >= 1 && commissionData.Comision.length < 50" type="text" class="form-control" id="name_commission" v-model="commissionData.Comision" placeholder="Ingresar Titulo" autocomplete="off"></b-form-input>
                        <div class="invalid-feedback-validation" v-if="errors.name_commission">{{errors.name_commission[0]}}</div>
                    </div>
                    <div class="form-group col-md-6" >
                        <label for="id_student_council">Consejo Estudiantil:</label>
                        <br>
                        <b-form-select placeholder="Seleccione una opcion" v-model="commissionData.Consejo" :state="commissionData.Consejo != ''" class="form-select" id="id_student_council" v-for="(commission, index) in options" :key="index">
                            <b-form-select-option value="null" disabled selected>Selecciona una opción</b-form-select-option>
                            <b-form-select-option :value="commission.Id">{{commission.Año}}</b-form-select-option>
                        </b-form-select>
                        <div class="invalid-feedback-validation" v-if="errors.id_student_council">{{errors.id_student_council[0]}}</div>                    
                    </div>
                    <div class="form-group col-md-12">
                        <label for="image">Imagen:</label>
                        <div v-if="commissionData.Imagen.name">
                            <img src="" ref="imageCommissionDisplay" width="700" height="300">  
                        </div>
                        <input type="file" v-on:change="attachImage" ref="imageCommission" class="form-control" id="image"/>
                        <div class="invalid-feedback-validation" v-if="errors.image">{{errors.image[0]}}</div>                    
                    </div>
                </div>
                <hr>
                <div class="text-center">    
                    <button type="button" class="btn btn-default" @click="hideNewCommissionModal">Cancelar</button>
                    <button type="submit" class="btn btn-success"><span class="fa fa-check"></span>Aceptar</button>
                </div>
            </form> 
                <!-- End form modal create. -->
        </div>
    </b-modal>
        <!-- End modal create. -->

        <!-- Content modal update. -->
    <b-modal ref="modalUpdateCommission" hide-footer size="xl" title="Modificar Registro">
        <div class="d-block">
                <!-- Form modal update. -->
            <form v-on:submit.prevent="updateRegisterCommission">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name_commission">Nombre Comision:</label>
                        <b-form-input :state="commissionData.Comision.length >= 1 && commissionData.Comision.length < 50" type="text" class="form-control" id="name_commission" v-model="commissionData.Comision" placeholder="Ingresar Titulo" autocomplete="off"></b-form-input>
                        <div class="invalid-feedback-validation" v-if="errors.name_commission">{{errors.name_commission[0]}}</div>
                    </div>
                    <div class="form-group col-md-6" >
                        <label for="id_student_council">Consejo Estudiantil:</label>
                        <br>
                        <b-form-select placeholder="Seleccione una opcion" v-model="commissionData.Consejo" :state="commissionData.Consejo != ''" class="form-select" id="id_student_council" v-for="(commission, index) in options" :key="index">
                            <b-form-select-option value="null" disabled selected>Selecciona una opción</b-form-select-option>
                            <b-form-select-option :value="commission.Id">{{commission.Año}}</b-form-select-option>
                        </b-form-select>
                        <div class="invalid-feedback-validation" v-if="errors.id_student_council">{{errors.id_student_council[0]}}</div>                    
                    </div>
                    <div class="form-group col-md-12">
                        <label for="image">Imagen:</label>
                        <div>
                            <img :src="`${$store.state.serverPath}/storage/${commissionData.Imagen}`"  ref="updateImageCommissionDisplay" width="700" height="300">  
                        </div>
                        <input type="file" v-on:change="updateImage" ref="updateImageCommission" class="form-control" id="image"/>
                        <div class="invalid-feedback-validation" v-if="errors.image">{{errors.image[0]}}</div>                    
                    </div>
                </div>
                <hr>
                <div class="text-center">    
                    <button type="button" class="btn btn-default" @click="hideUpdateCommissionModal">Cancelar</button>
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
    import * as commissionService from '../services/commission_service';
    
        // Begin export default.
    export default {

        name: 'commission',
        
            // Begin data.
        data(){
            return {
                
                    // Declare registers to use to save display data.
                registers: [],

                    // Declare aboutusData to use to send data in form.
                commissionData: {
                    Comision: '',
                    Consejo: '',
                    Imagen: '',
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
            this.loadRegisterCommission();

                // Call method fuction to use load data in component select.
            this.loadRegisterStudentCouncil();

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
                    this.commissionData.Imagen = this.$refs.imageCommission.files[0];
                    
                        // Declae reader.
                    let reader = new FileReader();
                   
                        // Function save event to use load image.
                    reader.addEventListener('load', function (){
                        this.$refs.imageCommissionDisplay.src = reader.result;
                    }.bind(this), false);

                        // Load data reader in variable.
                    reader.readAsDataURL(this.commissionData.Imagen);
                        
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
            hideNewCommissionModal() {
                this.$refs.modalCreateCommission.hide();
                this.commissionData = {
                    Comision: '',
                    Consejo: '',
                    Imagen: '',
                };
            },
            
                // Event open new modal with clean form create.
            showNewCommissionModal() {
                this.$refs.modalCreateCommission.show();
            },
            
                // Function use for save data forma to send request.
            createRegisterCommission: async function () {
                let formData = new FormData();
                formData.append('name_commission', this.commissionData.Comision);
                formData.append('id_student_council', this.commissionData.Consejo);
                formData.append('image', this.commissionData.Imagen);

                try {
                        // Call request to create register in service.
                    await commissionService.createRegisterCommission(formData);

                        // Open swet alert to indicate success.                    
                    this.$swal.fire({
                        icon: 'success',
                        title: 'Exito',
                        text: 'El registro ha sido guardado correctamente',
                    });
                        // Clean and close form.
                    this.hideNewCommissionModal();

                        // Declare variable for save request load register. 
                    const data = await commissionService.loadRegisterCommission();

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
                        this.hideNewCommissionModal();
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
            loadRegisterCommission() {
                
                    // Decalre Promise for call request load register.
                commissionService.loadRegisterCommission().then((response)=>{
                     
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
            loadRegisterStudentCouncil() {
                
                    // Declare Promise for call request load data in select component.
                commissionService.loadRegisterStudentCouncil().then((response) => {

                        // Declare variable registers to use load data in select.
                    this.options = response.data.data;

                }).catch((error) => {
                    
                        // Show error in console.
                    console.error(error);
                });
            },

                // Function use to delete register select.
            deleteCommissionRegister(commission) {
                
                // Swet alert to use question delete register. 
            this.$swal.fire({
                title: `¿Desea eliminar el registro: ${commission.Comision}?`,
                icon: 'question',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: `Eliminar`,
                denyButtonText: `Cancelar`,
                }).then((result) => {
                        
                        // The result for question in this alert is confirmed.
                    if (result.isConfirmed) {
                            
                            // Send reqeust to use delete register.
                        commissionService.deleteCommissionRegister(commission.Id).then((response) =>{
                                
                                // Swet alert to use indicate success.
                            this.$swal.fire({
                                icon: 'success',
                                title: `El registro: ${commission.Comision} ha sido eliminado correctamente.`,
                                toast: true,
                                showConfirmButton: false,
                                position: 'top-end',
                                timer: 3000,
                                timerProgressBar: true,
                            });
                                // Decalre Promise for call request load register.
                            commissionService.loadRegisterCommission().then((response) => {
                                
                                    // Declare variable registers to use load data in table.
                                this.registers = response.data.data;

                            });

                        }).catch((error =>{

                            // Swet alert to use indidcate error.
                        this.$swal.fire({
                                icon: 'error',
                                title: `No es posible eliminar el registro: ${commission.Comision} en estos momentos.`,
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
                            title: `El registro: ${commission.Comision}  no ha sido eliminado`,
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
            hideUpdateCommissionModal(){
                this.$refs.modalUpdateCommission.hide();
                this.commissionData = {
                    Comision: '',
                    Consejo: '',
                    Imagen: '',
                };
            },

                // Event open update modal with clean form.
            showUpdateCommissionModal(){
                this.$refs.modalUpdateCommission.show();
            },

                // Capture dates into form update.
            updateDataCommission(commission) {
                this.commissionData = {...commission};

                this.showUpdateCommissionModal();
            },

                // Method for update attach image in form.
            updateImage() {
                try {
                        // Declare value in variable.
                    this.commissionData.Imagen = this.$refs.updateImageCommission.files[0];

                        // Declae reader.
                    let reader = new FileReader();
                        
                         // Function save event to use load image.
                    reader.addEventListener('load', function (){
                        this.$refs.updateImageCommissionDisplay.src = reader.result;
                    }.bind(this), false);

                        // Load data reader in variable.
                    reader.readAsDataURL(this.commissionData.Imagen);

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
            updateRegisterCommission: async function() {
                try {
                        let formData = new FormData();
                    formData.append('name_commission', this.commissionData.Comision);
                    formData.append('id_student_council', this.commissionData.Consejo);
                    formData.append('image', this.commissionData.Imagen);
                    formData.append('_method', 'put');
                    
                        // Call request in service to update data.
                    await commissionService.updateRegisterCommission(this.commissionData.Id, formData);
                    
                        // Declare variable for save request load register. 
                    const data = await commissionService.loadRegisterCommission();

                        // Save data in registers.
                    this.registers = data.data.data;
                    
                    this.hideUpdateCommissionModal();

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
                        this.hideUpdateCommissionModal();
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