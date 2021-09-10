    <!-- Begin template. -->
<template>
    <!-- Begin page content. -->
<div class="container-fluid">

    <!-- Page heading. -->
    <div class="d-sm-flex align-items-center justify-content-center mb-4">
        <h1 class="mb-0 text-gray-800">Servicios</h1>
    </div>
    
        <!-- Data table. -->
    <div class="card">
            <!-- Header data table. -->
        <div class="card-body d-flex">
            <h4><span><i class="fas fa-table"></i>  Visualización de datos</span></h4>
            <button class="btn btn-success btn-sm ml-auto" @click="showNewServiceModal"><span><i class="fa fa-plus"></i></span>Agregar Registro</button>
        </div>
            <!-- Content data table. -->
        <div class="card-body table-responsive  align-items-center justify-content-center">
            <table id="tableRegisters" class="table table-hover table-responsive table-bordered">  
                <thead class="table-dark">
                    <tr>
                        <td>Id</td>
                        <td>Servicio</td>
                        <td>Descripcion</td>
                        <td>Enlace</td>
                        <td>Estado</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(service, index) in registers" :key="index">
                        <td>{{service.Id}}</td>
                        <td>{{service.Servicio}}</td>
                        <td>{{service.Descripcion}}</td>
                        <td><a target="_blank" :href="`${service.Enlace}`"><button class="btn btn-primary"><span class="fas fa-external-link-square-alt"></span>Abiir enlace</button></a></td>
                        <td>{{service.Estado}}</td>
                        <td>
                            <button class="btn btn-success btn-sm" @click="updateDataService(service)"><span class="fa fa-edit"></span></button>
                            <button class="btn btn-danger btn-sm" @click="deleteServiceRegister(service)"><span class="fa fa-trash"></span></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
            <!-- End content data table. -->
    </div>
        <!--End data table. -->

        <!-- Content modal create. -->
    <b-modal ref="modalCreateAboutUs" hide-footer size="xl" title="Agregar Nuevo Registro">
        <div class="d-block">
                <!-- Form modal create. -->
            <form v-on:submit.prevent="createRegisterAboutUs">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Titulo:</label>
                        <b-form-input :state="aboutusData.Titulo.length >= 1 && aboutusData.Titulo.length < 50" type="text" class="form-control" id="name" v-model="aboutusData.Titulo" placeholder="Ingresar Titulo" autocomplete="off"></b-form-input>
                        <div class="invalid-feedback-validation" v-if="errors.name">{{errors.name[0]}}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="description">Descripcion:</label>
                        <b-form-textarea :state="aboutusData.Contenido.length >= 1 && aboutusData.Contenido.length < 1000" type="text" class="form-control" id="description" v-model="aboutusData.Contenido" placeholder="Ingresar Descripcion" autocomplete="off"></b-form-textarea>                 
                        <div class="invalid-feedback-validation" v-if="errors.description">{{errors.description[0]}}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="type">Tipo:</label>
                        <b-form-select :state="aboutusData.Tipo != ''" v-model="aboutusData.Tipo" :options="options" id="type" multiple :select-size="4"></b-form-select>
                        <div class="invalid-feedback-validation" v-if="errors.type">{{errors.type[0]}}</div>                    
                    </div>
                    <div class="form-group col-md-6">
                        <label for="year">Año:</label>
                        <b-form-input :state="aboutusData.Año >= 2020 && aboutusData.Año < 2099" type="text" class="form-control" id="year" v-model="aboutusData.Año" placeholder="Ingresar Año" autocomplete="off"></b-form-input>
                        <div class="invalid-feedback-validation" v-if="errors.year">{{errors.year[0]}}</div>                    
                    </div>
                    <div class="form-group col-md-12">
                        <label for="image">Imagen:</label>
                        <div v-if="aboutusData.Portada.name">
                            <img src="" ref="imageAboutUsDisplay" width="700" height="300">  
                        </div>
                        <input accept="image/png,image/jpeg" type="file" v-on:change="attachImage" ref="imageAboutUs" class="form-control" id="image"/>
                        <div class="invalid-feedback-validation" v-if="errors.image">{{errors.image[0]}}</div>                    
                    </div>
                </div>
                <hr>
                <div class="text-center">    
                    <button type="button" class="btn btn-default" @click="hideNewAboutUsModal">Cancelar</button>
                    <button type="submit" class="btn btn-success"><span class="fa fa-check"></span>Aceptar</button>
                </div>
            </form> 
                <!-- End form modal create. -->
        </div>
    </b-modal>
        <!-- End modal create. -->

        <!-- Content modal update. -->
    <b-modal ref="modalUpdateAboutUs" hide-footer size="xl" title="Modificar Registro">
        <div class="d-block">
                <!-- Form modal update. -->
            <form v-on:submit.prevent="updateRegisterAboutUs">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Titulo:</label>
                        <b-form-input :state="aboutusData.Titulo.length >= 1 && aboutusData.Titulo.length < 50" type="text" class="form-control" id="name" v-model="aboutusData.Titulo" placeholder="Ingresar Titulo"></b-form-input>
                        <div class="invalid-feedback-validation" v-if="errors.name">{{errors.name[0]}}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="description">Descripcion:</label>
                        <b-form-textarea :state="aboutusData.Contenido.length >= 1 && aboutusData.Contenido.length < 1000" type="text" class="form-control" id="description" v-model="aboutusData.Contenido" placeholder="Ingresar Descripcion"></b-form-textarea>                 
                        <div class="invalid-feedback-validation" v-if="errors.description">{{errors.description[0]}}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="type">Tipo:</label>
                        <b-form-select :state="aboutusData.Tipo != ''" v-model="aboutusData.Tipo" :options="options" id="type" multiple :select-size="4"></b-form-select>
                        <div class="invalid-feedback-validation" v-if="errors.type">{{errors.type[0]}}</div> 
                    </div>
                    <div class="form-group col-md-6">
                        <label for="year">Año:</label>
                        <b-form-input :state="aboutusData.Año >= 2020 && aboutusData.Año < 2099" type="text" class="form-control" id="year" v-model="aboutusData.Año" placeholder="Ingresar Año"></b-form-input>
                        <div class="invalid-feedback-validation" v-if="errors.year">{{errors.year[0]}}</div>                    
                    </div>
                    <div class="form-group col-md-12">
                        <label for="image">Imagen:</label>
                        <div>
                            <img :src="`${$store.state.serverPath}/storage/${aboutusData.Portada}`" ref="updateImageAboutUsDisplay" width="700" height="300">  
                        </div>
                        <input accept="image/png,image/jpeg" type="file" v-on:change="updateImage" ref="imageUpdateAboutUs" class="form-control" id="image"/>
                        <div class="invalid-feedback-validation" v-if="errors.image">{{errors.image[0]}}</div>                    
                    </div>
                </div>
                <hr>
                <div class="text-center">    
                    <button type="button" class="btn btn-default" @click="hideUpdateAboutUsModal">Cancelar</button>
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