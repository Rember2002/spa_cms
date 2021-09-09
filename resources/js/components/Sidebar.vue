<template>
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
           <img src="https://sge.ricaldone.edu.sv/media/img/logo.png" width="50" height="50 ">
        </div>
        <div class="sidebar-brand-text mx-1">Gestor de Contenidos</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <router-link to="/">Dashboard</router-link>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading catalogs -->
    <div class="sidebar-heading">
        Catalogos
    </div>

    <!-- Nav Item - Homepage Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseHomePage"
            aria-expanded="true" aria-controls="collapseHomePage">
            <i class="fas fa-home"></i>
            <span>Pagina Principal</span>
        </a>
        <div id="collapseHomePage" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <router-link to="/newhome" class="" exact>
                    <a class="collapse-item" href="">Noticias</a>
                </router-link>
                <router-link to="/contactus" class="" exact>
                    <a class="collapse-item" href="">Contactenos</a>
                </router-link>
                <router-link to="/carousel" class="" exact>
                    <a class="collapse-item" href="">Carousel</a>
                </router-link>
                <router-link to="" class="" exact>
                    <a class="collapse-item" href="">Menu</a>
                </router-link>
                <router-link to="/academicoffer" class="" exact>
                    <a class="collapse-item" href="">Oferta Academica</a>
                </router-link>
                <router-link to="/servicehome" class="" exact>
                    <a class="collapse-item" href="">Servicios</a>
                </router-link>
                <router-link to="/questions" class="" exact>
                    <a class="collapse-item" href="">Preguntas Frecuentes</a>
                </router-link>
                <router-link to="/salesianexperiencehome" class="" exact>
                    <a class="collapse-item" href="">Vivencia Salesiana</a>
                </router-link>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Acerca de
    </div>

    <!-- Nav Item - About us Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseAboutUs"
            aria-expanded="false" aria-controls="collapseService">
            <i class="fas fa-landmark"></i>
            <span>Contenido</span>
        </a>
        <div id="collapseAboutUs" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <router-link to="/aboutus" class="" exact>
                    <a class="collapse-item" href="login.html">Nosotros</a>
                </router-link>
                <router-link to="/strategically" class="" exact>
                    <a class="collapse-item" href="login.html">Aliados Estrategicos</a>
                </router-link>
            </div>
        </div>
        
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Oferta Academica
    </div>

    <!-- Nav Item - Academic Offer Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseOffer"
            aria-expanded="false" aria-controls="collapseOffer">
            <i class="fas fa-graduation-cap"></i>
            <span>Contenido</span>
        </a>
        <div id="collapseOffer" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <router-link to="/grade" class="" exact>
                    <a class="collapse-item" href="login.html">Grados</a>
                </router-link>
                <router-link to="" class="" exact>
                    <a class="collapse-item" href="login.html">Categorias</a>
                </router-link>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Servicios
    </div>

     <!-- Nav Item - Service Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseService"
            aria-expanded="false" aria-controls="collapseService">
            <i class="fas fa-archive"></i>
            <span>Contenido</span>
        </a>
        <div id="collapseService" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <router-link to="" class="" exact>
                    <a class="collapse-item" href="login.html">Servicio</a>
                </router-link>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Vivencia Salesiana
    </div>

     <!-- Nav Item - Salesian Experience Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseSalesianExperience"
            aria-expanded="false" aria-controls="collapseService">
            <i class="fas fa-child"></i>
            <span>Contenido</span>
        </a>
        <div id="collapseSalesianExperience" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <router-link to="/studentcouncil" class="" exact>
                    <a class="collapse-item" href="login.html">Consejo Estudiantil</a>
                </router-link>
                <router-link to="/commission" class="" exact>
                    <a class="collapse-item" href="login.html">Comisiones Estudiantiles</a>
                </router-link>
                <router-link to="/integrant" class="" exact>
                    <a class="collapse-item" href="login.html">Integrantes</a>
                </router-link>
                <router-link to="/salesianexperience" class="" exact>
                    <a class="collapse-item" href="login.html">Eventos</a>
                </router-link>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

     <!-- Heading -->
    <div class="sidebar-heading">
        Recursos
    </div>

     <!-- Nav Item - Salesian Experience Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseResource"
            aria-expanded="false" aria-controls="collapseService">
            <i class="fas fa-file-alt"></i>
            <span>Contenido</span>
        </a>
        <div id="collapseResource" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <router-link to="/resource" class="" exact>
                    <a class="collapse-item" href="login.html">Documentos</a>
                </router-link>
            </div>
        </div>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
</template>