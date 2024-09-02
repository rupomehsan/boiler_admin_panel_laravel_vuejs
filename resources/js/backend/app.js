// setup  files
import './bootstrap';
import "./plugins/axios_setup.js";
import "./plugins/sweet_alert.js";
import "./plugins/moment_setup";

import { createApp } from 'vue';
import { createRouter, createWebHashHistory } from 'vue-router';
import { createPinia } from 'pinia'
import App from './views/App.vue';
// common components
import CommonInput from "./views/components/CommonInput.vue";
import ImageComponent from "../backend/views/components/ImageComponent.vue";
import Pagination from "../backend/views/components/Pagination.vue";
import DynamicSelect from '../backend/views/components/DynamicSelect.vue';
import NestedCategory from '../backend/views/components/NestedCategory.vue';
import TextEditor from '../backend/views/components/TextEditor.vue';
// project rotes
import admin_routes from "./views/pages/admin/partials/routes"
// roters
const router = createRouter({
    history: createWebHashHistory(),
    routes: [
        {
            path: "/",
            name: "home",
            component: App,
            children: [
                admin_routes,
            ]
        },
    ]
})
// previous route store
router.beforeEach((to, from, next) => {
    to.href.length > 2 &&
        window.sessionStorage.setItem('prevurl', to.href);
    next();
});

// render component
const pinia = createPinia()
const app = createApp({});

app.component('app', App);
app.component("common-input", CommonInput);
app.component("image-component", ImageComponent);
app.component("pagination", Pagination);
app.component("dynamicSelect", DynamicSelect);
app.component("nestedCategory", NestedCategory);
app.component("textEditor", TextEditor);

app.use(pinia)
app.use(router);
app.mount('#app')

