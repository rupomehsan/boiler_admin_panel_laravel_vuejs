<?php

use Illuminate\Support\Str;
/*
|--------------------------------------------------------------------------
|
|--------------------------------------------------------------------------
|
*/

if (!function_exists('SetupIndex')) {
    function SetupIndex($moduleName, $role)
    {
        $prefix = Str::singular((ucfirst($moduleName)));

        $content = <<<"EOD"
        let setup = {
            page_title: `{$prefix} Management`,
            route_prefix: `{$prefix}`,
            role_prefix:`{$role}`
        }
        export default setup;
        EOD;
        return $content;
    }
}
