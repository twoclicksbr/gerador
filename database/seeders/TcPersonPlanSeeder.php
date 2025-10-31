<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TcPersonPlanSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('tc_person_plan')->insert([
            [
                'id'             => 1,
                'id_credential'  => 1,
                'id_person'      => 1,
                'id_plan'        => 3,
                'payment_cycle'  => 'annual',
                'dt_start'       => $now,
                'dt_end'         => $now->copy()->addDays(365),
                'active'         => 1,
                'created_at'     => $now,
                'updated_at'     => $now,
                'deleted_at'     => null,
            ],
        ]);
    }
}
