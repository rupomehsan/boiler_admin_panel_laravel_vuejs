<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Modules\Management\UserManagement\User\Seeder\Seeder as UserSeeder;
use App\Modules\Management\SettingManagement\WebsiteSettings\Seeder\Seeder as WebsiteSettingsSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            WebsiteSettingsSeeder::class,
        ]);
    }
}
