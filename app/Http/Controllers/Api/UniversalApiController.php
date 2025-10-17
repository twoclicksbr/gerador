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
    protected function resolveModel(Request $request, string $module): Model
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
            'method'   => $request->method(),
            'endpoint' => $request->fullUrl(),
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
        $model = $this->resolveModel($request, $module);
        $table = $model->getTable();
        $deletedMode = $request->get('deleted_at');

        // ============================================================
        // 🔧 Builder dinâmico conforme modo de exclusão
        // ============================================================
        if ($deletedMode === 'only') {
            $query = $model->onlyTrashed();
        } elseif ($deletedMode === 'with') {
            $query = $model->withTrashed();
        } else {
            $query = $model->newQueryWithoutScopes();
        }

        // ============================================================
        // ⚙️ Valor padrão do active
        // ============================================================
        if (!$request->has('active') && $deletedMode !== 'only' && Schema::hasColumn($table, 'active')) {
            $request->merge(['active' => '1']);
            $query->where('active', 1);
        }

        // ============================================================
        // 🔍 Filtros dinâmicos
        // ============================================================
        foreach ($request->query() as $field => $value) {
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
            ], true)) continue;

            if (!Schema::hasColumn($table, $field)) continue;
            if ($value === null || $value === '') continue;

            match (true) {
                $field === 'created_start' => $query->whereDate('created_at', '>=', $value),
                $field === 'created_end' => $query->whereDate('created_at', '<=', $value),
                $field === 'active' => $query->whereIn('active', array_map('intval', explode(',', $value))),
                $field === 'id' && str_contains($value, '-') => $query->whereBetween('id', array_map('intval', explode('-', $value))),
                $field === 'id' && str_contains($value, ',') => $query->whereIn('id', array_map('intval', explode(',', $value))),
                in_array($field, $model->getFillable(), true) => $query->where($field, 'LIKE', "%{$value}%"),
                default => $query->where($field, $value),
            };
        }

        // ============================================================
        // 🔽 Ordenação
        // ============================================================
        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'asc');
        if (Schema::hasColumn($table, $sort)) {
            $query->orderBy($sort, $direction);
        }

        // ============================================================
        // 📊 Contagens
        // ============================================================
        $totalRecords = $model::count();
        $filteredRecords = (clone $query)->count();

        // ============================================================
        // 📄 Paginação
        // ============================================================
        $limit = (int) ($request->get('per_page', $request->get('limit', 15)));
        $items = $query->paginate($limit);

        // ============================================================
        // 📦 Retorno padronizado
        // ============================================================
        return response()->json([
            'code'              => 200,
            'status'            => 'success',
            'method'            => $request->method(),
            'endpoint'          => $request->fullUrl(),
            'displayed_records' => count($items->items()),
            'filtered_records'  => $filteredRecords,
            'total_records'     => $totalRecords,
            'per_page'          => $items->perPage(),
            'current_page'      => $items->currentPage(),
            'last_page'         => $items->lastPage(),
            'links'             => [
                'first' => $items->url(1),
                'last'  => $items->url($items->lastPage()),
                'next'  => $items->nextPageUrl(),
                'prev'  => $items->previousPageUrl(),
            ],
            'filters' => [
                'search'    => $request->except(['page', 'per_page', 'limit', 'sort', 'direction']),
                'sort'      => $sort,
                'direction' => $direction,
                'page'      => $items->currentPage(),
                'per_page'  => $items->perPage(),
            ],
            'data'  => $items->items(),
            'about' => 'Powered by ' . config('app.url'),
        ], 200, ['Content-Type' => 'application/json'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    // ============================================================
    // 2. show — exibe um registro
    // ============================================================
    public function show(Request $request, string $module, int $id): JsonResponse
    {
        $model = $this->resolveModel($request, $module);

        // 🔍 Busca o registro
        $record = $model->find($id);

        if (!$record) {
            return response()->json([
                'code'     => 404,
                'status'   => 'error',
                'method'   => $request->method(),
                'endpoint' => $request->fullUrl(),
                'message'  => "Record with Id '{$id}' not found in table '{$model->getTable()}'.",
                'about'    => 'Powered by ' . config('app.url'),
            ], 404, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }

        // 📦 Resposta padronizada
        return response()->json([
            'code'     => 200,
            'status'   => 'success',
            'method'   => $request->method(),
            'endpoint' => $request->fullUrl(),
            'module'   => $module,
            'id'       => $id,
            'data'     => $record,
            'about'    => 'Powered by ' . config('app.url'),
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    // ============================================================
    // 3. create — estrutura padrão para criação
    // ============================================================
    public function create(Request $request, string $module): JsonResponse
    {
        $model = $this->resolveModel($request, $module);
        $table = $model->getTable();
        $fillable = $model->getFillable();

        // Campos de exemplo
        $exampleStore = [];
        foreach ($fillable as $field) {
            $exampleStore[$field] = str_contains($field, 'id')
                ? 1
                : (str_contains($field, 'active') || str_contains($field, 'token') ? 1 : 'Example text');
        }

        return response()->json([
            'code'          => 200,
            'status'        => 'success',
            'method'        => $request->method(),
            'endpoint'      => $request->fullUrl(),
            'module'        => $module,
            'table'         => $table,
            'fillable'      => $fillable,
            'timestamps'    => [
                'created_at' => Schema::hasColumn($table, 'created_at'),
                'updated_at' => Schema::hasColumn($table, 'updated_at'),
                'deleted_at' => Schema::hasColumn($table, 'deleted_at'),
            ],
            'example_store' => $exampleStore,
            'about'         => 'Powered by ' . config('app.url'),
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }


    // ============================================================
    // 4. store — cria novo registro
    // ============================================================
    public function store(Request $request, string $module): JsonResponse
    {
        $model = $this->resolveModel($request, $module);
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
            // Criptografa senhas
            if (Schema::hasColumn($table, $field) && str_contains($field, 'password')) {
                $data[$field] = bcrypt($data[$field] ?? '');
            }

            // Gera token aleatório (exceto remember_token)
            if (
                Schema::hasColumn($table, $field) &&
                str_contains($field, 'token') &&
                $field !== 'remember_token' &&
                empty($data[$field])
            ) {
                $data[$field] = Str::random(60);
            }

            // Define remember_token como boolean (false por padrão)
            if ($field === 'remember_token') {
                $data[$field] = filter_var($request->input('remember_token', false), FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
            }

            // Define campo ativo como 1 se não vier informado
            if ($field === 'active' && !isset($data[$field])) {
                $data[$field] = 1;
            }
        }

        // ============================================================
        // 3️⃣ Cria o registro (tratando erros de integridade)
        // ============================================================
        try {
            $record = $model->create($data);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                $errorMessage = $e->getMessage();
                $field = null;

                // 🔹 Caso 1: violação de chave estrangeira
                if (str_contains($errorMessage, 'foreign key constraint fails')) {
                    if (preg_match("/FOREIGN KEY \(`([^`]+)`\)/i", $errorMessage, $matches)) {
                        $field = $matches[1] ?? null;
                    }

                    $friendly = $field
                        ? "Foreign key constraint violation: related record not found for field '{$field}'."
                        : "Foreign key constraint violation: related record not found in a referenced table.";

                    return response()->json([
                        'code'     => 409,
                        'status'   => 'error',
                        'method'   => $request->method(),
                        'endpoint' => $request->fullUrl(),
                        'message'  => $friendly,
                        'about'    => 'Powered by ' . config('app.url'),
                    ], 409);
                }

                // 🔹 Caso 2: violação de UNIQUE (duplicado)
                if (preg_match('/for key [`\'](?:[^\']+\.)?([a-zA-Z0-9_]+)_unique[`\']/i', $errorMessage, $matches)) {
                    $field = $matches[1] ?? null;
                    $field = preg_replace('/^' . preg_quote($table, '/') . '_/', '', $field);
                }

                $friendly = $field
                    ? "Duplicate entry for table '{$table}' in field '{$field}'."
                    : "Duplicate entry detected in table '{$table}' (unique constraint violation).";

                return response()->json([
                    'code'     => 409,
                    'status'   => 'error',
                    'method'   => $request->method(),
                    'endpoint' => $request->fullUrl(),
                    'message'  => $friendly,
                    'about'    => 'Powered by ' . config('app.url'),
                ], 409);
            }

            throw $e;
        }

        // ============================================================
        // 4️⃣ Retorno padrão
        // ============================================================
        return response()->json([
            'code'     => 201,
            'status'   => 'success',
            'method'   => $request->method(),
            'endpoint' => $request->fullUrl(),
            'message'  => 'Record created successfully.',
            'data'     => $record,
            'about'    => 'Powered by ' . config('app.url'),
        ], 201);
    }

    // ============================================================
    // 5. edit — dados para edição
    // ============================================================
    public function edit(Request $request, string $module, int $id): JsonResponse
    {
        $model = $this->resolveModel($request, $module);
        $table = $model->getTable();

        // 🔍 Busca o registro
        $record = $model->find($id);

        if (!$record) {
            return response()->json([
                'code'     => 404,
                'status'   => 'error',
                'method'   => $request->method(),
                'endpoint' => $request->fullUrl(),
                'message'  => "Record with Id '{$id}' not found in module '{$table}'.",
                'about'    => 'Powered by ' . config('app.url'),
            ], 404, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }

        $fillable = $model->getFillable();

        // 🔹 Campos sensíveis que não devem ser exibidos
        $sensitiveFields = ['password', 'token', 'api_key', 'secret'];

        // 🔹 Gera exemplo de edição com valores reais ou genéricos
        $exampleEdit = [];
        foreach ($fillable as $field) {
            if (in_array($field, $sensitiveFields)) {
                continue; // ❌ pula campos sensíveis
            }

            $exampleEdit[$field] = $record->{$field}
                ?? (str_contains($field, 'id') ? 1
                    : (str_contains($field, 'active') || str_contains($field, 'token') ? 1 : 'Example text'));
        }

        // 🔹 Remove apenas os campos realmente sensíveis da lista fillable
        $fillable = array_values(array_diff($fillable, $sensitiveFields));

        return response()->json([
            'code'         => 200,
            'status'       => 'success',
            'method'       => $request->method(),
            'endpoint'     => $request->fullUrl(),
            'module'       => $module,
            'table'        => $table,
            'id'           => $id,
            'fillable'     => $fillable,
            'timestamps'   => [
                'created_at' => Schema::hasColumn($table, 'created_at'),
                'updated_at' => Schema::hasColumn($table, 'updated_at'),
                'deleted_at' => Schema::hasColumn($table, 'deleted_at'),
            ],
            'example_edit' => $exampleEdit,
            'about'        => 'Powered by ' . config('app.url'),
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    // ============================================================
    // 6. update — atualiza um registro existente
    // ============================================================
    public function update(Request $request, string $module, int $id): JsonResponse
    {
        $model = $this->resolveModel($request, $module);
        $table = $model->getTable();
        $fillable = $model->getFillable();

        // 🔍 Busca o registro
        $record = $model->find($id);

        if (!$record) {
            return response()->json([
                'code'     => 404,
                'status'   => 'error',
                'method'   => $request->method(),
                'endpoint' => $request->fullUrl(),
                'message'  => "Record with Id '{$id}' not found in module '{$table}'.",
                'about'    => 'Powered by ' . config('app.url'),
            ], 404, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }

        // 🔹 Captura apenas campos permitidos
        $data = $request->only($fillable);

        // ============================================================
        // 1️⃣ TRATAMENTO GENÉRICO DE CAMPOS (igual ao store)
        // ============================================================
        foreach ($fillable as $field) {
            if (Schema::hasColumn($table, $field) && str_contains($field, 'password') && !empty($data[$field])) {
                $data[$field] = bcrypt($data[$field]);
            }

            if (Schema::hasColumn($table, $field) && str_contains($field, 'token') && empty($data[$field])) {
                $data[$field] = Str::random(60);
            }

            if ($field === 'remember_token' && !isset($data[$field])) {
                $data[$field] = 0;
            }

            if ($field === 'active' && !isset($data[$field])) {
                $data[$field] = 1;
            }
        }

        // ============================================================
        // 2️⃣ Remember Token tratado separadamente
        // ============================================================
        if (Schema::hasColumn($table, 'remember_token')) {
            $data['remember_token'] = in_array($request->input('remember_me'), [true, 'true', 1, '1'], true);
        }

        // ============================================================
        // 3️⃣ Atualiza o registro (tratando erros de integridade)
        // ============================================================
        try {
            $record->update($data);

            return response()->json([
                'code'      => 200,
                'status'    => 'success',
                'method'    => $request->method(),
                'endpoint'  => $request->fullUrl(),
                'message'   => "Record with Id '{$id}' successfully updated in module '{$table}'.",
                'updated'   => $record->fresh(),
                'about'     => 'Powered by ' . config('app.url'),
            ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                $errorMessage = $e->getMessage();
                $field = null;

                // 🔹 Caso 1: violação de chave estrangeira
                if (str_contains($errorMessage, 'foreign key constraint fails')) {
                    if (preg_match("/FOREIGN KEY \(`([^`]+)`\)/i", $errorMessage, $matches)) {
                        $field = $matches[1] ?? null;
                    }

                    $friendly = $field
                        ? "Foreign key constraint violation: related record not found for field '{$field}'."
                        : "Foreign key constraint violation: related record not found in a referenced table.";

                    return response()->json([
                        'code'     => 409,
                        'status'   => 'error',
                        'method'   => $request->method(),
                        'endpoint' => $request->fullUrl(),
                        'message'  => $friendly,
                        'about'    => 'Powered by ' . config('app.url'),
                    ], 409);
                }

                // 🔹 Caso 2: violação de UNIQUE (duplicado)
                if (preg_match('/for key [`\'](?:[^\']+\.)?([a-zA-Z0-9_]+)_unique[`\']/i', $errorMessage, $matches)) {
                    $field = $matches[1] ?? null;
                    $field = preg_replace('/^' . preg_quote($table, '/') . '_/', '', $field);
                }

                $friendly = $field
                    ? "Duplicate entry for table '{$table}' in field '{$field}'."
                    : "Duplicate entry detected in table '{$table}' (unique constraint violation).";

                return response()->json([
                    'code'     => 409,
                    'status'   => 'error',
                    'method'   => $request->method(),
                    'endpoint' => $request->fullUrl(),
                    'message'  => $friendly,
                    'about'    => 'Powered by ' . config('app.url'),
                ], 409);
            }

            throw $e;
        } catch (\Exception $e) {
            return response()->json([
                'code'     => 500,
                'status'   => 'error',
                'method'   => $request->method(),
                'endpoint' => $request->fullUrl(),
                'message'  => 'Failed to update record.',
                'error'    => $e->getMessage(),
                'about'    => 'Powered by ' . config('app.url'),
            ], 500, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }
    }

    // ============================================================
    // 7. deleted — visualiza um registro mesmo se estiver excluído
    // ============================================================
    public function deleted(Request $request, string $module, int $id): JsonResponse
    {
        $model = $this->resolveModel($request, $module);

        // 🔍 Busca o registro (inclui deletados)
        $record = $model->withTrashed()->find($id);

        if (!$record) {
            return response()->json([
                'code'     => 404,
                'status'   => 'error',
                'method'   => $request->method(),
                'endpoint' => $request->fullUrl(),
                'message'  => "Record with Id {$id} not found in module '{$model->getTable()}'.",
                'about'    => 'Powered by ' . config('app.url'),
            ], 404, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }

        // 🧩 Verifica se está realmente deletado
        $isDeleted = !is_null($record->deleted_at);

        // 📦 Se não estiver deletado → só mensagem
        if (!$isDeleted) {
            return response()->json([
                'code'     => 200,
                'status'   => 'warning',
                'method'   => $request->method(),
                'endpoint' => $request->fullUrl(),
                'deleted'  => false,
                'message'  => "The record Id '{$id}' in module '{$model->getTable()}' is active and not deleted.",
                'about'    => 'Powered by ' . config('app.url'),
            ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }

        // ✅ Se estiver deletado → mostra registro
        return response()->json([
            'code'     => 200,
            'status'   => 'success',
            'method'   => $request->method(),
            'endpoint' => $request->fullUrl(),
            'deleted'  => true,
            'message'  => "The record Id '{$id}' in module '{$model->getTable()}' is currently deleted (soft deleted).",
            'data'     => $record,
            'about'    => 'Powered by ' . config('app.url'),
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    // ============================================================
    // 8. destroy — exclusão lógica (soft delete)
    // ============================================================
    public function destroy(Request $request, string $module, int $id): JsonResponse
    {
        $model = $this->resolveModel($request, $module);
        $table = $model->getTable();

        // 🔍 Busca o registro
        $record = $model->find($id);

        // ⚠️ Não encontrado
        if (!$record) {
            return response()->json([
                'code'     => 404,
                'status'   => 'error',
                'method'   => $request->method(),
                'endpoint' => $request->fullUrl(),
                'message'  => "Record with Id '{$id}' not found in module '{$model->getTable()}'.",
                'about'    => 'Powered by ' . config('app.url'),
            ], 404, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }

        // ⚠️ Já deletado
        if (!is_null($record->deleted_at ?? null)) {
            return response()->json([
                'code'     => 200,
                'status'   => 'warning',
                'method'   => $request->method(),
                'endpoint' => $request->fullUrl(),
                'deleted'  => true,
                'message'  => "The record Id '{$id}' in module '{$model->getTable()}' is already deleted (soft deleted).",
                'about'    => 'Powered by ' . config('app.url'),
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
            'method'   => $request->method(),
            'endpoint' => $request->fullUrl(),
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
    public function restore(Request $request, string $module, int $id): JsonResponse
    {
        $model = $this->resolveModel($request, $module);

        $table = $model->getTable();

        // 🔍 Busca o registro (inclusive deletados)
        $record = $model->withTrashed()->find($id);

        // ⚠️ Não encontrado
        if (!$record) {
            return response()->json([
                'code'     => 404,
                'status'   => 'error',
                'method'   => $request->method(),
                'endpoint' => $request->fullUrl(),
                'message'  => "Record with Id '{$id}' not found in module '{$model->getTable()}'.",
                'about'    => 'Powered by ' . config('app.url'),
            ], 404, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }

        // ⚠️ Já ativo
        if (is_null($record->deleted_at)) {
            return response()->json([
                'code'     => 200,
                'status'   => 'warning',
                'method'   => $request->method(),
                'endpoint' => $request->fullUrl(),
                'restored' => false,
                'message'  => "The record Id '{$id}' in module '{$model->getTable()}' is already active (not deleted).",
                'about'    => 'Powered by ' . config('app.url'),
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
            'method'   => $request->method(),
            'endpoint' => $request->fullUrl(),
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
    public function destroyForce(Request $request, string $module, int $id): JsonResponse
    {
        $model = $this->resolveModel($request, $module);

        // 🔍 Busca o registro (inclusive deletados)
        $record = $model->withTrashed()->find($id);

        // ⚠️ Não encontrado
        if (!$record) {
            return response()->json([
                'code'     => 404,
                'status'   => 'error',
                'method'   => $request->method(),
                'endpoint' => $request->fullUrl(),
                'message'  => "Record with Id '{$id}' not found in module '{$model->getTable()}'.",
                'about'    => 'Powered by ' . config('app.url'),
            ], 404, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }

        // ⚠️ Ainda ativo — não pode ser excluído permanentemente
        if (is_null($record->deleted_at)) {
            return response()->json([
                'code'     => 400,
                'status'   => 'warning',
                'method'   => $request->method(),
                'endpoint' => $request->fullUrl(),
                'deleted'  => false,
                'message'  => "The record Id '{$id}' in module '{$model->getTable()}' must be soft deleted before being permanently removed.",
                'about'    => 'Powered by ' . config('app.url'),
            ], 400, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }

        // 🗑️ Exclusão permanente
        $record->forceDelete();

        return response()->json([
            'code'     => 200,
            'status'   => 'success',
            'method'   => $request->method(),
            'endpoint' => $request->fullUrl(),
            'deleted'  => true,
            'module'   => $module,
            'id'       => $id,
            'message'  => "The record Id '{$id}' in module '{$model->getTable()}' has been permanently deleted.",
            'about'    => 'Powered by ' . config('app.url'),
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}
