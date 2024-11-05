<?php

use Illuminate\Support\Str;
/*
|--------------------------------------------------------------------------
|
|--------------------------------------------------------------------------
|
*/

if (!function_exists('SetupIndex')) {
    function SetupIndex($moduleName,$fields)
    {
        $prefix = Str::singular((ucfirst($moduleName)));
        $apiName = Str::plural((Str::kebab($moduleName)));
        $store = Str::singular((Str::snake($moduleName)));
        dd($fields,$prefix, $apiName, $store);
        $content = <<<"EOD"
        import app_config from "../../../../../Config/app_config";
        import setup_type from "./setup_type";

        const prefix: string = "{$prefix}";

        const setup: setup_type = {
            prefix,
            permission: [`admin`, `super_admin`],

            api_host: app_config.api_host,
            api_version: app_config.api_version,
            api_end_point: "{$apiName}",

            module_name: "user-managements",
            store_prefix: "{$store}",
            route_prefix: `user-managements`,
            route_path: `user-managements`,

            select_fields: ["id", "name", "email", "phone", "slug", "status", "created_at",],

            sort_by_cols: ["id", "name","email", "phone", "created_at", "status"],

            layout_title: prefix + " Management",
            page_title: `\${prefix} Management`,

            all_page_title: "All " + prefix,
            details_page_title: "Details " + prefix,
            create_page_title: "Create " + prefix,
            edit_page_title: "Edit " + prefix,
        };

        export default setup;

        EOD;
        return $content;
    }
}
