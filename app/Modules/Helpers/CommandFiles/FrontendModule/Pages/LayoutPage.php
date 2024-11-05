<?php

use Illuminate\Support\Str;
/*
|--------------------------------------------------------------------------
|
|--------------------------------------------------------------------------
|
*/

if (!function_exists('LayoutPage')) {
    function LayoutPage()
    {


        $content = <<<"EOD"
        <template>
            <router-view></router-view>
        </template>

        <script>

        export default {

        }
        </script>

        <style></style>

        EOD;

        return $content;
    }
}
