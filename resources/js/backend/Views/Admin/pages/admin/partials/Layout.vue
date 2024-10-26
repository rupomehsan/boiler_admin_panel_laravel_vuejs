<template>
    <div>
        <side-bar></side-bar>
        <div class="page-body">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import SideBar from './SideBar.vue';
export default {
    components: { SideBar },

}
</script>

<style></style>
