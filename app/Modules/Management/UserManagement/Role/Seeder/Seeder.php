<?php

namespace App\Modules\Management\UserManagement\Role\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\Management\UserManagement\Role\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\UserManagement\Role\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        self::$model::create([
            'name' => "super_admin",
            'serial_no' => 1,
        ]);
        self::$model::create([
            'name' => "admin",
            'serial_no' => 2,
        ]);
    }
}
