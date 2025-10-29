<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TcPlanFeatureSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('tc_plan_feature')->insert([
            // 🟢 Starter
            ['id' => 1, 'id_credential' => 1, 'id_plan' => 1, 'name' => 'Número de Projetos', 'description' => null, 'value' => '1', 'active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'id_credential' => 1, 'id_plan' => 1, 'name' => 'Módulos por Projeto', 'description' => null, 'value' => '10', 'active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'id_credential' => 1, 'id_plan' => 1, 'name' => 'Usuários por conta', 'description' => null, 'value' => '1', 'active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 4, 'id_credential' => 1, 'id_plan' => 1, 'name' => 'Armazenamento', 'description' => 'banco + arquivos', 'value' => '100 Mb', 'active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 5, 'id_credential' => 1, 'id_plan' => 1, 'name' => 'Domínios personalizados', 'description' => 'White label', 'value' => 'false', 'active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 6, 'id_credential' => 1, 'id_plan' => 1, 'name' => 'Suporte técnico', 'description' => 'Seg–Sex 9h às 17h', 'value' => 'false', 'active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 7, 'id_credential' => 1, 'id_plan' => 1, 'name' => 'Logs e monitoramento', 'description' => null, 'value' => 'false', 'active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 8, 'id_credential' => 1, 'id_plan' => 1, 'name' => 'Backups automáticos', 'description' => null, 'value' => 'false', 'active' => 1, 'created_at' => $now, 'updated_at' => $now],

            // 🟡 Standard
            ['id' => 9,  'id_credential' => 1, 'id_plan' => 2, 'name' => 'Número de Projetos', 'description' => null, 'value' => '5', 'active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 10, 'id_credential' => 1, 'id_plan' => 2, 'name' => 'Módulos por Projeto', 'description' => null, 'value' => '20', 'active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 11, 'id_credential' => 1, 'id_plan' => 2, 'name' => 'Usuários por conta', 'description' => null, 'value' => '3', 'active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 12, 'id_credential' => 1, 'id_plan' => 2, 'name' => 'Armazenamento', 'description' => 'banco + arquivos', 'value' => '500 Mb', 'active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 13, 'id_credential' => 1, 'id_plan' => 2, 'name' => 'Domínios personalizados', 'description' => 'White label', 'value' => 'true', 'active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 14, 'id_credential' => 1, 'id_plan' => 2, 'name' => 'Suporte técnico', 'description' => 'Seg–Sex 9h às 17h', 'value' => 'true', 'active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 15, 'id_credential' => 1, 'id_plan' => 2, 'name' => 'Logs e monitoramento', 'description' => null, 'value' => 'false', 'active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 16, 'id_credential' => 1, 'id_plan' => 2, 'name' => 'Backups automáticos', 'description' => null, 'value' => 'false', 'active' => 1, 'created_at' => $now, 'updated_at' => $now],

            // 🔵 Infinite
            ['id' => 17, 'id_credential' => 1, 'id_plan' => 3, 'name' => 'Número de Projetos', 'description' => null, 'value' => 'Ilimitado', 'active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 18, 'id_credential' => 1, 'id_plan' => 3, 'name' => 'Módulos por Projeto', 'description' => null, 'value' => 'Ilimitado', 'active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 19, 'id_credential' => 1, 'id_plan' => 3, 'name' => 'Usuários por conta', 'description' => null, 'value' => 'Ilimitado', 'active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 20, 'id_credential' => 1, 'id_plan' => 3, 'name' => 'Armazenamento', 'description' => 'banco + arquivos', 'value' => '1 Gb', 'active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 21, 'id_credential' => 1, 'id_plan' => 3, 'name' => 'Domínios personalizados', 'description' => 'White label', 'value' => 'true', 'active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 22, 'id_credential' => 1, 'id_plan' => 3, 'name' => 'Suporte técnico', 'description' => 'Seg–Sex 9h às 17h', 'value' => 'true', 'active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 23, 'id_credential' => 1, 'id_plan' => 3, 'name' => 'Logs e monitoramento', 'description' => null, 'value' => 'true', 'active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 24, 'id_credential' => 1, 'id_plan' => 3, 'name' => 'Backups automáticos', 'description' => null, 'value' => 'true', 'active' => 1, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
