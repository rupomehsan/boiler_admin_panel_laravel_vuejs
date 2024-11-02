<template>
    <side-bar></side-bar>
    <div class="page-body">
        <div class="container-fluid">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import SideBar from './Partials/Sidebar/Index.vue';
export default {
    components: { SideBar },
}
</script>

<style></style>
