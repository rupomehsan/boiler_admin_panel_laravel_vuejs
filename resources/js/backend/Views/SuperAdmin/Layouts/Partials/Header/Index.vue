<template>
    <!--Start topbar header-->
    <header class="topbar-nav">
        <nav class="navbar navbar-expand fixed-top">
            <div class="toggle-menu">
                <i @click.prevent="toggle_menu" class="zmdi zmdi-menu"></i>

            </div>

            <a href="/" target="_blank" class="d-flex align-items-center justify-content-center mx-2"
                style="background: rgba(255, 255, 255, 0.12);    width: 30px; height: 30px; ">
                <i  class="zmdi zmdi-globe mt-1"></i>
            </a>


            <div class="search-bar flex-grow-1"></div>

            <ul class="navbar-nav align-items-center right-nav-link ml-auto">
                <li class="nav-item dropdown language">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" data-toggle="dropdown"
                        href="javascript:void();" aria-expanded="false"><i
                            class="flag-icon flag-icon-gb align-middle"></i></a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li class="dropdown-item">
                            <i class="flag-icon flag-icon-gb mr-3"></i>English
                        </li>
                        <li class="dropdown-item">
                            <i class="flag-icon flag-icon-fr mr-3"></i>French
                        </li>
                        <li class="dropdown-item">
                            <i class="flag-icon flag-icon-cn mr-3"></i>Chinese
                        </li>
                        <li class="dropdown-item">
                            <i class="flag-icon flag-icon-de mr-3"></i>German
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown dropdown-lg">
                    <a class=" btn nav-link dropdown-toggle dropdown-toggle-nocaret position-relative"
                        data-toggle="dropdown" href="javascript:void();" aria-expanded="false">
                        <i class="zmdi zmdi-comment-outline align-middle"></i><span
                            class="bg-danger text-white badge-up">12</span></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                New Messages
                                <a href="javascript:void();" class="extra-small-font">Clear All</a>
                            </li>
                            <li class="list-group-item">
                                <a href="javaScript:void();">
                                    <div class="media">
                                        <div class="avatar">
                                            <img class="align-self-start mr-3" src="avatar.png" alt="user avatar" />
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mt-0 msg-title">
                                                Jhon Deo
                                            </h6>
                                            <p class="msg-info">
                                                Lorem ipsum dolor sit amet...
                                            </p>
                                            <small>Today, 4:10 PM</small>
                                        </div>
                                    </div>
                                </a>
                            </li>

                            <li class="list-group-item text-center">
                                <a href="javaScript:void();">See All Messages</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item dropdown dropdown-lg">
                    <a role="button" class="btn nav-link dropdown-toggle dropdown-toggle-nocaret position-relative">
                        <i class="zmdi zmdi-notifications-active align-middle"></i>
                        <span class="bg-info text-white badge-up">14</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                New Notifications
                                <a href="javascript:void();" class="extra-small-font">Clear All</a>
                            </li>
                            <li class="list-group-item">
                                <a href="javaScript:void();">
                                    <div class="media">
                                        <i class="zmdi zmdi-accounts fa-2x mr-3 text-info"></i>
                                        <div class="media-body">
                                            <h6 class="mt-0 msg-title">
                                                New Registered Users
                                            </h6>
                                            <p class="msg-info">
                                                Lorem ipsum dolor sit amet...
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="btn nav-link dropdown-toggle dropdown-toggle-nocaret position-relative">
                        <span class="user-profile">
                            <img :src="`${auth_info.image ?? 'avatar.png'}`" class="img-circle" alt="user avatar" />
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li class="dropdown-item user-details">
                            <a href="javaScript:void();">
                                <div class="media">
                                    <div class="avatar">
                                        <img class="align-self-start mr-3" :src="`${auth_info.image ?? 'avatar.png'}`"
                                            alt="user avatar" />
                                    </div>
                                    <div class="media-body">
                                        <h6 class="mt-2 user-title">
                                            {{ auth_info.name }}
                                        </h6>
                                        <p class="user-subtitle">
                                            {{ auth_info.email }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li class="dropdown-item">
                            <i class="zmdi zmdi-comments mr-3"></i>Inbox
                        </li>
                        <li class="dropdown-divider"></li>

                        <li class="dropdown-divider"></li>
                        <li class="dropdown-item">
                            <router-link :to="{ name: 'AdminProfileSettings' }">
                                <i class="zmdi zmdi-accounts mr-3"></i>Profile
                            </router-link>
                        </li>
                        <li class="dropdown-item">
                            <router-link :to="{ name: 'AdminSiteSettings' }">
                                <i class="zmdi zmdi-settings mr-3"></i>Settings
                            </router-link>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li class="dropdown-item" s @click="logout()" role="button">
                            <i class="zmdi zmdi-power mr-3"></i>Logout
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
    <!--End topbar header-->
</template>

<script>
//auth_store
import { auth_store } from "../../../../../GlobalStore/auth_store";
import { mapState } from 'pinia';
export default {
    data: () => ({
        show_notification: 0,
    }),

    methods: {
        toggle_menu: function () {
            document.getElementById("wrapper").classList.toggle("toggled");
        },
        logout: async function () {
            let con = await window.s_confirm("Are you sure want to logout?");
            if (con) {
                localStorage.removeItem("admin_token");
                window.location.href = "/";
            }
        },
    },

    mounted() {
        const navItems = document.querySelectorAll(".nav-item");

        navItems.forEach((element) => {
            element.addEventListener("click", () => {
                navItems.forEach((item) => {
                    if (element !== item) {
                        if (item.childNodes[1]?.classList?.contains("show")) {
                            item.childNodes[1]?.classList?.remove("show");
                        }
                    }
                });
                element.childNodes[1].classList.toggle("show");
            });
        });
    },
    computed: {
        ...mapState(auth_store, {
            auth_info: 'auth_info',
        }),
    },
};
</script>
