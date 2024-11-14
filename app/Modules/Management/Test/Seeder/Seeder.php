<?php
namespace App\Modules\Management\Test\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\Management\Test\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\Test\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'name' => $faker->text(100),
                'age' => $faker->randomNumber,
                'designation' => $faker->text(100),
            ]);
        }
    }
}