//app layout
import Layout from "../Layouts/Layout.vue";
//Dashboard
import Dashboard from "../Management/Dashboard/Dashboard.vue";
//SettingsRoutes
import SettingsRoutes from "../Management/Settings/setup/routes.js";
//routes
import TestModuleRoutes from '../Management/TestModule/setup/routes.js';



import UserRoutes from '../Management/UserManagement/User/setup/routes.js';




const routes = {
    path: '',
    component: Layout,
    children: [
        {
            path: 'dashboard',
            component: Dashboard,
            name: 'adminDashboard',
        },
        //management routes
        TestModuleRoutes,




        UserRoutes,
        //settings
        SettingsRoutes,
    ],
};

export default routes;

