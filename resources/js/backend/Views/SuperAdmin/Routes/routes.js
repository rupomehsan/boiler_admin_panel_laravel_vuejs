//blog management routes
import Dashboard from "../Pages/Dashboard/Dashboard.vue";
import Layout from "../Layouts/Partials/Layout.vue";

const routes = {
    path: '',
    component: Layout,
    children: [
        {
            path: 'dashboard',
            component: Dashboard,
            name: 'adminDashboard',
        },
    ],
};

export default routes;
