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
                        <div class="d-flex flex-column">

                            <div class="nav-group nav-group-outline mx-auto mb-15" data-kt-buttons="true">
                                <button class="btn btn-color-gray-600 btn-active btn-active-secondary px-6 py-3 me-2 active"
                                    data-kt-plan="month">Mensal</button>
                                <button class="btn btn-color-gray-600 btn-active btn-active-secondary px-6 py-3"
                                    data-kt-plan="annual">Anual</button>
                            </div>
                            <div class="row g-10">
                                <div class="col-xl-4">
                                    <div class="d-flex h-100 align-items-center">
                                        <div
                                            class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-15 px-10">
                                            <div class="mb-7 text-center">
                                                <h1 class="text-gray-900 mb-5 fw-bolder">Starter</h1>

                                                <div class="text-center">
                                                    <span class="mb-2 text-primary">R$</span>
                                                    <span class="fs-3x fw-bold text-primary" data-kt-plan-price-month="297"
                                                        data-kt-plan-price-annual="247">297</span>
                                                    <span class="fs-7 fw-semibold opacity-50">
                                                        <span data-kt-element="period">Mês</span>
                                                    </span>
                                                </div>
                                                <div class="mt-3 text-muted small plan-extra"></div>
                                            </div>

                                            <div class="w-100 mb-10">
                                                <div class="d-flex align-items-center mb-3">
                                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1">
                                                        Número de Projetos
                                                    </span>
                                                    <span class="fw-bold fs-6 text-gray-900 text-center"
                                                        style="min-width: 40px;">
                                                        1
                                                    </span>
                                                </div>

                                                <div class="d-flex align-items-center mb-3">
                                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1">
                                                        Módulos por Projeto
                                                    </span>
                                                    <span class="fw-bold fs-6 text-gray-900 text-center"
                                                        style="min-width: 40px;">
                                                        10
                                                    </span>
                                                </div>

                                                <div class="d-flex align-items-center mb-3">
                                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1">
                                                        Usuários por conta
                                                    </span>
                                                    <span class="fw-bold fs-6 text-gray-900 text-center"
                                                        style="min-width: 40px;">
                                                        1
                                                    </span>
                                                </div>

                                                <div class="d-flex align-items-center mb-5">
                                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">
                                                        Armazenamento <br>
                                                        <span class="fs-7 text-gray-600 flex-grow-1 pe-3">
                                                            banco + arquivos
                                                        </span>
                                                    </span>
                                                    <span class="fw-bold fs-6 text-gray-900 text-center"
                                                        style="min-width: 40px;">
                                                        100 Mb
                                                    </span>
                                                </div>
                                                <div class="d-flex align-items-center mb-5">
                                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">
                                                        Domínios personalizados <br>
                                                        <span class="fs-7 text-gray-600 flex-grow-1 pe-3">
                                                            white label
                                                        </span>
                                                    </span>
                                                    <span class="fw-bold fs-6 text-gray-900 text-center"
                                                        style="min-width: 40px;">
                                                        <i class="ki-duotone ki-cross-circle fs-1 text-danger">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </span>
                                                </div>
                                                <div class="d-flex align-items-center mb-5">
                                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">
                                                        Suporte técnico <br>
                                                        <span class="fs-7 text-gray-600 flex-grow-1 pe-3">
                                                            Seg-Sex 9h as 17h
                                                        </span>
                                                    </span>
                                                    <span class="fw-bold fs-6 text-gray-900 text-center"
                                                        style="min-width: 40px;">
                                                        E-mail
                                                    </span>
                                                </div>
                                                <div class="d-flex align-items-center mb-5">
                                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">
                                                        Logs e monitoramento
                                                    </span>
                                                    <span class="fw-bold fs-6 text-gray-900 text-center"
                                                        style="min-width: 40px;">
                                                        Semanal
                                                    </span>
                                                </div>
                                                <div class="d-flex align-items-center mb-5">
                                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">
                                                        Backups automáticos
                                                    </span>
                                                    <span class="fw-bold fs-6 text-gray-900 text-center"
                                                        style="min-width: 40px;">
                                                        <i class="ki-duotone ki-cross-circle fs-1 text-danger">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </span>
                                                </div>

                                            </div>
                                            <a href="{{ route('register', ['plans' => 'starter']) }}"
                                                class="btn btn-sm btn-primary select-plan" data-plan="starter">
                                                Selecionar
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4">
                                    <div class="d-flex h-100 align-items-center">
                                        <div
                                            class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-20 px-10">
                                            <div class="mb-7 text-center">
                                                <h1 class="text-gray-900 mb-5 fw-bolder">Builder</h1>
                                                <div class="text-center">
                                                    <span class="mb-2 text-primary">R$</span>
                                                    <span class="fs-3x fw-bold text-primary" data-kt-plan-price-month="597"
                                                        data-kt-plan-price-annual="497">597</span>
                                                    <span class="fs-7 fw-semibold opacity-50">
                                                        <span data-kt-element="period">Mês</span>
                                                    </span>
                                                </div>
                                                <div class="mt-3 text-muted small plan-extra"></div>
                                            </div>
                                            <div class="w-100 mb-10">
                                                <div class="d-flex align-items-center mb-3">
                                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1">
                                                        Número de Projetos
                                                    </span>
                                                    <span class="fw-bold fs-6 text-gray-900 text-center"
                                                        style="min-width: 40px;">
                                                        5
                                                    </span>
                                                </div>

                                                <div class="d-flex align-items-center mb-3">
                                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1">
                                                        Módulos por Projeto
                                                    </span>
                                                    <span class="fw-bold fs-6 text-gray-900 text-center"
                                                        style="min-width: 40px;">
                                                        20
                                                    </span>
                                                </div>

                                                <div class="d-flex align-items-center mb-3">
                                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1">
                                                        Usuários por conta
                                                    </span>
                                                    <span class="fw-bold fs-6 text-gray-900 text-center"
                                                        style="min-width: 40px;">
                                                        3
                                                    </span>
                                                </div>

                                                <div class="d-flex align-items-center mb-5">
                                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">
                                                        Armazenamento <br>
                                                        <span class="fs-7 text-gray-600 flex-grow-1 pe-3">
                                                            banco + arquivos
                                                        </span>
                                                    </span>
                                                    <span class="fw-bold fs-6 text-gray-900 text-center"
                                                        style="min-width: 40px;">
                                                        500 Mb
                                                    </span>
                                                </div>
                                                <div class="d-flex align-items-center mb-5">
                                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">
                                                        Domínios personalizados <br>
                                                        <span class="fs-7 text-gray-600 flex-grow-1 pe-3">
                                                            white label
                                                        </span>
                                                    </span>
                                                    <span class="fw-bold fs-6 text-gray-900 text-center"
                                                        style="min-width: 40px;">
                                                        <i class="ki-duotone ki-cross-circle fs-1 text-danger">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </span>
                                                </div>
                                                <div class="d-flex align-items-center mb-5">
                                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">
                                                        Suporte técnico <br>
                                                        <span class="fs-7 text-gray-600 flex-grow-1 pe-3">
                                                            Seg-Sex 9h as 17h
                                                        </span>
                                                    </span>
                                                    <span class="fw-bold fs-6 text-gray-900 text-center"
                                                        style="min-width: 40px;">
                                                        Prioritário
                                                    </span>
                                                </div>
                                                <div class="d-flex align-items-center mb-5">
                                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">
                                                        Logs e monitoramento
                                                    </span>
                                                    <span class="fw-bold fs-6 text-gray-900 text-center"
                                                        style="min-width: 40px;">
                                                        Diário
                                                    </span>
                                                </div>
                                                <div class="d-flex align-items-center mb-5">
                                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">
                                                        Backups automáticos
                                                    </span>
                                                    <span class="fw-bold fs-6 text-gray-900 text-center"
                                                        style="min-width: 40px;">
                                                        <i class="ki-duotone ki-cross-circle fs-1 text-danger">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </span>
                                                </div>

                                            </div>
                                            <a href="{{ route('register', ['plans' => 'builder']) }}"
                                                class="btn btn-sm btn-primary select-plan" data-plan="builder">
                                                Selecionar
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4">
                                    <div class="d-flex h-100 align-items-center">
                                        <div
                                            class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-15 px-10">
                                            <div class="mb-7 text-center">
                                                <h1 class="text-gray-900 mb-5 fw-bolder">Infinity</h1>
                                                <div class="text-center">
                                                    <span class="mb-2 text-primary">R$</span>
                                                    <span class="fs-3x fw-bold text-primary"
                                                        data-kt-plan-price-month="897"
                                                        data-kt-plan-price-annual="747">897</span>
                                                    <span class="fs-7 fw-semibold opacity-50">
                                                        <span data-kt-element="period">Mês</span>
                                                    </span>
                                                </div>
                                                <div class="mt-3 text-muted small plan-extra"></div>
                                            </div>

                                            <div class="w-100 mb-10">
                                                <div class="d-flex align-items-center mb-3">
                                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1">
                                                        Número de Projetos
                                                    </span>
                                                    <span class="fw-bold fs-6 text-gray-900 text-center"
                                                        style="min-width: 40px;">
                                                        Ilimitado
                                                    </span>
                                                </div>

                                                <div class="d-flex align-items-center mb-3">
                                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1">
                                                        Módulos por Projeto
                                                    </span>
                                                    <span class="fw-bold fs-6 text-gray-900 text-center"
                                                        style="min-width: 40px;">
                                                        Ilimitado
                                                    </span>
                                                </div>

                                                <div class="d-flex align-items-center mb-3">
                                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1">
                                                        Usuários por conta
                                                    </span>
                                                    <span class="fw-bold fs-6 text-gray-900 text-center"
                                                        style="min-width: 40px;">
                                                        Ilimitado
                                                    </span>
                                                </div>

                                                <div class="d-flex align-items-center mb-5">
                                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">
                                                        Armazenamento <br>
                                                        <span class="fs-7 text-gray-600 flex-grow-1 pe-3">
                                                            banco + arquivos
                                                        </span>
                                                    </span>
                                                    <span class="fw-bold fs-6 text-gray-900 text-center"
                                                        style="min-width: 40px;">
                                                        1 Gb
                                                    </span>
                                                </div>
                                                <div class="d-flex align-items-center mb-5">
                                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">
                                                        Domínios personalizados <br>
                                                        <span class="fs-7 text-gray-600 flex-grow-1 pe-3">
                                                            white label
                                                        </span>
                                                    </span>
                                                    <span class="fw-bold fs-6 text-gray-900 text-center"
                                                        style="min-width: 40px;">
                                                        <i class="ki-duotone ki-check-circle fs-1 text-success">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </span>
                                                </div>
                                                <div class="d-flex align-items-center mb-5">
                                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">
                                                        Suporte técnico <br>
                                                        <span class="fs-7 text-gray-600 flex-grow-1 pe-3">
                                                            Seg-Sex 9h as 17h
                                                        </span>
                                                    </span>
                                                    <span class="fw-bold fs-6 text-gray-900 text-center"
                                                        style="min-width: 40px;">
                                                        Dedicado
                                                    </span>
                                                </div>
                                                <div class="d-flex align-items-center mb-5">
                                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">
                                                        Logs e monitoramento
                                                    </span>
                                                    <span class="fw-bold fs-6 text-gray-900 text-center"
                                                        style="min-width: 40px;">
                                                        Tempo Real
                                                    </span>
                                                </div>
                                                <div class="d-flex align-items-center mb-5">
                                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">
                                                        Backups automáticos
                                                    </span>
                                                    <span class="fw-bold fs-6 text-gray-900 text-center"
                                                        style="min-width: 40px;">
                                                        <i class="ki-duotone ki-check-circle fs-1 text-success">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </span>
                                                </div>

                                            </div>

                                            <a href="{{ route('register', ['plans' => 'infinity']) }}"
                                                class="btn btn-sm btn-primary select-plan" data-plan="infinity">
                                                Selecionar
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll(".select-plan").forEach(btn => {
                btn.addEventListener("click", e => {
                    e.preventDefault(); // impede o redirecionamento automático

                    const isAnnual = document
                        .querySelector("[data-kt-plan='annual']")
                        ?.classList.contains("active");

                    const period = isAnnual ? "annual" : "month";
                    const baseUrl = btn.getAttribute("href");

                    // adiciona o parâmetro corretamente
                    const separator = baseUrl.includes("?") ? "&" : "?";
                    const finalUrl = `${baseUrl}${separator}period=${period}`;

                    // redireciona manualmente
                    window.location.href = finalUrl;
                });
            });
        });
    </script>


    <script>
        (function() {
            function formatCurrency(v) {
                return v.toLocaleString("pt-BR", {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            }

            function updateTotals() {
                const isAnnual = document.querySelector("[data-kt-plan='annual']")?.classList.contains("active");

                document.querySelectorAll("[data-kt-plan-price-month]").forEach(span => {
                    const block = span.closest(".mb-7.text-center");
                    if (!block) return;

                    const month = parseFloat(span.dataset.ktPlanPriceMonth);
                    const annual = parseFloat(span.dataset.ktPlanPriceAnnual);
                    const extra = block.querySelector(".plan-extra");
                    if (!extra) return;

                    // remove textos anteriores
                    const priceWrapper = span.closest(".text-center");
                    priceWrapper.querySelector(".installment-text")?.remove();
                    extra.innerHTML = "";

                    if (isAnnual) {
                        const total = annual * 12;
                        const installment = total / 12;

                        // texto "Em até 12x" acima do preço
                        const topText = document.createElement("div");
                        topText.className = "installment-text text-muted fw-semibold mb-1";
                        topText.style.lineHeight = "1.2";
                        topText.innerHTML = `Em até <strong class="fs-2">12x</strong> de`;
                        priceWrapper.prepend(topText);

                        // texto "Total anual" abaixo
                        extra.innerHTML = `
                        <div class="text-gray-800 fw-semibold mt-2">
                            Total: <strong>R$ ${formatCurrency(total)}</strong>
                        </div>
                    `;
                    }
                });
            }

            setTimeout(updateTotals, 300);

            document.addEventListener("click", e => {
                if (e.target.closest("[data-kt-plan]")) {
                    setTimeout(updateTotals, 250);
                }
            });
        })();
    </script>






@endsection
