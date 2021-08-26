<template>
    <main>

        <!-- Page Wrapper -->
    <div id="wrapper">

        <Sidebar />

        

            <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <Header />

            <router-view>
                
            </router-view>  

            <Footer />
        </div>
        <!-- End of Content Wrapper -->

    </div>

    </main>
</template>

<script>
    import Header from './components/Header.vue'
    import Sidebar from './components/Sidebar.vue'
    import Footer from './components/Footer.vue'
    export default {
        components: {
            Header,
            Sidebar,
            Footer
        }
    }
</script>
