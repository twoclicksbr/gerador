<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TcTokenSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // 🔑 Prefixos
        $prefixPublic = 'public_';
        $prefixSecret = 'secret_';

        DB::table('tc_token')->insert([
            // Token público (sandbox)
            [
                'id'             => 1,
                'id_credential'  => 1,
                'environment'    => 'sandbox',
                'token'          => $prefixPublic . Str::random(60),
                'ip_address'     => '127.0.0.1',
                'device_info'    => 'Seeder: Sandbox environment',
                'active'         => 1,
                'created_at'     => $now,
                'updated_at'     => $now,
            ],
            // Token secreto (produção)
            [
                'id'             => 2,
                'id_credential'  => 1,
                'environment'    => 'Production',
                'token'          => $prefixSecret . Str::random(60),
                'ip_address'     => '127.0.0.1',
                'device_info'    => 'Seeder: Production environment',
                'active'         => 1,
                'created_at'     => $now,
                'updated_at'     => $now,
            ],
        ]);
    }
}
