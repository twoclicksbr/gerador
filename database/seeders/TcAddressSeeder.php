<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TcAddressSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('tc_address')->insert([
            [
                'id'               => 1,
                'id_credential'    => 1,
                'id_person'        => 1,
                'id_type_address'  => 2,
                'main'             => 1,
                'cep'              => '12216470',
                'street'           => 'Rua Jussara',
                'number'           => '5',
                'complement'       => null,
                'district'         => 'Jardim Topázio',
                'city'             => 'São José dos Campos',
                'state'            => 'SP',
                'created_at'       => $now,
                'updated_at'       => $now,
                'deleted_at'       => null,
            ],
        ]);
    }
}
