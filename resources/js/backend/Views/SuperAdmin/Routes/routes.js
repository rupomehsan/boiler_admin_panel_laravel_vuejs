//app layout
import Layout from "../Layouts/Layout.vue";
//Dashboard
import Dashboard from "../Management/Dashboard/Dashboard.vue";
// routes
import user_management_routes from "../Management/TestModule/setup/routes.js";
import blog_routes from "../Management/Blog/setup/routes.js";

const routes = {
    path: '',
    component: Layout,
    children: [
        {
            path: 'dashboard',
            component: Dashboard,
            name: 'adminDashboard',
        },
        user_management_routes,
        blog_routes,
    ],
};

export default routes;
