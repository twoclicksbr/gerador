<div class="row mb-5">
    @php
        $disabled = isset($isTrashed) && $isTrashed ? 'disabled' : '';
    @endphp

    {{-- Credencial --}}
    <div class="col-md-3">
        <label class="required form-label">Credencial</label>
        <select name="id_credential" class="form-select form-select-solid" data-control="select2"
                required {{ $disabled }}>
            <option value="">Selecione</option>
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
        <select name="environment" class="form-select form-select-solid" data-control="select2"
                required {{ $disabled }}>
            <option value="">Selecione</option>
            <option value="sandbox" {{ old('environment', $item->environment ?? '') === 'sandbox' ? 'selected' : '' }}>
                Sandbox
            </option>
            <option
                value="production" {{ old('environment', $item->environment ?? '') === 'production' ? 'selected' : '' }}>
                Produção
            </option>
        </select>
        @error('environment')
        <div class="text-danger fs-7 mt-2">{{ $message }}</div>
        @enderror
    </div>

    {{-- Token --}}
    <div class="col-md-6">
        <label class="required form-label">Token</label>

        <div class="input-group input-group-sm" style="border-radius: 0.75rem; overflow: hidden;">
            {{-- botão gerar novo token --}}
            <button id="btn_generate_token" type="button"
                    class="btn btn-icon btn-light-success px-4">
                <i class="ki-outline ki-arrows-loop fs-3"></i>
            </button>

            <input id="token_field" type="text" name="token"
                   class="form-control form-control-solid text-gray-800 fs-6"
                   style="height: 42px;"
                   value="{{ old('token', $item->token ?? '') }}"
                   readonly required {{ $disabled }}>

            {{-- botão copiar --}}
            <button id="btn_copy_token" type="button"
                    class="btn btn-icon btn-light-primary px-4"
                    data-clipboard-target="#token_field">
                <i class="ki-outline ki-copy fs-3"></i>
            </button>
        </div>

        @error('token')
        <div class="text-danger fs-7 mt-2">{{ $message }}</div>
        @enderror
    </div>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/clipboard@2/dist/clipboard.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const envSelect = $('select[name="environment"]');
            const tokenInput = $('#token_field');

            function generateToken(prefix) {
                const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                let randomPart = '';
                for (let i = 0; i < 60; i++) {
                    randomPart += chars.charAt(Math.floor(Math.random() * chars.length));
                }
                return `${prefix}_${randomPart}`;
            }

            // Gera automaticamente ao mudar ambiente
            envSelect.on('change.select2', function () {
                const value = $(this).val();
                if (value === 'sandbox') tokenInput.val(generateToken('public'));
                else if (value === 'production') tokenInput.val(generateToken('secret'));
                else tokenInput.val('');
            });

            // Gera manualmente via botão
            $('#btn_generate_token').on('click', function () {
                const value = envSelect.val();
                if (value === 'sandbox') tokenInput.val(generateToken('public'));
                else if (value === 'production') tokenInput.val(generateToken('secret'));
                else alert('Selecione um ambiente primeiro!');
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/clipboard@2/dist/clipboard.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const clipboard = new ClipboardJS('#btn_copy_token');

            clipboard.on('success', function (e) {
                const button = e.trigger;
                const icon = button.querySelector('i');

                icon.classList.remove('ki-copy');
                icon.classList.add('ki-check', 'text-white');

                setTimeout(() => {
                    icon.classList.remove('ki-check', 'text-white');
                    icon.classList.add('ki-copy');
                }, 1500);
            });
        });
    </script>

    {{-- IP --}}
    <div class="col-md-6 mt-5">
        <label class="form-label">IP do Dispositivo</label>
        <input type="text" name="ip_address" class="form-control form-control-solid"
               value="{{ old('ip_address', $item->ip_address ?? request()->ip()) }}"
               readonly>
        @error('ip_address')
        <div class="text-danger fs-7 mt-2">{{ $message }}</div>
        @enderror
    </div>

    {{-- Dispositivo --}}
    <div class="col-md-6 mt-5">
        <label class="form-label">Informações do Dispositivo</label>
        <input type="text" name="device_info" class="form-control form-control-solid"
               value="{{ old('device_info', $item->device_info ?? request()->header('User-Agent')) }}"
               readonly>
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
