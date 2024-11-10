<template>
    <div id="wrapper">
        <top-header></top-header>
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
import TopHeader from "./Partials/Header/Index.vue";
import Footer from "./Partials/Footer/Index.vue";
//auth_store
import { auth_store } from "../../../GlobalStore/auth_store";
import { mapActions, mapState } from 'pinia';
export default {
    components: { TopHeader, Footer },
    data: () => ({
        rightToggle: false,
    }),
    created: async function () {
        await this.check_is_auth();


        console.log("admin", this.auth_info);
        if (this.is_auth) {
            let prev_url = window.sessionStorage.getItem("prevurl");
            if (this.auth_info?.role_id == 1) {
                window.location.href = "/super-admin#/dashboard";
                if (this.$route.path === "/super-admin#") {
                    this.$router.push("/dashboard");
                }
                window.location.hash = prev_url || "/admin#/dashboard";
            } else if (this.auth_info?.role_id == 2) {
                window.location.href = "/admin#/dashboard";
                if (this.$route.path === "/admin#") {
                    this.$router.push("/dashboard");
                }
                window.location.hash = prev_url || "/admin#/dashboard";

            }
        } else {
            window.location.href = "login";
        }

    },
    methods: {
        ...mapActions(auth_store, {
            check_is_auth: 'check_is_auth',
        }),
        changeTheme(id) {
            const totalThemes = Array.from({ length: 15 }, (_, i) => i + 1);
            const newThemeNo = "bg-theme" + id;
            const body = document.getElementById("body");

            totalThemes.forEach((item) => {
                const currentThemeClass = "bg-theme" + item;
                if (body.classList.contains(currentThemeClass)) {
                    body.classList.remove(currentThemeClass);
                }
            });

            body.classList.add(newThemeNo);
        },
    },

    computed: {
        ...mapState(auth_store, {
            auth_info: 'auth_info',
            is_auth: 'is_auth',
        }),
    },
};
</script>

<style></style>
