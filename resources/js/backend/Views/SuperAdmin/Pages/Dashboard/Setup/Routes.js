import setup from ".";
import All from "../All.vue";
import Form from "../Form.vue";
import Index from "./Index.vue";

let route_prefix = setup.route_prefix;

const routes = {
    path: "dasboard",
    component: Index,

};

export default routes;
