<template>
    <li :class="`mm-collapse ${is_show && 'mm-active'}`" style="border: 1px solid rgba(128, 128, 128, 0.267);">
        <a @click.prevent="is_show = !is_show" class="has-arrow" href="#">
            <div class="parent-icon">
                <i :class="icon"></i>
            </div>
            <div class="menu-title">{{ menu_title }}</div>
        </a>
        <ul :class="`mm-collapse ${is_show && 'mm-show'}`">
            <li v-for="(menu, index) in menus" :key="index" >
                <router-link :to="{name: menu.route_name}">
                    <i class="zmdi zmdi-dot-circle-alt"></i>
                    {{ menu.title }}
                </router-link>
            </li>
        </ul>
    </li>
</template>

<script>
export default {
    props: {
        menu_title: String,
        menus: Array,
        icon: {
            type: String,
            default: ()=> "zmdi zmdi-dashboard",
        }
    },
    data: () => ({
        is_show: 0,
    }),
}
</script>

<style></style>
