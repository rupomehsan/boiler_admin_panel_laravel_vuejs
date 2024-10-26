<?php

namespace App\Modules\BlogManagement\Category;

use Illuminate\Database\Seeder as SeedersSeeder;

class Seeder extends SeedersSeeder
{
    /**
     * Run the database seeds.
     */
    static $model = \App\Modules\BlogManagement\Category\Model::class;
    public function run(): void
    {
        self::$model::truncate();

        self::$model::create([
            "title" => "Islamic",
        ]);

        self::$model::create([
            "title" => "Quran",
            "parent_id" => 1,
        ]);

        self::$model::create([
            "title" => "Hadish",
            "parent_id" => 1,
        ]);

        self::$model::create([
            "title" => "Programing",
        ]);
        self::$model::create([
            "title" => "PHP",
            "parent_id" => 4,
        ]);
        self::$model::create([
            "title" => "Laravel",
            "parent_id" => 5,
        ]);
        self::$model::create([
            "title" => "Javascript",
            "parent_id" => 4,
        ]);
    }
}
