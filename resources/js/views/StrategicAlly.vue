    <!-- Begin template. -->
<template>
    <!-- Begin page content. -->
<div class="container-fluid">

    <!-- Page heading. -->
    <div class="d-sm-flex align-items-center justify-content-center mb-4">
        <h1 class="mb-0 text-gray-800">Aliados Estrategicos</h1>
    </div>
    
        <!-- Data table. -->
    <div class="card">
            <!-- Header data table. -->
        <div class="card-body d-flex">
            <h4><span><i class="fas fa-table"></i>  Visualización de datos</span></h4>
            <button class="btn btn-success btn-sm ml-auto" @click="showNewStrategicAllyModal"><span><i class="fa fa-plus"></i></span>Agregar Registro</button>
        </div>
            <!-- Content data table. -->
        <div class="card-body table-responsive  align-items-center justify-content-center">
            <table id="tableRegisters" class="table table-hover table-responsive table-bordered">  
                <thead class="table-dark">
                    <tr>
                        <td>Id</td>
                        <td>Aliado</td>
                        <td>Logo</td>
                        <td>Descripcion</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(strategically, index) in registers" :key="index">
                        <td>{{strategically.Id}}</td>
                        <td>{{strategically.Aliado}}</td>
                        <td>
                            <img :src="`${$store.state.serverPath}/storage/${strategically.Logo}`" class="logo-image">
                        </td>
                        <td>{{strategically.Descripcion}}</td>
                        <td>
                            <button class="btn btn-success btn-sm" @click="updateDataStrategicAlly(strategically)"><span class="fa fa-edit"></span></button>
                            <button class="btn btn-danger btn-sm" @click="deleteStrategicAllyRegister(strategically)"><span class="fa fa-trash"></span></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
            <!-- End content data table. -->
    </div>
        <!--End data table. -->

        <!-- Content modal create. -->
    <b-modal ref="modalCreateStrategicAlly" hide-footer size="xl" title="Agregar Nuevo Registro">
        <div class="d-block">
                <!-- Form modal create. -->
            <form v-on:submit.prevent="createRegisterStrategicAlly">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name_ally">Nombre Aliado:</label>
                        <b-form-input :state="strategicallyData.Aliado.length >= 1 && strategicallyData.Aliado.length < 50" type="text" class="form-control" id="name_ally" v-model="strategicallyData.Aliado" placeholder="Ingresar Aliado" autocomplete="off"></b-form-input>
                        <div class="invalid-feedback-validation" v-if="errors.name_ally">{{errors.name_ally[0]}}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="description">Descripcion Alianza:</label>
                        <ckeditor id="description" :editor="editor" v-model="strategicallyData.Descripcion" :config="editorConfig"></ckeditor>                 
                        <div class="invalid-feedback-validation" v-if="errors.description">{{errors.description[0]}}</div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="image">Imagen:</label>
                        <div  class="text-center" v-if="strategicallyData.Logo.name">
                            <img src="" ref="imageStrategicAllyDisplay" width="450" height="250">  
                        </div>
                        <input accept="image/png,image/jpeg" type="file" v-on:change="attachImage" ref="imageStrategicAlly" class="form-control" id="image"/>
                        <div class="invalid-feedback-validation" v-if="errors.image">{{errors.image[0]}}</div>                    
                    </div>
                </div>
                <hr>
                <div class="text-center">    
                    <button type="button" class="btn btn-default" @click="hideNewStrategicAllyModal">Cancelar</button>
                    <button type="submit" class="btn btn-success"><span class="fa fa-check"></span>Aceptar</button>
                </div>
            </form> 
                <!-- End form modal create. -->
        </div>
    </b-modal>
        <!-- End modal create. -->

        <!-- Content modal update. -->
    <b-modal ref="modalUpdateStrategicAlly" hide-footer size="xl" title="Modificar Registro">
        <div class="d-block">
                <!-- Form modal update. -->
            <form v-on:submit.prevent="updateRegisterStrategicAlly">
                                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name_ally">Nombre Aliado:</label>
                        <b-form-input :state="strategicallyData.Aliado.length >= 1 && strategicallyData.Aliado.length < 50" type="text" class="form-control" id="name_ally" v-model="strategicallyData.Aliado" placeholder="Ingresar Aliado" autocomplete="off"></b-form-input>
                        <div class="invalid-feedback-validation" v-if="errors.name_ally">{{errors.name_ally[0]}}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="description">Descripcion Alianza:</label>
                        <ckeditor id="description" :editor="editor" v-model="strategicallyData.Descripcion" :config="editorConfig"></ckeditor>                 
                        <div class="invalid-feedback-validation" v-if="errors.description">{{errors.description[0]}}</div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="image">Imagen:</label>
                        <div class="text-center">
                            <img :src="`${$store.state.serverPath}/storage/${strategicallyData.Logo}`" class="table-image" ref="updateImageStrategicAllyDisplay"  width="450" height="250">  
                        </div>
                        <input accept="image/png,image/jpeg" type="file" v-on:change="updateImage" ref="updateImageStrategicAlly" class="form-control" id="image"/>
                        <div class="invalid-feedback-validation" v-if="errors.image">{{errors.image[0]}}</div>                    
                    </div>
                </div>
                <hr>
                <div class="text-center">    
                    <button type="button" class="btn btn-default" @click="hideUpdateStrategicAllyModal">Cancelar</button>
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

        // Import file strategicAllyService that contains functions request routes.
    import * as strategicallyService from '../services/strategically_service';

        // Import ClassicEditor to use in component long text.
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    
        // Begin export default.
    export default {

        name: 'strategically',

            // Begin data.
        data(){
            return {

                    // Declare classic editor.
                editor: ClassicEditor,
               
                editorConfig: {
                    // The configuration of the editor.
                },
                
                
                    // Declare registers to use to save display data.
                registers: [],

                    // Declare strategicAllyData to use to send data in form.
                strategicallyData: {
                    Aliado: '',
                    Logo: '',
                    Descripcion: '',
                },

                    // Save errors to response send request.
                errors: {},
                
            };
        },
            // End data.

            // Mounted data for registers in datatable.
        mounted() {
                // Call method function to use load data.
            this.loadRegisterStrategicAlly();
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
                    this.strategicallyData.Logo = this.$refs.imageStrategicAlly.files[0];
                    
                        // Declae reader.
                    let reader = new FileReader();
                   
                        // Function save event to use load image.
                    reader.addEventListener('load', function (){
                        this.$refs.imageStrategicAllyDisplay.src = reader.result;
                    }.bind(this), false);

                        // Load data reader in variable.
                    reader.readAsDataURL(this.strategicallyData.Logo);
                        
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
            hideNewStrategicAllyModal() {

                    // Close modal.
                this.$refs.modalCreateStrategicAlly.hide();

                    // Clean data.
                this.strategicallyData = {
                    Aliado: '',
                    Logo: '',
                    Descripcion: '',
                };

                    // Clean errors.
                this.errors = {};
            },
            
                // Event open new modal with clean form create.
            showNewStrategicAllyModal() {

                    // Show modal.
                this.$refs.modalCreateStrategicAlly.show();
            },
            
                // Function use for save data forma to send request.
            createRegisterStrategicAlly: async function () {

                        // Declare FormData.
                    let formData = new FormData();
                formData.append('name_ally', this.strategicallyData.Aliado);
                formData.append('image', this.strategicallyData.Logo);
                formData.append('description', this.strategicallyData.Descripcion);

                try {
                        // Call request to create register in service.
                    await strategicallyService.createRegisterStrategicAlly(formData);

                        // Open swet alert to indicate success.                    
                    this.$swal.fire({
                        icon: 'success',
                        title: 'Exito',
                        text: 'El registro ha sido guardado correctamente',
                    });
                        // Clean and close form.
                    this.hideNewStrategicAllyModal();

                        // Declare variable for save request load register. 
                    const data = await strategicallyService.loadRegisterStrategicAlly();

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
                        this.hideNewStrategicAllyModal();
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
            loadRegisterStrategicAlly() {
                
                    // Decalre Promise for call request load register.
                strategicallyService.loadRegisterStrategicAlly().then((response)=>{
                     
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
            deleteStrategicAllyRegister(strategically) {
                
                // Swet alert to use question delete register. 
            this.$swal.fire({
                title: `¿Desea eliminar el registro: ${strategically.Aliado}?`,
                icon: 'question',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: `Eliminar`,
                denyButtonText: `Cancelar`,
                }).then((result) => {
                        
                        // The result for question in this alert is confirmed.
                    if (result.isConfirmed) {
                            
                            // Send reqeust to use delete register.
                        strategicallyService.deleteStrategicAllyRegister(strategically.Id).then((response) =>{
                                
                                // Swet alert to use indicate success.
                            this.$swal.fire({
                                icon: 'success',
                                title: `El registro: ${strategically.Aliado} ha sido eliminado correctamente.`,
                                toast: true,
                                showConfirmButton: false,
                                position: 'top-end',
                                timer: 3000,
                                timerProgressBar: true,
                            });
                                // Decalre Promise for call request load register.
                            strategicallyService.loadRegisterStrategicAlly().then((response) => {
                                
                                    // Declare variable registers to use load data in table.
                                this.registers = response.data.data;

                            });

                        }).catch((error =>{

                            // Swet alert to use indidcate error.
                        this.$swal.fire({
                                icon: 'error',
                                title: `No es posible eliminar el registro: ${strategically.Aliado} en estos momentos.`,
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
                            title: `El registro;${strategically.Aliado}  no ha sido eliminado`,
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
            hideUpdateStrategicAllyModal(){

                    // Close modal.
                this.$refs.modalUpdateStrategicAlly.hide();

                    // Clean data.
                this.strategicallyData = {
                    Aliado: '',
                    Logo: '',
                    Descripcion: '',
                };

                    // Clean errors.
                this.errors = {};
            },

                // Event open update modal with clean form.
            showUpdateStrategicAllyModal(){

                    // Show modal.
                this.$refs.modalUpdateStrategicAlly.show();
            },

                // Capture dates into form update.
            updateDataStrategicAlly(strategically) {

                    // Save data to use laod in inputs.
                this.strategicallyData = {...strategically};

                    // Show modal.
                this.showUpdateStrategicAllyModal();
            },

                // Method for update attach image in form.
            updateImage() {
                try {
                        // Declare value in variable.
                    this.strategicallyData.Logo = this.$refs.updateImageStrategicAlly.files[0];

                        // Declae reader.
                    let reader = new FileReader();
                        
                         // Function save event to use load image.
                    reader.addEventListener('load', function (){
                        this.$refs.updateImageStrategicAllyDisplay.src = reader.result;
                    }.bind(this), false);

                        // Load data reader in variable.
                    reader.readAsDataURL(this.strategicallyData.Logo);

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
            updateRegisterStrategicAlly: async function() {
                try {

                            // Declare FormData.
                        let formData = new FormData();
                    formData.append('name_ally', this.strategicallyData.Aliado);
                    formData.append('image', this.strategicallyData.Logo);
                    formData.append('description', this.strategicallyData.Descripcion);
                    formData.append('_method', 'put');
                    
                        // Call request in service to update data.
                    await strategicallyService.updateRegisterStrategicAlly(this.strategicallyData.Id, formData);
                    
                        // Declare variable for save request load register. 
                    const data = await strategicallyService.loadRegisterStrategicAlly();

                        // Save data in registers.
                    this.registers = data.data.data;
                    
                    this.hideUpdateStrategicAllyModal();

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
                        this.hideUpdateStrategicAllyteModal();
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
