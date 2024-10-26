import Layout from "./Layout.vue"
import Dashboard from "../Dashboard.vue"

//blog management routes
import blog_category_routes from "../management/BlogManagement/Category/setup/routes";
import blog_routes from "../management/BlogManagement/Blog/setup/routes";
//user management routes
import user_routes from "../management/UserManagement/User/setup/routes";



const routes = {
    path: '/dashboard',
    component: Layout,
    children: [
        {
            path: '',
            component: Dashboard,
            name: 'adminDashboard',
        },
        //blog management routes
        blog_category_routes,
        blog_routes,
        //user management routes
        user_routes,
    ]
};


export default routes;
