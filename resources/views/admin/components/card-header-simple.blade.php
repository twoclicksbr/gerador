<div class="card-header border-0 pt-5">
    <h3 class="card-title align-items-start flex-column">
        <span class="card-label fw-bold fs-3 mb-1">{{ $title ?? 'Formulário' }}</span>
        @isset($subtitle)
            <span class="text-muted mt-1 fw-semibold fs-7">{{ $subtitle }}</span>
        @endisset
    </h3>

    <div class="card-toolbar d-flex align-items-center">
        <a href="{{ url()->previous() }}"
            class="btn btn-icon btn-sm btn-light-danger d-flex align-items-center justify-content-center"
            data-bs-toggle="tooltip" data-bs-placement="left" title="Voltar">
            <i class="ki-solid ki-cross fs-2">
            </i>
        </a>
    </div>

</div>
