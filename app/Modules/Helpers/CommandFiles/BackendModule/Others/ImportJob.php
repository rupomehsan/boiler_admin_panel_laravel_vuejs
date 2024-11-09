<?php

use Illuminate\Support\Str;

if (!function_exists('ImportJob')) {
    function ImportJob($moduleName)
    {
        $formated_module = explode('/', $moduleName);

        if (count($formated_module) > 1) {

            $moduleName = implode('/', $formated_module);
            $moduleName = Str::replace("/", "\\", $moduleName);
        } else {
            $moduleName = Str::replace("/", "\\", $moduleName);
        }

        $content = <<<"EOD"
        <?php

        namespace App\\Modules\\Management\\{$moduleName}\\Others;

        use Illuminate\Bus\Batchable;
        use Illuminate\Bus\Queueable;
        use Illuminate\Contracts\Queue\ShouldQueue;
        use Illuminate\Foundation\Bus\Dispatchable;
        use Illuminate\Queue\InteractsWithQueue;
        use Illuminate\Queue\SerializesModels;
        use Illuminate\Support\Facades\Artisan;

        class ImportJob implements ShouldQueue
        {
            use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

            /**
             * Create a new job instance.
             */
            public \$data;
            public \$header;

            public function __construct(\$data, \$header)
            {
                \$this->data = \$data;
                \$this->header = \$header;
            }

            /**
             * Execute the job.
             */
            public function handle(): void
            {

                \$model = \App\\Modules\\Management\\{$moduleName}\\Models\\Model::class;
                foreach (\$this->data as \$item) {
                    \$StoreData = array_combine(\$this->header, \$item);
                    \$model::create(\$StoreData);
                }

            }
        }

        EOD;
        // $route = Str::plural((Str::kebab($moduleName)));
        // $content = str_replace('{route_name}', $route, $content);
        return $content;
    }
}
