//app layout
import Layout from "../Layouts/Layout.vue";
//Dashboard
import Dashboard from "../Management/Dashboard/Dashboard.vue";
// routes
import TestModuleOneRoutes from '../Management/TestModuleOne/setup/routes.js';


const routes = {
    path: '',
    component: Layout,
    children: [
        {
            path: 'dashboard',
            component: Dashboard,
            name: 'adminDashboard',
        },


        TestModuleOneRoutes,
    ],
};

export default routes;

