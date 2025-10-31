<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TcCredentialSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('tc_credential')->insert([
            [
                'id'              => 1,
                'name'            => 'DevsAPI',
                'slug'            => Str::random(24), // ✅ mesmo padrão da criação
                'dt_limit_access' => '2030-01-01',
                'active'          => 1,
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
        ]);
    }
}
