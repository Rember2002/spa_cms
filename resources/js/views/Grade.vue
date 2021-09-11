    <!-- Begin template. -->
<template>
    <!-- Begin page content. -->
<div class="container-fluid">

    <!-- Page heading. -->
    <div class="d-sm-flex align-items-center justify-content-center mb-4">
        <h1 class="mb-0 text-gray-800">Grados</h1>
    </div>
    
        <!-- Data table. -->
    <div class="card">
            <!-- Header data table. -->
        <div class="card-body d-flex">
            <h4><span><i class="fas fa-table"></i>  Visualización de datos</span></h4>
            <button class="btn btn-success btn-sm ml-auto" @click="showNewGradeModal"><span><i class="fa fa-plus"></i></span>Agregar Registro</button>
        </div>
            <!-- Content data table. -->
        <div class="card-body table-responsive  align-items-center justify-content-center">
            <table id="tableRegisters" class="table table-hover table-responsive table-bordered">  
                <thead class="table-dark">
                    <tr>
                        <td>Id</td>
                        <td>Grado</td>
                        <td>Descripcion</td>
                        <td>Oferta Academica</td>
                        <td>Imagen</td>
                        <td>Categorias</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(grade, index) in registers" :key="index">
                        <td>{{grade.Id}}</td>
                        <td>{{grade.Grado}}</td>
                        <td>{{grade.Descripcion}}</td>
                        <td>{{grade.Academica}}</td>
                        <td>
                            <img :src="`${$store.state.serverPath}/storage/${grade.Imagen}`" class="banner-grade-image">
                        </td>
                        <td class="text-center">
                            <button class="btn btn-warning btn-sm" @click="ShowModalCategorieGrade(grade.Id, grade.Grado)"><span class="fa fa-eye"></span></button>
                            <button class="btn btn-success btn-sm" @click="showNewCategorieGradeModal(grade)"><span class="fa fa-plus"></span></button>
                        </td>
                        <td>
                            <button class="btn btn-success btn-sm" @click="updateDataGrade(grade)"><span class="fa fa-edit"></span></button>
                            <button class="btn btn-danger btn-sm" @click="deleteGradeRegister(grade)"><span class="fa fa-trash"></span></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
            <!-- End content data table. -->
    </div>
        <!--End data table. -->

        <!-- Begin show table modal -->

    <b-modal ref="modalShowCategorieGrade" hide-footer size="xl" title="Categorias Grado">
        <div class="card">
                <table id="tableRegistersCategorie" class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <td>Categoria</td>
                        <td>Descripcion</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(grade, index) in categories" :key="index">
                        <td>{{grade.Categoria}}</td>
                        <td>{{grade.Descripcion}}</td>
                        <td>
                            <button class="btn btn-success btn-sm" @click="updateDataCategorieGrade(grade)"><span class="fa fa-edit"></span></button>
                            <button class="btn btn-danger btn-sm" @click="deleteCategorieGradeRegister(grade)"><span class="fa fa-trash"></span></button>
                        </td>
                    </tr>
                </tbody>
               </table>
        </div>
    </b-modal>

        <!-- End show table modal -->

        <!-- Begin show table modal create -->

    <b-modal ref="modalCreateCategorieGrade" hide-footer size="sm" title="Agregar Categoria">
        <div class="d-block">
            <!-- Form modal create. -->
            <form v-on:submit.prevent="createRegisterCategorieGrade">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="name_categorie">Nombre:</label>
                        <b-form-input :state="categorieGradeData.Categoria.length >= 1 && categorieGradeData.Categoria.length < 50" type="text" class="form-control" id="name_categorie" v-model="categorieGradeData.Categoria" placeholder="Ingresar Nombre" autocomplete="off"></b-form-input>
                        <div class="invalid-feedback-validation" v-if="errors.name_categorie">{{errors.name_categorie[0]}}</div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="description">Descripcion:</label>
                        <b-form-textarea :state="categorieGradeData.Descripcion.length >= 1 && categorieGradeData.Descripcion.length < 1000" type="text" class="form-control" id="description" v-model="categorieGradeData.Descripcion" placeholder="Ingresar Descripcion" autocomplete="off"></b-form-textarea>                 
                        <div class="invalid-feedback-validation" v-if="errors.description">{{errors.description[0]}}</div>
                    </div>
                    <b-form-input id="id_grades" v-model="categorieGradeData.GradoId" class="hidden"></b-form-input>
                </div>
                <hr>
                <div class="text-center">    
                    <button type="button" class="btn btn-default" @click="hideNewCategorieGradeModal">Cancelar</button>
                    <button type="submit" class="btn btn-success"><span class="fa fa-check"></span>Aceptar</button>
                </div>
            </form> 
                <!-- End form modal create. -->
        </div>
    </b-modal>

    <!-- Begin show table modal update -->

    <b-modal ref="modalUpdateCategorieGrade" hide-footer size="sm" title="Modificar Categoria">
        <div class="d-block">
            <!-- Form modal create. -->
            <form v-on:submit.prevent="updateRegisterCategorieGrade">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="name_categorie">Nombre:</label>
                        <b-form-input :state="categorieGradeData.Categoria.length >= 1 && categorieGradeData.Categoria.length < 50" type="text" class="form-control" id="name_categorie" v-model="categorieGradeData.Categoria" placeholder="Ingresar Nombre" autocomplete="off"></b-form-input>
                        <div class="invalid-feedback-validation" v-if="errors.name_categorie">{{errors.name_categorie[0]}}</div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="description">Descripcion:</label>
                        <b-form-textarea :state="categorieGradeData.Descripcion.length >= 1 && categorieGradeData.Descripcion.length < 1000" type="text" class="form-control" id="description" v-model="categorieGradeData.Descripcion" placeholder="Ingresar Descripcion" autocomplete="off"></b-form-textarea>                 
                        <div class="invalid-feedback-validation" v-if="errors.description">{{errors.description[0]}}</div>
                    </div>
                    <b-form-input id="id_grade" v-model="categorieGradeData.GradoId" class="hidden"></b-form-input>
                </div>
                <hr>
                <div class="text-center">    
                    <button type="button" class="btn btn-default" @click="hideUpdateCategorieGradeModal(categorieGradeData.GradoId)">Cancelar</button>
                    <button type="submit" class="btn btn-success"><span class="fa fa-check"></span>Aceptar</button>
                </div>
            </form> 
                <!-- End form modal create. -->
        </div>
    </b-modal>

        <!-- End show table modal update -->      

        <!-- Content modal create. -->
    <b-modal ref="modalCreateGrade" hide-footer size="xl" title="Agregar Nuevo Registro">
        <div class="d-block">
                <!-- Form modal create. -->
            <form v-on:submit.prevent="createRegisterGrade">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name_grade">Grado:</label>
                        <b-form-input :state="gradeData.Grado.length >= 1 && gradeData.Grado.length < 50" type="text" class="form-control" id="name_grade" v-model="gradeData.Grado" placeholder="Ingresar Nombre" autocomplete="off"></b-form-input>
                        <div class="invalid-feedback-validation" v-if="errors.name_grade">{{errors.name_grade[0]}}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="description">Descripcion:</label>
                        <b-form-textarea :state="gradeData.Descripcion.length >= 1 && gradeData.Descripcion.length < 1000" type="text" class="form-control" id="description" v-model="gradeData.Descripcion" placeholder="Ingresar Descripcion" autocomplete="off"></b-form-textarea>                 
                        <div class="invalid-feedback-validation" v-if="errors.description">{{errors.description[0]}}</div>
                    </div>
                    <div class="form-group col-md-6" >
                        <label for="id_academic_offer">Oferta Academica:</label>
                        <br>
                        <b-form-select placeholder="Seleccione una opcion" v-model="gradeData.AcademicaId" :state="gradeData.AcademicaId != ''" class="form-select" id="id_academic_offer">
                            <b-form-select-option value="null" disabled selected>Selecciona una opción</b-form-select-option>
                            <b-form-select-option v-for="(grade, index) in options" :key="index" :value="grade.Id">{{grade.Oferta}}</b-form-select-option>
                        </b-form-select>
                        <div class="invalid-feedback-validation" v-if="errors.id_academic_offer">{{errors.id_academic_offer[0]}}</div>                    
                    </div>
                    <div class="form-group col-md-12">
                        <label for="image">Imagen:</label>
                        <div class="text-center" v-if="gradeData.Imagen.name">
                            <img src="" ref="imageGradeDisplay" width="500" height="150">  
                        </div>
                        <input accept="image/png,image/jpeg" type="file" v-on:change="attachImage" ref="imageGrade" class="form-control" id="image"/>
                        <div class="invalid-feedback-validation" v-if="errors.image">{{errors.image[0]}}</div>                    
                    </div>
                </div>
                <hr>
                <div class="text-center">    
                    <button type="button" class="btn btn-default" @click="hideNewGradeModal">Cancelar</button>
                    <button type="submit" class="btn btn-success"><span class="fa fa-check"></span>Aceptar</button>
                </div>
            </form> 
                <!-- End form modal create. -->
        </div>
    </b-modal>
        <!-- End modal create. -->

        <!-- Content modal update. -->
    <b-modal ref="modalUpdateGrade" hide-footer size="xl" title="Modificar Registro">
        <div class="d-block">
                <!-- Form modal update. -->
            <form v-on:submit.prevent="updateRegisterGrade">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name_grade">Grado:</label>
                        <b-form-input :state="gradeData.Grado.length >= 1 && gradeData.Grado.length < 50" type="text" class="form-control" id="name_grade" v-model="gradeData.Grado" placeholder="Ingresar Nombre" autocomplete="off"></b-form-input>
                        <div class="invalid-feedback-validation" v-if="errors.name_grade">{{errors.name_grade[0]}}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="description">Descripcion:</label>
                        <b-form-textarea :state="gradeData.Descripcion.length >= 1 && gradeData.Descripcion.length < 1000" type="text" class="form-control" id="description" v-model="gradeData.Descripcion" placeholder="Ingresar Descripcion" autocomplete="off"></b-form-textarea>                 
                        <div class="invalid-feedback-validation" v-if="errors.description">{{errors.description[0]}}</div>
                    </div>
                    <div class="form-group col-md-6" >
                        <label for="id_academic_offer">Oferta Academica:</label>
                        <br>
                        <b-form-select placeholder="Seleccione una opcion" v-model="gradeData.AcademicaId" :state="gradeData.AcademicaId != ''" class="form-select" id="id_academic_offer">
                            <b-form-select-option value="null" disabled selected>Selecciona una opción</b-form-select-option>
                            <b-form-select-option v-for="(grade, index) in options" :key="index" :value="grade.Id">{{grade.Oferta}}</b-form-select-option>
                        </b-form-select>
                        <div class="invalid-feedback-validation" v-if="errors.id_academic_offer">{{errors.id_academic_offer[0]}}</div>                    
                    </div>
                    <div class="form-group col-md-12">
                        <label for="image">Imagen:</label>
                        <div class="text-center">
                            <img accept="image/png,image/jpeg" :src="`${$store.state.serverPath}/storage/${gradeData.Imagen}`" ref="updateImageGradeDisplay" width="500" height="150">  
                        </div>
                        <input accept="image/png,image/jpeg" type="file" v-on:change="updateImage" ref="updateImageGrade" class="form-control" id="image"/>
                        <div class="invalid-feedback-validation" v-if="errors.image">{{errors.image[0]}}</div>                    
                    </div>
                </div>
                <hr>
                <div class="text-center">    
                    <button type="button" class="btn btn-default" @click="hideUpdateGradeModal">Cancelar</button>
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
    import * as gradeService from '../services/grade_service';

        // Import file aboutUsService that contains functions request routes.
    import * as academicOfferService from '../services/academicoffers_service';

        // Import file categorieGradeService that contains functions request rules.
    import * as categorieGradeService from '../services/categoriegrade_service';
    
        // Begin export default.
    export default {

        name: 'grade',

            // Begin data.
        data(){
            return {

                    // Declare categories to use to save display data.
                categories: [],
                
                    // Declare registers to use to save display data.
                registers: [],

                    // Declare Grade to use to send data in form.
                gradeData: {
                    Grado: '',
                    Descripcion: '',
                    Imagen: '',
                    Academica: '',
                    AcademicaId: '',
                },

                // Declare categorieGradeData to use to send data in form.
                categorieGradeData: {
                    Categoria: '',
                    Descripcion: '',
                    GradoId: '',
                    Grado: '',
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
            this.loadRegisterGrade();

                // Call method function to use load data in component select.
            this.loadRegisterAcademicOffer();
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
                    this.gradeData.Imagen = this.$refs.imageGrade.files[0];
                    
                        // Declae reader.
                    let reader = new FileReader();
                   
                        // Function save event to use load image.
                    reader.addEventListener('load', function (){
                        this.$refs.imageGradeDisplay.src = reader.result;
                    }.bind(this), false);

                        // Load data reader in variable.
                    reader.readAsDataURL(this.gradeData.Imagen);
                        
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
            hideNewGradeModal() {
                this.$refs.modalCreateGrade.hide();
                this.aboutusData = {
                    Grado: '',
                    Descripcion: '',
                    Imagen: '',
                    Academica: '',
                    AcademicaId: '',
                };
                this.errors = {};
            },
            
                // Event open new modal with clean form create.
            showNewGradeModal() {
                this.$refs.modalCreateGrade.show();
            },


            // Close and clear data in form create.
            hideNewCategorieGradeModal() {
                this.$refs.modalCreateCategorieGrade.hide();
                this.categorieGradeData = {
                    Categoria: '',
                    Descripcion: '',
                    GradoId: '',
                    Grado: '',
                },
                this.errors = {};
                
            },
            
                // Event open new modal with clean form create.
            showNewCategorieGradeModal(grade) {
                this.$refs.modalCreateCategorieGrade.show();

                this.categorieGradeData.GradoId = grade.Id;
            },

                // Event open modal show data in table.
            ShowModalCategorieGrade(grade) {

                    // Modal open.
                this.$refs.modalShowCategorieGrade.show();

                    // Call fuction to load data.
                this.loadRegisterCategorieGrade(grade);
            },
            
                // Function use for save data forma to send request.
            createRegisterGrade: async function () {
                let formData = new FormData();
                    formData.append('name_grade', this.gradeData.Grado);
                    formData.append('description', this.gradeData.Descripcion);
                    formData.append('id_academic_offer', this.gradeData.AcademicaId);
                    formData.append('image', this.gradeData.Imagen);

                try {
                        // Call request to create register in service.
                    await gradeService.createRegisterGrade(formData);

                        // Open swet alert to indicate success.                    
                    this.$swal.fire({
                        icon: 'success',
                        title: 'Exito',
                        text: 'El registro ha sido guardado correctamente',
                    });
                        // Clean and close form.
                    this.hideNewGradeModal();

                        // Declare variable for save request load register. 
                    const data = await gradeService.loadRegisterGrade();

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
                        this.hideNewGradeModal();
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

                // Function use for save data forma to send request.
            createRegisterCategorieGrade: async function () {
                let formData = new FormData();
                    formData.append('name_categorie', this.categorieGradeData.Categoria);
                    formData.append('description', this.categorieGradeData.Descripcion);
                    formData.append('id_grade', this.categorieGradeData.GradoId)
                try {
                        // Call request to create register in service.
                    await categorieGradeService.createRegisterCategorieGrade(formData);

                        // Open swet alert to indicate success.                    
                    this.$swal.fire({
                        icon: 'success',
                        title: 'Exito',
                        text: 'El registro ha sido guardado correctamente',
                    });
                        // Clean and close form.
                    this.hideNewCategorieGradeModal();
                    
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
                        this.hideNewCategorieGradeModal();
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
            loadRegisterGrade() {
                
                    // Decalre Promise for call request load register.
                gradeService.loadRegisterGrade().then((response)=>{
                     
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

                // Function use to load and draw data in data table.
            loadRegisterCategorieGrade(grade) {

                    // Decalre Promise for call request load register.
                categorieGradeService.loadRegisterCategorieGrade(grade).then((response)=>{
                     
                    // Declare variable registers to use load data in table.
                this.categories = response.data.data;

                }).catch((error) => {
                    console.error(error);
                });
                

            },


                // Function use to load and draw data in data table.
            loadRegisterAcademicOffer() {
                
                    // Decalre Promise for call request load register.
                academicOfferService.loadRegisterAcademicOffer().then((response)=>{
                     
                        // Declare variable registers to use load data in table.
                    this.options = response.data.data;

                }).catch((error) => {

                    console.error(error);
                });

            },

                // Function use to delete register select.
            deleteGradeRegister(grade) {
                
                // Swet alert to use question delete register. 
            this.$swal.fire({
                title: `¿Desea eliminar el registro: ${grade.Grado}?`,
                icon: 'question',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: `Eliminar`,
                denyButtonText: `Cancelar`,
                }).then((result) => {
                        
                        // The result for question in this alert is confirmed.
                    if (result.isConfirmed) {
                            
                            // Send reqeust to use delete register.
                        gradeService.deleteGradeRegister(grade.Id).then((response) =>{
                                
                                // Swet alert to use indicate success.
                            this.$swal.fire({
                                icon: 'success',
                                title: `El registro: ${grade.Grado} ha sido eliminado correctamente.`,
                                toast: true,
                                showConfirmButton: false,
                                position: 'top-end',
                                timer: 3000,
                                timerProgressBar: true,
                            });
                                // Decalre Promise for call request load register.
                            gradeService.loadRegisterGrade().then((response) => {
                                
                                    // Declare variable registers to use load data in table.
                                this.registers = response.data.data;

                            });

                        }).catch((error =>{

                            // Swet alert to use indidcate error.
                        this.$swal.fire({
                                icon: 'error',
                                title: `No es posible eliminar el registro: ${grade.Grado} en estos momentos.`,
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
                            title: `El registro;${grade.Grado}  no ha sido eliminado`,
                            toast: true,
                            showConfirmButton: false,
                            position: 'top-end',
                            timer: 3000,
                            timerProgressBar: true,
                        });
                    };
                });
            },

            // Function use to delete register select.
            deleteCategorieGradeRegister(grade) {
                
                // Swet alert to use question delete register. 
            this.$swal.fire({
                title: `¿Desea eliminar el registro: ${grade.Categoria}?`,
                icon: 'question',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: `Eliminar`,
                denyButtonText: `Cancelar`,
                }).then((result) => {

                        // The result for question in this alert is confirmed.
                    if (result.isConfirmed) {

                            // Send reqeust to use delete register.
                        categorieGradeService.deleteCategorieGradeRegister(grade.Id).then((response) =>{

                                // Swet alert to use indicate success.
                            this.$swal.fire({
                                icon: 'success',
                                title: `El registro: ${grade.Categoria} ha sido eliminado correctamente.`,
                                toast: true,
                                showConfirmButton: false,
                                position: 'top-end',
                                timer: 3000,
                                timerProgressBar: true,
                            });

                                // Call function to use load data.
                            this.loadRegisterCategorieGrade(grade.GradoId);

                        }).catch((error =>{

                            // Swet alert to use indidcate error.
                        this.$swal.fire({
                                icon: 'error',
                                title: `No es posible eliminar el registro: ${grade.Categoria} en estos momentos.`,
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
                            title: `El registro: ${grade.Categoria}  no ha sido eliminado`,
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
            hideUpdateGradeModal(){
                this.$refs.modalUpdateGrade.hide();
                 this.gradeData = {
                    Grado: '',
                    Descripcion: '',
                    Imagen: '',
                    Academica: '',
                    AcademicaId: '',
                };
                this.errors = {};
            },

                // Event open update modal with clean form.
            showUpdateGradeModal(){
                this.$refs.modalUpdateGrade.show();
            },

            // Close and clear data in form update.
            hideUpdateCategorieGradeModal(grade){
                
                    // Close modal.
                this.$refs.modalUpdateCategorieGrade.hide();
                
                    // Clean data.
                this.categorieGradeData = {
                    Categoria: '',
                    Descripcion: '',
                    GradoId: '',
                    Grado: '',
                },

                    // Clean error.
                this.errors = {};

                    // Load data.
                this.loadRegisterCategorieGrade(grade);
            },
            
                // Event open update modal with clean form.
            showUpdateCategorieGradeModal(){
                this.$refs.modalUpdateCategorieGrade.show();
            },

                // Capture dates into form update.
            updateDataGrade(grade) {
                this.gradeData = {...grade};
                this.showUpdateGradeModal();
            },

                // Method for update attach image in form.
            updateImage() {
                try {
                        // Declare value in variable.
                    this.gradeData.Imagen = this.$refs.updateImageGrade.files[0];

                        // Declae reader.
                    let reader = new FileReader();
                        
                         // Function save event to use load image.
                    reader.addEventListener('load', function (){
                        this.$refs.updateImageGradeDisplay.src = reader.result;
                    }.bind(this), false);

                        // Load data reader in variable.
                    reader.readAsDataURL(this.gradeData.Imagen);

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

                // Capture dates into form update.
            updateDataCategorieGrade(grade) {
                this.categorieGradeData = {...grade};
                this.showUpdateCategorieGradeModal();
            },

             // Function to use update register selected.
            updateRegisterCategorieGrade: async function() {

                try {
                        let formData = new FormData();
                    formData.append('name_categorie', this.categorieGradeData.Categoria);
                    formData.append('description', this.categorieGradeData.Descripcion);
                    formData.append('id_grade', this.categorieGradeData.GradoId);
                    formData.append('_method', 'put');

                    
                        // Call request in service to update data.
                    await categorieGradeService.updateRegisterCategorieGrade(this.categorieGradeData.Id, formData);

                        // Call fuction close modal.        
                    this.hideUpdateCategorieGradeModal(this.categorieGradeData.GradoId);

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
                       this.hideUpdateCategorieGradeModal(this.categorieGradeData.GradoId);

                            // Open swet alert to indicate errors.
                        this.$swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Ha ocurrido un error, vuelve a intentarlo en otro momento',
                        });
                        break;
                    };
                    
                }
            },

                // Function to use update register selected.
            updateRegisterGrade: async function() {
                try {
                        let formData = new FormData();
                    formData.append('name_grade', this.gradeData.Grado);
                    formData.append('description', this.gradeData.Descripcion);
                    formData.append('id_academic_offer', this.gradeData.AcademicaId);
                    formData.append('image', this.gradeData.Imagen);
                    formData.append('_method', 'put');
                    
                        // Call request in service to update data.
                    await gradeService.updateRegisterGrade(this.gradeData.Id, formData);
                    
                        // Declare variable for save request load register. 
                    const data = await gradeService.loadRegisterGrade();

                        // Save data in registers.
                    this.registers = data.data.data;
                    
                    this.hideUpdateGradeModal();

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
                        this.hideUpdateGradeModal();
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
