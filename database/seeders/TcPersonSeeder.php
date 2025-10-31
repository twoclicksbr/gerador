<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TcPersonSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('tc_person')->insert([
            [
                'id'             => 1,
                'id_credential'  => 1,
                'name'           => 'Alex Alves de Almeida',
                'birthdate'      => '1985-05-09',
                'whatsapp'       => '+5512997698040',
                'cpf_cnpj'       => '54659963000120',
                'gender'         => 'Masculino',
                'active'         => 1,
                'created_at'     => $now,
                'updated_at'     => $now,
                'deleted_at'     => null,
            ],
        ]);
    }
}
