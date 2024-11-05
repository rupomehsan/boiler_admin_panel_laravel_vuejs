<template>
    <!--Start sidebar-wrapper-->
    <div id="sidebar-wrapper">
        <div class="brand-logo">
            <router-link :to="{ name: `adminDashboard` }" class="d-flex align-items-center">
                <img src="/backend/assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
                <h5 class="logo-text">Admin Panel</h5>
            </router-link>
            <div class="close-btn"><i class="zmdi zmdi-close" @click="toggle_menu"></i></div>
        </div>

        <ul class="metismenu" id="menu">
            <li>
                <router-link :to="{ name: `adminDashboard` }" class="border " href="javascript:void();">
                    <div class="parent-icon"><i class="zmdi zmdi-view-dashboard"></i></div>
                    <div class="menu-title">Dashboard</div>
                </router-link>
            </li>
            <!-- <li class="menu-label">Blog Management</li> -->
            <side-bar-drop-down-menus :icon="`fa fa-plus`" :menu_title="`User Management`" :menus="[
                {
                    route_name: `Alluser-managements`,
                    title: `Users`,
                },
                {
                    route_name: `Allblogs`,
                    title: `Blogs`,
                },

                // {
                //     route_name: `AllBlog`,
                //     title: `Blogs`,
                // },
            ]" />




        </ul>
    </div>
</template>

<script>
import { mapActions } from 'pinia'

import SideBarDropDownMenus from './SideBarDropDownMenus.vue';
import SideBarSingleMenu from './SideBarSingleMenu.vue';
export default {
    components: { SideBarDropDownMenus, SideBarSingleMenu },
    methods: {

        logout_submit: function () {
            let confirm = window.confirm('logout');
            if (confirm) {
                this.log_out();
            }
        },
        toggle_menu: function () {
            document.getElementById("wrapper").classList.toggle("toggled");
        },
    }
}
</script>

<style></style>
