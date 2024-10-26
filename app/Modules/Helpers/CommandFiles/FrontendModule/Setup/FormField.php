<?php

use Illuminate\Support\Str;
/*
|--------------------------------------------------------------------------
|
|--------------------------------------------------------------------------
|
*/

if (!function_exists('FormField')) {
    function FormField($moduleName, $fields)
    {

        $content = <<<EOD
        export default [
        EOD;

        if (count($fields)) {
            foreach ($fields as $fieldName) {
                // dd($fieldName);
                $label = Str::of($fieldName[0])->snake()->replace('_', ' ');
                $content .= "\n\t{\n";
                $content .= "\t\tname: \"$fieldName[0]\",\n";
                $content .= "\t\tlabel: \"Enter your $label\",\n";

                if (count($fieldName) > 1) {
                    $type = $fieldName[1];
                    switch ($type) {
                        case 'longtext':
                            $content .= "\t\ttype: \"textarea\",\n";
                            break;
                        case 'date':
                            $content .= "\t\ttype: \"date\",\n";
                            break;
                        case 'number':
                        case 'integer':
                            $content .= "\t\ttype: \"number\",\n";
                            break;
                        case 'file':
                            $content .= "\t\ttype: \"file\",\n";
                            $content .= "\t\tmultiple: \"false\",\n";
                            break;
                        case 'select':
                        case 'boolean':
                        case 'tinyint':
                            $content .= "\t\ttype: \"select\",\n";
                            $content .= "\t\tlabel: \"Select default  $label\",\n";
                            $content .= "\t\tmultiple: false,\n";
                            $content .= "\t\tdata_list: [\n";
                            $content .= "\t\t\t{\n";
                            $content .= "\t\t\t\tlabel: \"Active\",\n";
                            $content .= "\t\t\t\tvalue: \"active\",\n";
                            $content .= "\t\t\t},\n";
                            $content .= "\t\t\t{\n";
                            $content .= "\t\t\t\tlabel: \"Inactive\",\n";
                            $content .= "\t\t\t\tvalue: \"inactive\",\n";
                            $content .= "\t\t\t},\n";
                            $content .= "\t\t],\n";
                            break;
                        case 'password':
                            $content .= "\t\ttype: \"password\",\n";
                            break;
                        default:
                            $content .= "\t\ttype: \"text\",\n";
                    }
                } else {
                    $content .= "\t\ttype: \"text\",\n";
                }
                $content .= "\t\tvalue: \"\",\n";
                $content .= "\t},\n";
            }
        }

        $content .= "];\n";


        return $content;
    }
}
