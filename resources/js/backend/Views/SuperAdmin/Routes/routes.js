//app layout
import Layout from "../Layouts/Layout.vue";
//Dashboard
import Dashboard from "../Management/Dashboard/Dashboard.vue";
//profile
import Profile from "../Management/Profile/Index.vue";
// routes
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
        {
            path: 'profile',
            component: Profile,
            name: 'Profile',
        },
        UserRoutes,
    ],
};

export default routes;

