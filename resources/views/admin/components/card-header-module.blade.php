<div class="card-header border-0 pt-5">
    <h3 class="card-title align-items-start flex-column">
        <span class="card-label fw-bold fs-3 mb-1">@yield('title')</span>
        <span class="text-muted mt-1 fw-semibold fs-7">
            Encontramos {{ number_format($count, 0, ',', '.') }} registros
        </span>
    </h3>
    <div class="card-toolbar">
        {{-- Desktop --}}
        <a href="{{ route('admin.module.create', ['module' => $module]) }}"
            class="btn btn-sm btn-light-primary d-none d-lg-flex align-items-center">
            <i class="ki-outline ki-plus fs-2 me-2"></i>
            Novo Registro
        </a>

        {{-- Mobile --}}
        <a href="{{ route('admin.module.create', ['module' => $module]) }}"
            class="btn btn-icon btn-sm btn-light-primary d-flex d-lg-none align-items-center justify-content-center">
            <i class="ki-outline ki-plus fs-2"></i>
        </a>
    </div>
</div>
