<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TcTypeAddressSeeder extends Seeder
{
    public function run(): void
    {
        $date = Carbon::create('2000', '01', '01', '00', '00', '00');

        DB::table('tc_type_address')->insert([
            [
                'id'             => 1,
                'id_credential'  => 1, // ✅ FK obrigatória
                'name'           => 'Residencial',
                'active'         => 1,
                'created_at'     => $date,
                'updated_at'     => $date,
                'deleted_at'     => null,
            ],
            [
                'id'             => 2,
                'id_credential'  => 1, // ✅ FK obrigatória
                'name'           => 'Comercial',
                'active'         => 1,
                'created_at'     => $date,
                'updated_at'     => $date,
                'deleted_at'     => null,
            ],
        ]);
    }
}
