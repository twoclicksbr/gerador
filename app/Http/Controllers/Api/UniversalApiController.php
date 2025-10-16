<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class UniversalApiController extends Controller
{
    // ============================================================
    // PROPRIEDADES BASE
    // ============================================================
    protected ?Model $model = null;
    protected ?string $requestClass = null;

    // ============================================================
    // CONSTRUTOR GENÉRICO
    // ============================================================
    public function __construct(?Model $model = null)
    {
        if ($model) {
            $this->model = $model;
        }
    }

    // ============================================================
    // MÉTODO AUXILIAR — resolve dinamicamente o Model pelo módulo
    // ============================================================
    protected function resolveModel(string $module): Model
    {
        $namespaces = [
            '\\App\\Models\\Api\\',
            '\\App\\Models\\Front\\',
            '\\App\\Models\\',
        ];

        foreach ($namespaces as $base) {
            $modelClass = $base . ucfirst($module);
            if (class_exists($modelClass)) {
                return new $modelClass;
            }
        }

        abort(response()->json([
            'code'     => 404,
            'status'   => 'error',
            'error'    => 'Module not found',
            'module'   => $module,
            'about'    => 'Powered by ' . config('app.url'),
        ], 404, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }

    // ============================================================
    // 1. index — lista registros
    // ============================================================
    public function index(Request $request, string $module): JsonResponse
    {
        $model = $this->resolveModel($module);
        $deletedMode = $request->get('deleted_at');

        // 🔧 cria o builder apenas no modo certo
        if ($deletedMode === 'only') {
            $query = $model->onlyTrashed();
        } elseif ($deletedMode === 'with') {
            $query = $model->withTrashed();
        } else {
            $query = $model->newQueryWithoutScopes(); // 👈 aqui está o ajuste
        }

        // ⚙️ Valor padrão do active
        if (!$request->has('active') && $deletedMode !== 'only') {
            $request->merge(['active' => '1']);
            $query->where('active', 1);
        }

        // 🔍 Filtros dinâmicos
        foreach ($request->query() as $field => $value) {

            // ⚠️ Pula campos de controle (inclusive deleted_at)
            if (in_array($field, [
                'deleted_at',
                'created_start',
                'created_end',
                'sort',
                'direction',
                'dt_limit_access_start',
                'dt_limit_access_end',
                'page',
                'per_page',
                'limit',
                'first_page',
                'last_page',
                'next_page',
                'prev_page',
            ])) {
                continue;
            }

            if (!Schema::hasColumn($model->getTable(), $field)) {
                continue;
            }

            if ($value === null || $value === '') continue;

            if ($field === 'created_start') {
                $query->whereDate('created_at', '>=', $value);
            } elseif ($field === 'created_end') {
                $query->whereDate('created_at', '<=', $value);
            } elseif ($field === 'dt_limit_access_start') {
                $query->whereDate('dt_limit_access', '>=', $value);
            } elseif ($field === 'dt_limit_access_end') {
                $query->whereDate('dt_limit_access', '<=', $value);
            } elseif ($field === 'active') {
                $values = array_map('intval', explode(',', $value));
                $query->whereIn('active', $values);
            } elseif ($field === 'id') {
                if (str_contains($value, '-')) {
                    [$start, $end] = array_map('intval', explode('-', $value));
                    $query->whereBetween('id', [$start, $end]);
                } elseif (str_contains($value, ',')) {
                    $values = array_map('intval', explode(',', $value));
                    $query->whereIn('id', $values);
                } else {
                    $query->where('id', intval($value));
                }
            } elseif (in_array($field, $model->getFillable())) {
                $query->where($field, 'LIKE', "%{$value}%");
            } elseif (Schema::hasColumn($model->getTable(), $field)) {
                $query->where($field, $value);
            }
        }

        // 🔽 Ordenação
        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'asc');
        if (Schema::hasColumn($model->getTable(), $sort)) {
            $query->orderBy($sort, $direction);
        }

        // 📊 Contagens
        $totalRecords = $model::count();
        $filteredRecords = (clone $query)->count();

        Log::info('SQL DEBUG', [
            'sql' => $query->toSql(),
            'bindings' => $query->getBindings(),
            'deletedMode' => $deletedMode
        ]);


        // 📄 Paginação
        $limit = (int) ($request->get('per_page', $request->get('limit', 15)));
        $items = $query->paginate($limit);

        // 📦 Resposta padronizada
        return response()->json([
            'code'              => 200,
            'status'            => 'success',
            'endpoint'          => $request->fullUrl(),
            'displayed_records' => count($items->items()),
            'filtered_records'  => $filteredRecords,
            'total_records'     => $totalRecords,
            'per_page'          => $items->perPage(),
            'current_page'      => $items->currentPage(),
            'last_page'         => $items->lastPage(),

            'links' => collect([
                'first' => $items->url(1),
                'last'  => $items->url($items->lastPage()),
                'next'  => $items->nextPageUrl(),
                'prev'  => $items->previousPageUrl(),
            ])->map(function ($url) {
                if (!$url) return null;
                return parse_url($url, PHP_URL_PATH)
                    . (parse_url($url, PHP_URL_QUERY)
                        ? '?' . parse_url($url, PHP_URL_QUERY)
                        : '');
            }),

            'filters' => [
                'search'    => $request->except(['page', 'per_page', 'limit', 'sort', 'direction']),
                'sort'      => $sort,
                'direction' => $direction,
                'page'      => $items->currentPage(),
                'per_page'  => $items->perPage(),
            ],

            'data'  => $items->items(),
            'about' => 'Powered by ' . config('app.url'),
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }



    // ============================================================
    // 2. show — exibe um registro
    // ============================================================
    public function show(Request $request, string $module, int $id): JsonResponse
    {
        $model = $this->resolveModel($module);

        // 🔍 Busca o registro
        $record = $model->find($id);

        if (!$record) {
            return response()->json([
                'code'    => 404,
                'status'  => 'error',
                'message' => "Record with Id '{$id}' not found in table '{$model->getTable()}'.",
                'about'   => 'Powered by ' . config('app.url'),
            ], 404, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }

        // 📦 Resposta padronizada
        return response()->json([
            'code'     => 200,
            'status'   => 'success',
            'module'   => $module,
            'id'       => $id,
            'data'     => $record,
            'about'    => 'Powered by ' . config('app.url'),
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    // ============================================================
    // 3. create — estrutura padrão para criação
    // ============================================================
    public function create(string $module): JsonResponse
    {
        $model = $this->resolveModel($module);
        $table = $model->getTable();

        $columns = DB::select("
        SELECT 
            COLUMN_NAME AS name,
            DATA_TYPE AS type,
            IS_NULLABLE AS nullable,
            COLUMN_DEFAULT AS default_value
        FROM INFORMATION_SCHEMA.COLUMNS
        WHERE TABLE_SCHEMA = DATABASE()
        AND TABLE_NAME = ?
    ", [$table]);

        $fields = collect($columns)
            ->map(fn($col) => (array) $col)
            ->reject(fn($col) => $col['name'] === 'id_credential')
            ->mapWithKeys(function ($col) use ($model) {
                $examples = [
                    'varchar'   => 'Example text',
                    'text'      => 'Longer example text...',
                    'int'       => 0,
                    'bigint'    => 1,
                    'tinyint'   => 1,
                    'date'      => date('Y-m-d'),
                    'datetime'  => date('Y-m-d H:i:s'),
                    'timestamp' => date('Y-m-d H:i:s'),
                    'boolean'   => true,
                    'decimal'   => 0.0,
                ];

                return [
                    $col['name'] => [
                        'type'       => $col['type'],
                        'fillable'   => in_array($col['name'], $model->getFillable()),
                        'required'   => strtoupper($col['nullable']) === 'NO',
                        'default'    => $col['default_value'],
                        'example'    => $examples[$col['type']] ?? null,
                        'sensitive'  => in_array($col['name'], ['password', 'remember_token']),
                    ],
                ];
            });

        // 🧩 Gera JSON de exemplo no formato e ordem do fillable
        $fillableOrdered = array_values(array_diff($model->getFillable(), ['id_credential']));
        $exampleStore = collect($fillableOrdered)
            ->mapWithKeys(fn($name) => [
                $name => $fields[$name]['example'] ?? null
            ])
            ->toArray();

        return response()->json([
            'code'       => 200,
            'status'     => 'success',
            'module'     => $module,
            'table'      => $table,
            'fields'     => $fields,
            'fillable'   => $fillableOrdered,
            'timestamps' => [
                'created_at' => Schema::hasColumn($table, 'created_at'),
                'updated_at' => Schema::hasColumn($table, 'updated_at'),
                'deleted_at' => Schema::hasColumn($table, 'deleted_at'),
            ],
            'example_store' => (object) $exampleStore, // 👈 fica visualmente como { ... }
            'about'      => 'Powered by ' . config('app.url'),
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    // ============================================================
    // 4. store — cria novo registro
    // ============================================================
    public function store(Request $request, string $module): JsonResponse
    {
        $model = $this->resolveModel($module);
        $table = $model->getTable();
        $fillable = $model->getFillable();

        // 🔹 Captura apenas campos permitidos
        $data = $request->only($fillable);

        // ============================================================
        // 1️⃣ id_credential — sempre definido automaticamente
        // ============================================================
        if (Schema::hasColumn($table, 'id_credential')) {
            $data['id_credential'] = session('auth_user.id_credential')
                ?? session('auth_person.id_credential')
                ?? 1;
        }

        // ============================================================
        // 2️⃣ TRATAMENTO GENÉRICO DE CAMPOS
        // ============================================================
        foreach ($fillable as $field) {
            // criptografa se o nome contiver 'password'
            if (Schema::hasColumn($table, $field) && str_contains($field, 'password')) {
                $data[$field] = bcrypt($data[$field] ?? '');
            }

            // gera token aleatório se o nome contiver 'token'
            if (Schema::hasColumn($table, $field) && str_contains($field, 'token') && empty($data[$field])) {
                $data[$field] = Str::random(60);
            }

            // define campo ativo como 1 se não vier informado
            if ($field === 'active' && !isset($data[$field])) {
                $data[$field] = 1;
            }
        }

        // ============================================================
        // 3️⃣ Cria o registro
        // ============================================================
        $record = $model->create($data);

        return response()->json([
            'code'    => 201,
            'status'  => 'success',
            'message' => 'Record created successfully.',
            'data'    => $record,
            'about'   => 'Powered by ' . config('app.url'),
        ], 201, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    // ============================================================
    // 5. edit — dados para edição
    // ============================================================
    public function edit(string $module, int $id): JsonResponse
    {
        $model = $this->resolveModel($module);
        $table = $model->getTable();

        // 🔍 Busca o registro
        $record = $model->find($id);

        if (!$record) {
            return response()->json([
                'code'    => 404,
                'status'  => 'error',
                'message' => "Record with Id '{$id}' not found in module '{$model->getTable()}'.",
                'about'   => 'Powered by ' . config('app.url'),
            ], 404, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }

        // 📦 Estrutura das colunas
        $columns = DB::select("
                SELECT 
                    COLUMN_NAME AS name,
                    DATA_TYPE AS type,
                    IS_NULLABLE AS nullable,
                    COLUMN_DEFAULT AS default_value
                FROM INFORMATION_SCHEMA.COLUMNS
                WHERE TABLE_SCHEMA = DATABASE()
                AND TABLE_NAME = ?
            ", [$table]);

        $allFields = collect($columns)
            ->map(fn($col) => (array) $col)
            ->reject(fn($col) => $col['name'] === 'id_credential')
            ->mapWithKeys(function ($col) use ($model, $record) {
                $examples = [
                    'varchar'   => 'Example text',
                    'text'      => 'Longer example text...',
                    'int'       => 0,
                    'bigint'    => 1,
                    'tinyint'   => 1,
                    'date'      => date('Y-m-d'),
                    'datetime'  => date('Y-m-d H:i:s'),
                    'timestamp' => date('Y-m-d H:i:s'),
                    'boolean'   => true,
                    'decimal'   => 0.0,
                ];

                $name = $col['name'];

                return [
                    $name => [
                        'type'       => $col['type'],
                        'fillable'   => in_array($name, $model->getFillable()),
                        'required'   => strtoupper($col['nullable']) === 'NO',
                        'default'    => $col['default_value'],
                        'value'      => $record->{$name} ?? null,
                        'example'    => $examples[$col['type']] ?? null,
                        'sensitive'  => in_array($name, ['password', 'remember_token']),
                    ],
                ];
            });

        // 🔹 Ordem personalizada dos campos
        $fillableOrdered = array_values(array_diff($model->getFillable(), ['id_credential']));

        $priorityOrder = [
            'id',
            ...$fillableOrdered,
            'created_at',
            'updated_at',
            'deleted_at'
        ];

        // Monta campos na ordem final
        $fields = collect($priorityOrder)
            ->mapWithKeys(fn($name) => isset($allFields[$name]) ? [$name => $allFields[$name]] : [])
            ->merge($allFields->except($priorityOrder)) // garante que nada fique de fora
            ->toArray();

        // 🧩 Exemplo com a mesma ordem do fillable
        $exampleEdit = collect($fillableOrdered)
            ->mapWithKeys(fn($name) => [
                $name => $fields[$name]['value'] ?? $fields[$name]['example'] ?? null
            ])
            ->toArray();

        return response()->json([
            'code'         => 200,
            'status'       => 'success',
            'module'       => $module,
            'table'        => $table,
            'id'           => $id,
            'fields'       => (object) $fields,
            'fillable'     => $fillableOrdered,
            'timestamps'   => [
                'created_at' => Schema::hasColumn($table, 'created_at'),
                'updated_at' => Schema::hasColumn($table, 'updated_at'),
                'deleted_at' => Schema::hasColumn($table, 'deleted_at'),
            ],
            'example_edit' => (object) $exampleEdit,
            'about'        => 'Powered by ' . config('app.url'),
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    // ============================================================
    // 6. update — atualiza um registro existente
    // ============================================================
    public function update(Request $request, string $module, int $id): JsonResponse
    {
        $model = $this->resolveModel($module);
        $table = $model->getTable();
        $fillable = $model->getFillable();

        // 🔍 Busca o registro
        $record = $model->find($id);

        // 🚫 Se não existir, retorna erro padronizado
        if (!$record) {
            return response()->json([
                'code'    => 404,
                'status'  => 'error',
                'message' => "Record with ID '{$id}' not found in module '{$model->getTable()}'.",
                'about'   => 'Powered by ' . config('app.url'),
            ], 404, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }

        // 🔹 Captura apenas campos permitidos
        $data = $request->only($fillable);

        // ============================================================
        // 1️⃣ TRATAMENTO GENÉRICO DE CAMPOS
        // ============================================================
        foreach ($fillable as $field) {
            // criptografa se o nome contiver 'password'
            if (Schema::hasColumn($table, $field) && str_contains($field, 'password') && !empty($data[$field])) {
                $data[$field] = bcrypt($data[$field]);
            }

            // gera token aleatório se o nome contiver 'token'
            if (Schema::hasColumn($table, $field) && str_contains($field, 'token') && empty($data[$field])) {
                $data[$field] = Str::random(60);
            }
        }

        // ============================================================
        // 2️⃣ Atualiza o registro
        // ============================================================
        $record->update($data);

        return response()->json([
            'code'    => 200,
            'status'  => 'success',
            'message' => 'Record updated successfully.',
            'data'    => $record,
            'about'   => 'Powered by ' . config('app.url'),
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }


    // ============================================================
    // 7. deleted — visualiza um registro mesmo se estiver excluído
    // ============================================================
    public function deleted(Request $request, string $module, int $id): JsonResponse
    {
        $model = $this->resolveModel($module);

        // 🔍 Busca o registro (inclui deletados)
        $record = $model->withTrashed()->find($id);

        if (!$record) {
            return response()->json([
                'code'    => 404,
                'status'  => 'error',
                'message' => "Record with Id {$id} not found in module '{$model->getTable()}'.",
                'about'   => 'Powered by ' . config('app.url'),
            ], 404, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }

        // 🧩 Verifica se está realmente deletado
        $isDeleted = !is_null($record->deleted_at);

        // 📦 Se não estiver deletado → só mensagem
        if (!$isDeleted) {
            return response()->json([
                'code'    => 200,
                'status'  => 'warning',
                'deleted' => false,
                'message' => "The record Id '{$id}' in module '{$model->getTable()}' is active and not deleted.",
                'about'   => 'Powered by ' . config('app.url'),
            ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }

        // ✅ Se estiver deletado → mostra registro
        return response()->json([
            'code'     => 200,
            'status'   => 'success',
            'deleted'  => true,
            'message'  => "The record Id '{$id}' in module '{$model->getTable()}' is currently deleted (soft deleted).",
            'data'     => $record,
            'about'    => 'Powered by ' . config('app.url'),
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    // ============================================================
    // 8. destroy — exclusão lógica (soft delete)
    // ============================================================
    public function destroy(string $module, int $id): JsonResponse
    {
        $model = $this->resolveModel($module);
        $table = $model->getTable();

        // 🔍 Busca o registro
        $record = $model->find($id);

        // ⚠️ Não encontrado
        if (!$record) {
            return response()->json([
                'code'    => 404,
                'status'  => 'error',
                'message' => "Record with Id '{$id}' not found in module '{$model->getTable()}'.",
                'about'   => 'Powered by ' . config('app.url'),
            ], 404, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }

        // ⚠️ Já deletado
        if (!is_null($record->deleted_at ?? null)) {
            return response()->json([
                'code'    => 200,
                'status'  => 'warning',
                'deleted' => true,
                'message' => "The record Id '{$id}' in module '{$model->getTable()}' is already deleted (soft deleted).",
                'about'   => 'Powered by ' . config('app.url'),
            ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }

        // 🟡 Desativa antes de excluir (se tiver campo active)
        if (Schema::hasColumn($table, 'active')) {
            $record->update(['active' => 0]);
        }

        // 🗑️ Move para a lixeira (soft delete)
        $record->delete();

        return response()->json([
            'code'     => 200,
            'status'   => 'success',
            'deleted'  => true,
            'module'   => $module,
            'id'       => $id,
            'message'  => "The record Id '{$id}' in module '{$model->getTable()}' has been deactivated and moved to trash (soft deleted).",
            'about'    => 'Powered by ' . config('app.url'),
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    // ============================================================
    // 9. restore — restaura item deletado logicamente
    // ============================================================
    public function restore(string $module, int $id): JsonResponse
    {
        $model = $this->resolveModel($module);
        $table = $model->getTable();

        // 🔍 Busca o registro (inclusive deletados)
        $record = $model->withTrashed()->find($id);

        // ⚠️ Não encontrado
        if (!$record) {
            return response()->json([
                'code'    => 404,
                'status'  => 'error',
                'message' => "Record with Id '{$id}' not found in module '{$model->getTable()}'.",
                'about'   => 'Powered by ' . config('app.url'),
            ], 404, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }

        // ⚠️ Já ativo
        if (is_null($record->deleted_at)) {
            return response()->json([
                'code'    => 200,
                'status'  => 'warning',
                'restored' => false,
                'message' => "The record Id '{$id}' in module '{$model->getTable()}' is already active (not deleted).",
                'about'   => 'Powered by ' . config('app.url'),
            ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }

        // ♻️ Restaura o registro
        $record->restore();

        // 🔸 Após restaurar, define active = 0 (mantém desativado)
        if (Schema::hasColumn($table, 'active')) {
            $record->update(['active' => 0]);
        }

        return response()->json([
            'code'     => 200,
            'status'   => 'success',
            'restored' => true,
            'module'   => $module,
            'id'       => $id,
            'message'  => "The record Id '{$id}' in module '{$model->getTable()}' has been restored and set as inactive (active = 0).",
            'about'    => 'Powered by ' . config('app.url'),
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }


    // ============================================================
    // 10. destroyForce — exclusão definitiva (delete físico)
    // ============================================================
    public function destroyForce(string $module, int $id): JsonResponse
    {
        $model = $this->resolveModel($module);

        // 🔍 Busca o registro (inclusive deletados)
        $record = $model->withTrashed()->find($id);

        // ⚠️ Não encontrado
        if (!$record) {
            return response()->json([
                'code'    => 404,
                'status'  => 'error',
                'message' => "Record with Id '{$id}' not found in module '{$model->getTable()}'.",
                'about'   => 'Powered by ' . config('app.url'),
            ], 404, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }

        // ⚠️ Ainda ativo — não pode ser excluído permanentemente
        if (is_null($record->deleted_at)) {
            return response()->json([
                'code'    => 400,
                'status'  => 'warning',
                'deleted' => false,
                'message' => "The record Id '{$id}' in module '{$model->getTable()}' must be soft deleted before being permanently removed.",
                'about'   => 'Powered by ' . config('app.url'),
            ], 400, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }

        // 🗑️ Exclusão permanente
        $record->forceDelete();

        return response()->json([
            'code'     => 200,
            'status'   => 'success',
            'deleted'  => true,
            'module'   => $module,
            'id'       => $id,
            'message'  => "The record Id '{$id}' in module '{$model->getTable()}' has been permanently deleted.",
            'about'    => 'Powered by ' . config('app.url'),
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}
