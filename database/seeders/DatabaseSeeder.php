<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            TcCredentialSeeder::class,

            TcPlanSeeder::class,
            TcPlanFeatureSeeder::class,

            TcTypeAddressSeeder::class,

            TcPersonSeeder::class,
            TcPersonUserSeeder::class,
            TcPersonPlanSeeder::class,
            TcAddressSeeder::class,
            // TcTokenSeeder::class,
        ]);
    }
}
