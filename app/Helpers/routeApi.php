<?php

use Illuminate\Support\Facades\Route;

if (!function_exists('routeApi')) {
    function routeApi(string $action, string $module, ?int $id_module = null): string
    {
        $params = ['module' => $module];

        if ($id_module) {
            $params['id_module'] = $id_module;
        }

        return route("api.$action", $params);
    }
}
