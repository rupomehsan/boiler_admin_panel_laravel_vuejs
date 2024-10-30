<template>
    <div id="wrapper">
        <top-header></top-header>
        <side-bar></side-bar>
        <div class="clearfix"></div>
        <div class="content-wrapper">
            <router-view></router-view>
        </div>
        <!--End content-wrapper-->

        <!--start color switcher-->
        <footer></footer>
        <!--end color switcher-->
    </div>

</template>

<script>
import TopHeader from "../Layouts/Partials/Header/Index.vue";
import SideBar from "../Layouts/Partials/Sidebar/Index.vue";
import Footer from "../Layouts/Partials/Footer/Index.vue";
export default {
    components: { TopHeader, SideBar, Footer },
    // created: function () {
    //     let prev_url = window.sessionStorage.getItem("prevurl");
    //     let token = localStorage.getItem("token");
    //     if (token) {
    //         if (this.$route.path === "/super-admin#") {
    //             this.$router.push("/dashboard");
    //         }
    //         window.location.hash = prev_url || "/super-admin#/dashboard";
    //     } else {
    //         window.location.href = "login";
    //     }
    // },
};
</script>

<style></style>
