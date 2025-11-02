<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TcPersonUserSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('tc_person_user')->insert([
            [
                'id'             => 1,
                'id_credential'  => 1,
                'id_person'      => 1,
                'email'          => 'alex@twoclicks.com.br',
                'password'       => bcrypt('Millena2012@'),
                'active'         => 1,
                'remember_token' => 0,
                'created_at'     => $now,
                'updated_at'     => $now,
                'deleted_at'     => null,
            ],
        ]);
    }
}
