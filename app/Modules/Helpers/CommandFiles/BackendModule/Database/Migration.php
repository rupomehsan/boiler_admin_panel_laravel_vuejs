<?php

use Illuminate\Support\Str;

if (!function_exists('Migration')) {
    function Migration($moduleName, $fields)
    {


        $table_name = '';
        $formated_module = explode('/', $moduleName);

        if (count($formated_module) > 1) {


            $moduleName = implode('/', $formated_module);
            $moduleName = Str::replace("/", "\\", $moduleName);
            $table_name = Str::plural((Str::snake($formated_module[count($formated_module) - 1])));
        } else {
            $table_name = Str::plural((Str::snake($moduleName)));
            $moduleName = Str::replace("/", "\\", $moduleName);
            // dd($moduleName);
        }

        // dd($table_name);



        $content = <<<"EOD"
        <?php

        use Illuminate\Database\Migrations\Migration;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Support\Facades\Schema;

        return new class extends Migration
        {
            /**
             php artisan migrate --path='\App\\Modules\\Management\\{$moduleName}\\Database\\create_{$table_name}_table.php'
             * Run the migrations.
             */
            public function up(): void
            {
                Schema::create('{$table_name}', function (Blueprint \$table) {
                    \$table->id();

        EOD;
        if (count($fields)) {
            foreach ($fields as $fieldName) {
                $stringLimit = 100;

                if (count($fieldName) == 1) {
                    $content .= "            \$table->string('{$fieldName[0]}, {$stringLimit}')}')->nullable();\n";
                }
                if (count($fieldName) > 1) {
                    $type = $fieldName[1];
                    //enum value set
                    $enumvalue = [];

                    $position = strpos($type, '-');

                    if ($position == 4) {
                        $enumType = explode('-', $type);
                        $type = $enumType[0];
                        $enumvalue = explode('.', $enumType[1]);
                    }

                    if ($position == 6) {
                        $limit = explode('-', $type);
                        $limit = explode('.', $limit[1]);
                        $stringLimit = $limit[0];
                    }

                    //enum value set end
                    if ($type == in_array($type, ['string', 'stringfile'])) {
                        $type = 'string';
                    } elseif (in_array($type, ['longtext', 'text'])) {
                        $type = 'text';
                    } elseif (in_array($type, ['number', 'integer', 'intiger', 'int'])) {
                        $type = 'integer';
                    } elseif (in_array($type, ['bigint', 'biginteger'])) {
                        $type = 'bigInteger';
                    } elseif (in_array($type, ['boolean', 'tinyint'])) {
                        $type = 'tinyInteger';
                    } elseif ($type == 'date') {
                        $type = 'date';
                    } elseif ($type == 'datetime') {
                        $type = 'datetime';
                    } elseif ($type == 'json') {
                        $type = 'json';
                    } elseif ($type == 'enum') {
                        $type = 'enum';
                    } elseif ($type == 'float') {
                        $type = 'float';
                    } else {
                        $type = 'string';
                    }

                    if ($type == 'enum') {
                        $enumString = implode("','", $enumvalue);
                        $content .= "            \$table->{$type}('{$fieldName[0]}', ['{$enumString}'])->nullable();\n";
                    } else if ($type == 'string') {
                        $content .= "            \$table->string('{$fieldName[0]}', {$stringLimit})->nullable();\n";
                    } else if ($type == 'tinyInteger') {
                        $content .= "            \$table->tinyInteger('{$fieldName[0]}')->default(0);\n";
                    } else {
                        $content .= "            \$table->{$type}('{$fieldName[0]}')->nullable();\n";
                    }
                }
            }
        }
        $content .= <<<EOD

                    \$table->bigInteger('creator')->unsigned()->nullable();
                    \$table->string('slug', 50)->nullable();
                    \$table->enum('status', ['active', 'inactive'])->default('active');
                    \$table->timestamps();
                    \$table->softDeletes();
                });
            }

            /**
             * Reverse the migrations.
             */
            public function down(): void
            {
                Schema::dropIfExists('{$table_name}');
            }
        };
        EOD;

        return $content;
    }
}
