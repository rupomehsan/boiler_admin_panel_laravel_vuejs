<template>
    <li>
        <router-link :to="{name: route_name}">
            <div class="parent-icon"><i :class="icon"></i></div>
            <div class="menu-title">{{ menu_title }}</div>
            <!-- <div class="badge badge-light ml-auto">New</div> -->
        </router-link>
    </li>
</template>

<script>
export default {
    props: {
        menu_title: String,
        route_name: String,
        icon: {
            type: String,
            default: ()=> "zmdi zmdi-view-dashboard",
        }
    },
}
</script>

<style></style>
