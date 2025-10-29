<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TcPlanSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('tc_plan')->insert([
            [
                'id' => 1,
                'id_credential' => 1,
                'name' => 'Starter',
                'price_monthly' => 297.00,
                'price_yearly' => 2970.00,
                'active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'id_credential' => 1,
                'name' => 'Standard',
                'price_monthly' => 597.00,
                'price_yearly' => 5970.00,
                'active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 3,
                'id_credential' => 1,
                'name' => 'Infinite',
                'price_monthly' => 897.00,
                'price_yearly' => 8970.00,
                'active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
