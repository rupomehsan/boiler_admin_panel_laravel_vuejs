<template>
    <!--Start sidebar-wrapper-->
    <div id="sidebar-wrapper">
        <div class="brand-logo">
            <router-link :to="{ name: `adminDashboard` }" class="d-flex align-items-center">
                <img src="/backend/assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
                <h5 class="logo-text">Admin Panel</h5>
            </router-link>
            <div class="close-btn"><i class="zmdi zmdi-close"></i></div>
        </div>

        <ul class="metismenu" id="menu">
            <li>
                <router-link :to="{ name: `adminDashboard` }" class="border " href="javascript:void();">
                    <div class="parent-icon"><i class="zmdi zmdi-view-dashboard"></i></div>
                    <div class="menu-title">Dashboard</div>
                </router-link>
            </li>
            <!-- <li class="menu-label">Blog Management</li> -->
            <side-bar-drop-down-menus :icon="`fa fa-plus`" :menu_title="`Blog Management`" :menus="[
                {
                    route_name: `AllCategory`,
                    title: `Blog Category`,
                },
                {
                    route_name: `AllBlog`,
                    title: `Blogs`,
                },
            ]" />

            <side-bar-drop-down-menus :icon="`fa fa-plus`" :menu_title="`User Management`" :menus="[
                {
                    route_name: `AllUser`,
                    title: `Users`,
                },

            ]" />


        </ul>
    </div>
</template>

<script>
import { mapActions } from 'pinia'
import { auth_store } from '../../../../store/auth_store';
import SideBarDropDownMenus from './SideBarDropDownMenus.vue';
import SideBarSingleMenu from './SideBarSingleMenu.vue';
export default {
    components: { SideBarDropDownMenus, SideBarSingleMenu },
    methods: {
        ...mapActions(auth_store, ['log_out']),
        logout_submit: function () {
            let confirm = window.confirm('logout');
            if (confirm) {
                this.log_out();
            }
        }
    }
}
</script>

<style></style>
