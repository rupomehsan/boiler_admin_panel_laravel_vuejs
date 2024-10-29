<?php

use Illuminate\Support\Str;

if (!function_exists('Model')) {
    function Model($moduleName, $class_name)
    {


        $formated_module = explode('/', $moduleName);

        if (count($formated_module) > 1) {

            $moduleName = implode('/', $formated_module);
            $moduleName = Str::replace("/", "\\", $moduleName);
        } else {
            $moduleName = Str::replace("/", "\\", $moduleName);
        }

        $table_name = Str::plural((Str::snake($class_name)));



        $content = <<<"EOD"
            <?php

            namespace App\\Modules\\Management\\{$moduleName}\\Models;

            use Illuminate\Database\Eloquent\Model as EloquentModel;
            use Illuminate\Support\Str;

            class Model extends EloquentModel
            {
                protected \$table = "{$table_name}";
                protected \$guarded = [];

                protected static function booted()
                {
                    static::created(function (\$data) {
                        \$random_no = random_int(100, 999) . \$data->id . random_int(100, 999);
                        \$slug = \$data->title . " " . \$random_no;
                        \$data->slug = Str::slug(\$slug); //use Illuminate\Support\Str;
                        if (strlen(\$data->slug) > 150) {
                            \$data->slug = substr(\$data->slug, strlen(\$data->slug) - 150, strlen(\$data->slug));
                        }
                        if (auth()->check()) {
                            \$data->creator = auth()->user()->id;
                        }
                        \$data->save();
                    });
                }

                public function scopeActive(\$q)
                {
                    return \$q->where('status', 'active');
                }
            }
            EOD;

        return $content;
    }
}
