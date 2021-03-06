<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);

        Artisan::call('passport:install', ['--force' => '']);
    }
}
