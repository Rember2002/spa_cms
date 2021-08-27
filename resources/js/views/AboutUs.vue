<template>
    <!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-center mb-4">
        <h1 class="mb-0 text-gray-800">Acerca de</h1>
    </div>

        <!--Table -->
    <div class="card">
            <!-- Header Table -->
        <div class="card-header d-flex">
            <h4><span><i class="fas fa-table"></i>  Visualización de datos</span></h4>
            <button class="btn btn-success btn-sm ml-auto" @click="showNewAboutUsModal"><span><i class="fa fa-plus"></i></span>Agregar Registro</button>
        </div>
            <!-- Content Table -->
        <div class="card-body">
            <table class="table"> 
                <thead>
                    <tr>
                        <td>Id</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>
                            <button class="btn btn-success btn-sm"><span class="fa fa-edit"></span></button>
                            <button class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
        <!--End content Table -->

        <!-- Content Modal -->
    <b-modal ref="modalAboutUs" hide-footer size="xl" title="Agregar Nuevo Registro">
        <div class="d-block">
                <!-- Form Modal -->
            <form v-on:submit.prevent="createRegisterAboutUs">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Titulo:</label>
                        <input type="text" class="form-control" id="name" v-model="aboutusData.name" placeholder="Ingresar Titulo">
                        <div class="invalid-feedback" v-if="errors.name">{{errors.name[0]}}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="description">Descripcion:</label>
                        <input type="text" class="form-control" id="description" v-model="aboutusData.description" placeholder="Ingresar Titulo">
                        <div class="invalid-feedback" v-if="errors.description">{{errors.description[0]}}</div>                        
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name">Tipo:</label>
                        <b-form-select v-model="aboutusData.type"  :options="options" multiple :select-size="4"></b-form-select>
                        <div class="invalid-feedback" v-if="errors.type">{{errors.type[0]}}</div>                    
                    </div>
                    <div class="form-group col-md-6">
                        <label for="year">Año:</label>
                        <input type="numeric" class="form-control" id="year" v-model="aboutusData.year" placeholder="Ingresar Año">
                        <div class="invalid-feedback" v-if="errors.year">{{errors.year[0]}}</div>                    
                    </div>
                    <div class="form-group col-md-12">
                        <label for="image">Imagen:</label>
                        <div v-if="aboutusData.image.name">
                            <img src="" ref="imageAboutUsDisplay" width="700" height="300">  
                        </div>
                        <input type="file" v-on:change="attachImage" ref="imageAboutUs" class="form-control" id="image"/>
                        <div class="invalid-feedback" v-if="errors.image">{{errors.image[0]}}</div>                    
                    </div>
                </div>
                <hr>
                <div class="text-center">    
                    <button type="button" class="btn btn-default" @click="hideNewAboutUsModal">Cancelar</button>
                    <button type="submit" class="btn btn-success"><span class="fa fa-check"></span>Aceptar</button>
                </div>
            </form>  
        </div>
    </b-modal>

</div>
<!-- /.container-fluid -->
</template>

<script>
    
    import * as aboutUsService from '../services/aboutus_service';

    export default {

        name: 'aboutus',

        data(){
            return {

                aboutusData: {
                    name: '',
                    description: '',
                    type: [''],
                    year: '',
                    image: '',
                },

                options: [
                    { value: 'Mission', text: 'Mision' },
                    { value: 'View', text: 'Vision' },
                    { value: 'Value', text: 'Valor' },
                ],

                errors: {},
            }
        },

        methods: {
            attachImage() {
                this.aboutusData.image = this.$refs.imageAboutUs.files[0];
                let reader = new FileReader();
                reader.addEventListener('load', function (){
                    this.$refs.imageAboutUsDisplay.src = reader.result;
                }.bind(this), false);

                reader.readAsDataURL(this.aboutusData.image);
            },

            hideNewAboutUsModal() {
                this.$refs.modalAboutUs.hide();
            },

            showNewAboutUsModal() {
                this.$refs.modalAboutUs.show();
            },

            createRegisterAboutUs: async function() {
                let formData = new FormData();
                formData.append('name', this.aboutusData.name);
                formData.append('description', this.aboutusData.description);
                formData.append('year', this.aboutusData.type);
                formData.append('year', this.aboutusData.year);
                formData.append('image', this.aboutusData.image);

                try {
                    const response = await aboutUsService.createRegisterAboutUs(formData);
                    console.log(response);
                } catch (error) {
                    switch (error.response.status) {
                        case 422:
                            this.errors = error.response.data.errors;
                            break;

                        default:
                            alert('Ocurrio algun error')
                            break;
                    }
                }
            }
        },
    }
</script>
