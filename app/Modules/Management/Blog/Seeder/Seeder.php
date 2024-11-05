<?php
namespace App\Modules\Management\Blog\Seeder;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\Management\Blog\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\Blog\Models\Model::class;
    public function run(): void
    {

        self::$model::truncate();
        for ($i = 1; $i < 100; $i++) {
        self::$model::create([
            'title' => facker()->name,
            'description' => facker()->name,
            ]);
        }
    }
}