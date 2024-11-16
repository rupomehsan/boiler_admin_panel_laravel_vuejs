
import Layout from "../pages/Layout.vue";
import AdminProfileSettings from "../pages/AdminProfileSettings.vue";
import AdminSiteSettings from "../pages/SiteSettings.vue";


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
            name: "AdminSiteSettings",
            component: AdminSiteSettings,
        },

    ],
};

export default routes;

