<?php

namespace App\Modules\UserManagement\User\Database;

use Illuminate\Database\Seeder as SeederClass;
use Illuminate\Support\Facades\Hash;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\UserManagement\User\Database\Seeder"
     */
    static $model = \App\Modules\UserManagement\User\Models\Model::class;
    public function run(): void
    {

        self::$model::truncate();
        self::$model::create([
            'name' => "Admin",
            'email' => "admin@gmail.com",
            'password' => Hash::make('12345678'),
        ]);
    }
}
