    <!-- Begin template. -->
<template>
    <!-- Begin page content. -->
<div class="container-fluid">

    <!-- Page heading. -->
    <div class="d-sm-flex align-items-center justify-content-center mb-4">
        <h1 class="mb-0 text-gray-800">Consejo Estudiantil</h1>
    </div>
    
        <!-- Data table. -->
    <div class="card">
            <!-- Header data table. -->
        <div class="card-body d-flex">
            <h4><span><i class="fas fa-table"></i>  Visualización de datos</span></h4>
            <button class="btn btn-success btn-sm ml-auto" @click="showNewStudentCouncilModal"><span><i class="fa fa-plus"></i></span>Agregar Registro</button>
        </div>
            <!-- Content data table. -->
        <div class="card-body table-responsive  align-items-center justify-content-center">
            <table id="tableRegisters" class="table table-hover table-responsive table-bordered">  
                <thead class="table-dark">
                    <tr>
                        <td>Id</td>
                        <td>Año</td>
                        <td>Portada</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(studentcouncil, index) in registers" :key="index">
                        <td>{{studentcouncil.Id}}</td>
                        <td>{{studentcouncil.Año}}</td>
                        <td>
                            <img :src="`${$store.state.serverPath}/storage/${studentcouncil.Portada}`" class="table-image">
                        </td>
                        <td>
                            <button class="btn btn-success btn-sm" @click="updateDataStudentCouncil(studentcouncil)"><span class="fa fa-edit"></span></button>
                            <button class="btn btn-danger btn-sm" @click="deleteStudentCouncilRegister(studentcouncil)"><span class="fa fa-trash"></span></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
            <!-- End content data table. -->
    </div>
        <!--End data table. -->

        <!-- Content modal create. -->
    <b-modal ref="modalCreateStudentCouncil" hide-footer size="xl" title="Agregar Nuevo Registro">
        <div class="d-block">
                <!-- Form modal create. -->
            <form v-on:submit.prevent="createRegisterStudentCouncil">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="year">Año:</label>
                        <b-form-input :state="studentcouncilData.Año >= 2020 && studentcouncilData.Año < 2099" type="text" class="form-control" id="year" v-model="studentcouncilData.Año" placeholder="Ingresar Año" autocomplete="off"></b-form-input>
                        <div class="invalid-feedback-validation" v-if="errors.year">{{errors.year[0]}}</div>                    
                    </div>
                    <div class="form-group col-md-12">
                        <label for="image">Imagen:</label>
                        <div v-if="studentcouncilData.Portada.name">
                            <img src="" ref="imageStudentCouncilDisplay" width="700" height="300">  
                        </div>
                        <input type="file" v-on:change="attachImage" ref="imageStudentCouncil" class="form-control" id="image"/>
                        <div class="invalid-feedback-validation" v-if="errors.image">{{errors.image[0]}}</div>                    
                    </div>
                </div>
                <hr>
                <div class="text-center">    
                    <button type="button" class="btn btn-default" @click="hideNewStudentCouncilModal">Cancelar</button>
                    <button type="submit" class="btn btn-success"><span class="fa fa-check"></span>Aceptar</button>
                </div>
            </form> 
                <!-- End form modal create. -->
        </div>
    </b-modal>
        <!-- End modal create. -->

        <!-- Content modal update. -->
    <b-modal ref="modalUpdateStudentCouncil" hide-footer size="xl" title="Modificar Registro">
        <div class="d-block">
                <!-- Form modal update. -->
            <form v-on:submit.prevent="updateRegisterStudentCouncil">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="year">Año:</label>
                        <b-form-input :state="studentcouncilData.Año >= 2020 && studentcouncilData.Año < 2099" type="text" class="form-control" id="year" v-model="studentcouncilData.Año" placeholder="Ingresar Año" autocomplete="off"></b-form-input>
                        <div class="invalid-feedback-validation" v-if="errors.year">{{errors.year[0]}}</div>                    
                    </div>
                    <div class="form-group col-md-12">
                        <label for="image">Imagen:</label>
                        <div>
                            <img :src="`${$store.state.serverPath}/storage/${studentcouncilData.Portada}`" ref="updateImageStudentCouncilDisplay" width="700" height="300">  
                        </div>
                        <input type="file" v-on:change="updateImage" ref="updateImageStudentCouncil" class="form-control" id="image"/>
                        <div class="invalid-feedback-validation" v-if="errors.image">{{errors.image[0]}}</div>                    
                    </div>
                </div>
                <hr>
                <div class="text-center">    
                    <button type="button" class="btn btn-default" @click="hideUpdateStudentCouncilModal">Cancelar</button>
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
    import * as studentCouncilService from '../services/studentcouncil_service';
    
        // Begin export default.
    export default {

        name: 'studentcouncil',

            // Begin data.
        data(){
            return {
                
                    // Declare registers to use to save display data.
                registers: [],

                    // Declare aboutusData to use to send data in form.
                studentcouncilData: {
                    Año: '',
                    Portada: '',
                },

                    // Save errors to response send request.
                errors: {},
                
            };
        },
            // End data.

            // Mounted data for registers in datatable.
        mounted() {
                // Call method function to use load data.
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
                    this.studentcouncilData.Portada = this.$refs.imageStudentCouncil.files[0];
                    
                        // Declae reader.
                    let reader = new FileReader();
                   
                        // Function save event to use load image.
                    reader.addEventListener('load', function (){
                        this.$refs.imageStudentCouncilDisplay.src = reader.result;
                    }.bind(this), false);

                        // Load data reader in variable.
                    reader.readAsDataURL(this.studentcouncilData.Portada);
                        
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
            hideNewStudentCouncilModal() {
                this.$refs.modalCreateStudentCouncil.hide();
                this.aboutusData = {
                    Año: '',
                    Portada: '',
                };
                this.errors = {};
            },
            
                // Event open new modal with clean form create.
            showNewStudentCouncilModal() {
                this.$refs.modalCreateStudentCouncil.show();
            },
            
                // Function use for save data forma to send request.
            createRegisterStudentCouncil: async function () {
                let formData = new FormData();
                formData.append('year', this.studentcouncilData.Año);
                formData.append('image', this.studentcouncilData.Portada);

                try {
                        // Call request to create register in service.
                    await studentCouncilService.createRegisterStudentCouncil(formData);

                        // Open swet alert to indicate success.                    
                    this.$swal.fire({
                        icon: 'success',
                        title: 'Exito',
                        text: 'El registro ha sido guardado correctamente',
                    });
                        // Clean and close form.
                    this.hideNewStudentCouncilModal();

                        // Declare variable for save request load register. 
                    const data = await studentCouncilService.loadRegisterStudentCouncil();

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
                        this.hideNewStudentCouncilModal();
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
            loadRegisterStudentCouncil() {
                
                    // Decalre Promise for call request load register.
                studentCouncilService.loadRegisterStudentCouncil().then((response)=>{
                     
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
            deleteStudentCouncilRegister(studentcouncil) {
                
                // Swet alert to use question delete register. 
            this.$swal.fire({
                title: `¿Desea eliminar el registro: ${studentcouncil.Año}?`,
                icon: 'question',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: `Eliminar`,
                denyButtonText: `Cancelar`,
                }).then((result) => {
                        
                        // The result for question in this alert is confirmed.
                    if (result.isConfirmed) {
                            
                            // Send reqeust to use delete register.
                        studentCouncilService.deleteStudentCouncilRegister(studentcouncil.Id).then((response) =>{
                                
                                // Swet alert to use indicate success.
                            this.$swal.fire({
                                icon: 'success',
                                title: `El registro: ${studentcouncil.Año} ha sido eliminado correctamente.`,
                                toast: true,
                                showConfirmButton: false,
                                position: 'top-end',
                                timer: 3000,
                                timerProgressBar: true,
                            });
                                // Decalre Promise for call request load register.
                            studentCouncilService.loadRegisterStudentCouncil().then((response) => {
                                
                                    // Declare variable registers to use load data in table.
                                this.registers = response.data.data;

                            });

                        }).catch((error =>{

                            // Swet alert to use indidcate error.
                        this.$swal.fire({
                                icon: 'error',
                                title: `No es posible eliminar el registro: ${studentcouncil.Año} en estos momentos.`,
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
                            title: `El registro: ${studentcouncil.Año}  no ha sido eliminado`,
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
            hideUpdateStudentCouncilModal(){
                this.$refs.modalUpdateStudentCouncil.hide();
                this.studentcouncilData = {
                    Año: '',
                    Portada: '',
                };
                this.errors = {};
            },

                // Event open update modal with clean form.
            showUpdateStudentCouncilModal(){
                this.$refs.modalUpdateStudentCouncil.show();
            },

                // Capture dates into form update.
            updateDataStudentCouncil(studentcouncil) {
                this.studentcouncilData = {...studentcouncil};
                this.showUpdateStudentCouncilModal();
            },

                // Method for update attach image in form.
            updateImage() {
                try {
                        // Declare value in variable.
                    this.studentcouncilData.Portada = this.$refs.updateImageStudentCouncil.files[0];

                        // Declae reader.
                    let reader = new FileReader();
                        
                         // Function save event to use load image.
                    reader.addEventListener('load', function (){
                        this.$refs.updateImageStudentCouncilDisplay.src = reader.result;
                    }.bind(this), false);

                        // Load data reader in variable.
                    reader.readAsDataURL(this.studentcouncilData.Portada);

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
            updateRegisterStudentCouncil: async function() {
                try {
                        let formData = new FormData();
                    formData.append('year', this.studentcouncilData.Año);
                    formData.append('image', this.studentcouncilData.Portada);
                    formData.append('_method', 'put');
                    
                        // Call request in service to update data.
                    await studentCouncilService.updateRegisterStudentCouncil(this.studentcouncilData.Id, formData);
                    
                        // Declare variable for save request load register. 
                    const data = await studentCouncilService.loadRegisterStudentCouncil();

                        // Save data in registers.
                    this.registers = data.data.data;
                    
                    this.hideUpdateStudentCouncilModal();

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
                        this.hideUpdateStudentCouncilModal();
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
