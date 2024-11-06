<?php

use Illuminate\Support\Str;

if (!function_exists('SetupIndex')) {
    function SetupIndex($moduleName, $fields)
    {
        $prefix = Str::singular(ucfirst($moduleName));
        $Name = Str::singular(Str::kebab($moduleName));
        $apiName = Str::plural(Str::kebab($moduleName));
        $store = Str::singular(Str::snake($moduleName));

        // Extract the first element from each field array in $fields
        $form_fields = array_column($fields, 0);

        // Create select_fields and sort_by_cols as comma-separated strings
        $selectFields = implode(",\n            ", array_map(fn($field) => "\"$field\"", $form_fields));
        $sortByCols = implode(",\n            ", array_map(fn($field) => "\"$field\"", $form_fields));

        $content = <<<"EOD"
        import app_config from "../../../../../Config/app_config";
        import setup_type from "./setup_type";

        const prefix: string = "{$prefix}";

        const setup: setup_type = {
            prefix,
            permission: ["admin", "super_admin"],

            api_host: app_config.api_host,
            api_version: app_config.api_version,
            api_end_point: "{$apiName}",

            module_name: "{$Name}",
            store_prefix: "{$store}",
            route_prefix: "{$prefix}",
            route_path: "{$Name}",

            select_fields: [
                "id",
                {$selectFields},
                "slug",
                "created_at",
            ],

            sort_by_cols: [
                "id",
                {$sortByCols},
                "created_at",
            ],

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
