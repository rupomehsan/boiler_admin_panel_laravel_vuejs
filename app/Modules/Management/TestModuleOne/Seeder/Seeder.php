<?php

namespace App\Modules\Management\TestModuleOne\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\Management\TestModuleOne\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\TestModuleOne\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i < 100; $i++) {
            self::$model::create([
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
                'phone' => $faker->randomNumber,
                'gender' => $faker->randomElement(array(
                    0 => 'male',
                    1 => 'female',
                )),
                'tags' => json_encode([$faker->word, $faker->word]),
                'price' => $faker->randomFloat(2, 0, 1000),
                'is_show' => $faker->boolean,
                'content' => $faker->text,
            ]);
        }
    }
}
