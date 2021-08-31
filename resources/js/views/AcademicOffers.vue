<template>
    <!-- Begin page content. -->
<div class="container-fluid">

    <!-- Page heading. -->
    <div class="d-sm-flex align-items-center justify-content-center mb-4">
        <h1 class="mb-0 text-gray-800">Oferta Academica</h1>
    </div>

        <!-- Begin container table. -->
    <b-container fluid>
            <!-- Begin interfaces controls for data table. -->
        <b-row>
            <b-col lg="12">
                <b-form-group label="Filter" label-for="filter-input" label-cols-sm="3" label-align-sm="right" label-size="sm" class="mb-0">
                    <b-input-group size="sm">
                        <b-form-input id="filter-input" v-model="filter" type="search" placeholder="Type to Search"></b-form-input>
                        <b-input-group-append>
                            <b-button :disabled="!filter" @click="filter = ''">Clear</b-button>
                        </b-input-group-append>
                    </b-input-group>
                </b-form-group>
            </b-col>
        </b-row>
            <!-- End interfaces controls for data tables. -->

            <!-- Begin component data table. -->
        <b-table
            :items="items"
            :fields="fields"
            :current-page="currentPage"
            :per-page="perPage"
            :filter="filter"
            :filter-included-fields="filterOn"
            :sort-by.sync="sortBy"
            :sort-desc.sync="sortDesc"
            :sort-direction="sortDirection"
            stacked="md"
            show-empty
            small
            @filtered="onFiltered"
        >
            <template #cell(name)="row">
                {{ row.value.first }} {{ row.value.last }}
            </template>

            <template #cell(actions)>
                <button class="btn btn-success btn-sm" @click="updateDataAboutUs(aboutus)"><span class="fa fa-edit"></span></button>
                            <button class="btn btn-danger btn-sm" @click="deleteAboutUsRegister(aboutus)"><span class="fa fa-trash"></span></button>
            </template>

            <template #row-details="row">
                <b-card>
                <ul>
                    <li v-for="(value, key) in row.item" :key="key">{{ key }}: {{ value }}</li>
                </ul>
                </b-card>
            </template>

        </b-table>
            <!-- Begin component data table. -->
    </b-container>
        <!-- End container table. -->
</div>
<!-- End container fluid. -->    
</template>

<script>
export default {
    name: 'academicoffer',
     
}
</script>

