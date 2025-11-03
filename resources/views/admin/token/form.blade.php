<div class="row mb-5">
    @php
        $disabled = isset($isTrashed) && $isTrashed ? 'disabled' : '';
    @endphp

    {{-- Credencial --}}
    <div class="col-md-3">
        <label class="required form-label">Credencial</label>
        <select name="id_credential" class="form-select form-select-solid" data-control="select2" required {{ $disabled }}>
            <option value="">Selecione...</option>
            @foreach ($credentials as $credential)
                <option value="{{ $credential->id }}"
                    {{ old('id_credential', $item->id_credential ?? '') == $credential->id ? 'selected' : '' }}>
                    {{ $credential->name }}
                </option>
            @endforeach
        </select>
        @error('id_credential')
        <div class="text-danger fs-7 mt-2">{{ $message }}</div>
        @enderror
    </div>

    {{-- Ambiente --}}
    <div class="col-md-3">
        <label class="required form-label">Ambiente</label>
        <select name="environment" class="form-select form-select-solid" required {{ $disabled }}>
            <option value="production" {{ old('environment', $item->environment ?? '') === 'production' ? 'selected' : '' }}>Produção</option>
            <option value="sandbox" {{ old('environment', $item->environment ?? '') === 'sandbox' ? 'selected' : '' }}>Sandbox</option>
        </select>
        @error('environment')
        <div class="text-danger fs-7 mt-2">{{ $message }}</div>
        @enderror
    </div>

    {{-- Token --}}
    <div class="col-md-6">
        <label class="required form-label">Token</label>
        <input type="text" name="token" id="token" class="form-control form-control-solid"
               value="{{ old('token', $item->token ?? '') }}" required {{ $disabled }}>
        @error('token')
        <div class="text-danger fs-7 mt-2">{{ $message }}</div>
        @enderror
    </div>

    {{-- IP --}}
    <div class="col-md-6 mt-5">
        <label class="form-label">IP do Dispositivo</label>
        <input type="text" name="ip_address" class="form-control form-control-solid"
               value="{{ old('ip_address', $item->ip_address ?? '') }}" {{ $disabled }}>
        @error('ip_address')
        <div class="text-danger fs-7 mt-2">{{ $message }}</div>
        @enderror
    </div>

    {{-- Dispositivo --}}
    <div class="col-md-6 mt-5">
        <label class="form-label">Informações do Dispositivo</label>
        <input type="text" name="device_info" class="form-control form-control-solid"
               value="{{ old('device_info', $item->device_info ?? '') }}" {{ $disabled }}>
        @error('device_info')
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
    'module' => $module ?? 'token',
])
