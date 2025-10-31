@extends('layouts.app')

@section('title', 'Planos - DevsAPI')
@section('page-title', 'plans')

@section('content')
    <div class="wrapper d-flex flex-column flex-row-fluid mt-5 mt-lg-10" id="kt_wrapper">
        <div class="content flex-column-fluid" id="kt_content">
            <div class="toolbar d-flex flex-stack flex-wrap mb-5 mb-lg-7" id="kt_toolbar">
                <div class="page-title d-flex flex-column py-1">
                    <h1 class="d-flex align-items-center my-1">
                        <span class="text-gray-900 fw-bold fs-1">Planos</span>
                    </h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('home') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-200 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-gray-900">Planos</li>
                    </ul>
                </div>
            </div>

            <div class="post" id="kt_post">
                <div class="card" id="kt_pricing">
                    <div class="card-body p-lg-17">

                        @include('layouts.components.banner', [
                            'title' => 'Nossos Planos',
                            'description' => 'Escolha o plano ideal para o seu projeto e comece a criar módulos e APIs com poucos cliques.',
                        ])

                        <div class="d-flex flex-column">

                            {{-- Alternador Mensal / Anual --}}
                            <div class="nav-group nav-group-outline mx-auto mb-15" data-kt-buttons="true">
                                <button class="btn btn-color-gray-600 btn-active btn-active-secondary px-6 py-3 me-2 active"
                                    data-kt-plan="month">Mensal</button>
                                <button class="btn btn-color-gray-600 btn-active btn-active-secondary px-6 py-3"
                                    data-kt-plan="annual">Anual</button>
                            </div>

                            {{-- Cards de Planos --}}
                            <div class="row g-10">
                                @foreach ($plans as $plan)
                                    <div class="col-xl-4">
                                        <div class="d-flex h-100 align-items-center">
                                            <div
                                                class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-15 px-10">
                                                <div class="mb-7 text-center">
                                                    <h1 class="text-gray-900 mb-5 fw-bolder">{{ $plan->name }}</h1>

                                                    <div class="text-center">
                                                        <span class="mb-2 text-primary">R$</span>
                                                        <span class="fs-3x fw-bold text-primary"
                                                            data-kt-plan-price-month="{{ $plan->price_monthly }}"
                                                            data-kt-plan-price-annual="{{ $plan->price_yearly / 12 }}">
                                                            {{ number_format($plan->price_monthly, 0, ',', '.') }}
                                                        </span>
                                                        <span class="fs-7 fw-semibold opacity-50">
                                                            <span data-kt-element="period">Mês</span>
                                                        </span>
                                                    </div>
                                                    <div class="mt-3 text-muted small plan-extra"></div>
                                                </div>

                                                {{-- Features --}}
                                                <div class="w-100 mb-10">
                                                    @foreach ($plan->features as $feature)
                                                        <div class="d-flex align-items-center mb-4">
                                                            <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">
                                                                {{ $feature->name }}
                                                                @if ($feature->description)
                                                                    <br>
                                                                    <span class="fs-7 text-gray-600 flex-grow-1 pe-3">
                                                                        {{ $feature->description }}
                                                                    </span>
                                                                @endif
                                                            </span>
                                                            <span class="fw-bold fs-6 text-gray-900 text-center"
                                                                style="min-width: 40px;">
                                                                @if ($feature->value === 'true')
                                                                    <i class="ki-duotone ki-check-circle fs-1 text-success">
                                                                        <span class="path1"></span><span
                                                                            class="path2"></span>
                                                                    </i>
                                                                @elseif ($feature->value === 'false')
                                                                    <i class="ki-duotone ki-cross-circle fs-1 text-danger">
                                                                        <span class="path1"></span><span
                                                                            class="path2"></span>
                                                                    </i>
                                                                @else
                                                                    {{ $feature->value }}
                                                                @endif
                                                            </span>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <a href="{{ route('register', ['plans' => strtolower($plan->name)]) }}"
                                                    class="btn btn-sm btn-primary select-plan"
                                                    data-plan="{{ strtolower($plan->name) }}"
                                                    data-month="{{ $plan->price_monthly }}"
                                                    data-annual="{{ $plan->price_yearly }}">
                                                    Selecionar
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Script: Alternar Mensal/Anual --}}
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // 🔹 Função para formatar moeda
            function formatCurrency(v) {
                return v.toLocaleString("pt-BR", {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            }

            // 🔹 Atualiza valores quando alterna entre mensal/anual
            function updateTotals() {
                const isAnnual = document
                    .querySelector("[data-kt-plan='annual']")
                    ?.classList.contains("active");

                document.querySelectorAll("[data-kt-plan-price-month]").forEach(span => {
                    const block = span.closest(".mb-7.text-center");
                    if (!block) return;

                    const month = parseFloat(span.dataset.ktPlanPriceMonth);
                    const annual = parseFloat(span.dataset.ktPlanPriceAnnual);
                    const extra = block.querySelector(".plan-extra");
                    if (!extra) return;

                    const priceWrapper = span.closest(".text-center");
                    priceWrapper.querySelector(".installment-text")?.remove();
                    extra.innerHTML = "";

                    // Exibir valores conforme período
                    span.textContent = formatCurrency(isAnnual ? annual : month);

                    if (isAnnual) {
                        const total = annual * 12;

                        const topText = document.createElement("div");
                        topText.className = "installment-text text-muted fw-semibold mb-1";
                        topText.style.lineHeight = "1.2";
                        topText.innerHTML = `Em até <strong class="fs-2">12x</strong> de`;
                        priceWrapper.prepend(topText);

                        extra.innerHTML = `
                    <div class="text-gray-800 fw-semibold mt-2">
                        Total: <strong>R$ ${formatCurrency(total)}</strong> por ano.
                    </div>
                `;
                    }
                });
            }

            // 🔹 Alterna botões de período
            document.addEventListener("click", e => {
                const btn = e.target.closest("[data-kt-plan]");
                if (btn) {
                    document.querySelectorAll("[data-kt-plan]").forEach(b => b.classList.remove("active"));
                    btn.classList.add("active");
                    setTimeout(updateTotals, 250);
                }
            });

            // 🔹 Lida com o clique no botão "Selecionar"
            document.querySelectorAll(".select-plan").forEach(btn => {
                btn.addEventListener("click", e => {
                    e.preventDefault();

                    const isAnnual = document
                        .querySelector("[data-kt-plan='annual']")
                        ?.classList.contains("active");

                    const period = isAnnual ? "annual" : "month";
                    const baseUrl = btn.getAttribute("href");

                    const separator = baseUrl.includes("?") ? "&" : "?";
                    const finalUrl = `${baseUrl}${separator}period=${period}`;

                    window.location.href = finalUrl;
                });
            });

            // Inicializa atualização inicial
            setTimeout(updateTotals, 300);
        });
    </script>

@endsection
