
import Layout from "../pages/Layout.vue";
import AdminProfileSettings from "../pages/AdminProfileSettings.vue";


const routes = {
    path: "settings",
    component: Layout,
    children: [
        {
            path: "profile-settings",
            name: "AdminProfileSettings",
            component: AdminProfileSettings,
        },
        {
            path: "site-settings",
            name: "AdminProfileSettings",
            component: AdminProfileSettings,
        },

    ],
};

export default routes;

