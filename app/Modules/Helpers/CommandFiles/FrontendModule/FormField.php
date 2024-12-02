<?php

use Illuminate\Support\Str;
/*
|--------------------------------------------------------------------------
|
|--------------------------------------------------------------------------
|
*/

if (!function_exists('FormField')) {
    function FormField($fields)
    {



        $content = <<<EOD
        export default [
        EOD;

        if (count($fields)) {
            foreach ($fields as $fieldName) {
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
                        case 'datetime':
                            $content .= "\t\ttype: \"datetime\",\n";
                            break;
                        case 'int':
                        case 'integer':
                        case 'bigint':
                            $content .= "\t\ttype: \"number\",\n";
                            break;
                        case 'tinyint':
                        case 'boolean':
                            $content .= "\t\ttype: \"radio\",\n";
                            break;
                        case 'stringfile':
                            $content .= "\t\ttype: \"file\",\n";
                            $content .= "\t\tmultiple: \"false\",\n";
                            break;
                        case strpos($type, 'enum-') === 0: // Handle enums dynamically
                            $options = explode('.', str_replace('enum-', '', $type));
                            $content .= "\t\ttype: \"select\",\n";
                            $content .= "\t\tlabel: \"Select $label\",\n";
                            $content .= "\t\tmultiple: false,\n";
                            $content .= "\t\tdata_list: [\n";
                            foreach ($options as $option) {
                                $content .= "\t\t\t{\n";
                                $content .= "\t\t\t\tlabel: \"" . ucfirst($option) . "\",\n";
                                $content .= "\t\t\t\tvalue: \"$option\",\n";
                                $content .= "\t\t\t},\n";
                            }
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
