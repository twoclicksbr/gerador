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

    {{-- Nome --}}
    <div class="col-md-6">
        <label class="required form-label">Nome</label>
        <input type="text" name="name" class="form-control form-control-solid"
               value="{{ old('name', $item->name ?? '') }}" required {{ $disabled }}>
        @error('name')
        <div class="text-danger fs-7 mt-2">{{ $message }}</div>
        @enderror
    </div>

    {{-- Slug --}}
    <div class="col-md-3">
        <label class="required form-label">Slug</label>
        <input type="text" name="slug" class="form-control form-control-solid"
               value="{{ old('slug', $item->slug ?? '') }}" required {{ $disabled }}>
        @error('slug')
        <div class="text-danger fs-7 mt-2">{{ $message }}</div>
        @enderror
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const nameInput = document.querySelector('input[name="name"]');
            const slugInput = document.querySelector('input[name="slug"]');

            function generateSlug(text) {
                return text
                    .toLowerCase()
                    .normalize('NFD') // remove acentos
                    .replace(/[\u0300-\u036f]/g, '')
                    .replace(/[^a-z0-9]+/g, '-') // troca espaços e símbolos por hífens
                    .replace(/(^-|-$)+/g, ''); // remove hífens do início/fim
            }

            nameInput.addEventListener('input', () => {
                slugInput.value = generateSlug(nameInput.value);
            });
        });
    </script>

    {{-- Descrição --}}
    <div class="col-md-12 mt-5">
        <label class="form-label">Descrição</label>
        <textarea name="description" class="form-control form-control-solid" rows="3" {{ $disabled }}
        placeholder="Digite uma descrição opcional">{{ old('description', $item->description ?? '') }}</textarea>
        @error('description')
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
    'module' => $module ?? 'project',
])
