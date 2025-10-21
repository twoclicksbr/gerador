<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Api\Plan;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::where('active', 1)
            ->with(['features' => fn($q) => $q->where('active', 1)->orderBy('id')])
            ->orderBy('price_monthly')
            ->get();

        return view('plans', compact('plans'));
    }
}
