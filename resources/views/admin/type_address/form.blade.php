<div class="row mb-5">
    @php
        $disabled = isset($isTrashed) && $isTrashed ? 'disabled' : '';
    @endphp

    {{-- Nome --}}
    <div class="col-md-12">
        <label class="required form-label">Nome</label>
        <input type="text" name="name" id="name" class="form-control form-control-solid"
               value="{{ old('name', $item->name ?? '') }}" required {{ $disabled }} />
        @error('name')
        <div class="text-danger fs-7 mt-2">{{ $message }}</div>
        @enderror
    </div>

</div>

{{-- Criado / Alterado --}}
@if (isset($item))
    <div class="row mb-5">
        <div class="col-md-12 text-gray-600 fs-7">
            <span class="fw-semibold">Criado em:</span>
            {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i:s') }},
            <span class="fw-semibold">Alterado em:</span>
            {{ \Carbon\Carbon::parse($item->updated_at)->format('d/m/Y H:i:s') }}
        </div>
    </div>
@endif

@include('admin.components.card-footer-submit', [
    'module' => $module ?? 'type_address',
])
