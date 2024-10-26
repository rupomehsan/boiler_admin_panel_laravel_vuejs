<?php

use Illuminate\Support\Str;
/*
|--------------------------------------------------------------------------
|
|--------------------------------------------------------------------------
|
*/
if (!function_exists('Router')) {
    function Router($moduleName)
    {


        $moduleName = Str::singular((Str::kebab($moduleName)));

        $content = <<<"EOD"
        import setup from ".";
        import All from "../All.vue";
        import Form from "../Form.vue";
        import Layout from "./Layout.vue";

        let route_prefix = setup.route_prefix;

        const routes =
        {
            path: '{$moduleName}',
            component: Layout,
            children: [
                {
                    path: '',
                    name: "All" + route_prefix,
                    component: All,
                },
                {
                    path: "create",
                    name: "Create" + route_prefix,
                    component: Form,
                },

            ]
        };


        export default routes;

        EOD;

        return $content;
    }
}
