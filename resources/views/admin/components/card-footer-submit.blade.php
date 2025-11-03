<div class="d-flex justify-content-between align-items-center mt-10">

    {{-- Switch Público / Inativo --}}
    <div class="form-check form-switch form-check-custom form-check-solid">
        <input type="hidden" name="active" value="0">
        <input class="form-check-input me-2" type="checkbox" name="active" value="1" id="active"
            {{ old('active', $item->active ?? 0) ? 'checked' : '' }}
            {{ ($isTrashed ?? false) ? 'disabled' : '' }}>
        <label class="form-check-label fw-semibold text-gray-700 ms-2" for="active" id="active_label">
            {{ old('active', $item->active ?? 0) ? 'Público' : 'Inativo' }}
        </label>

        @if (empty($isTrashed))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const checkbox = document.getElementById('active');
                    const label = document.getElementById('active_label');
                    const updateLabel = () => label.textContent = checkbox.checked ? 'Público' : 'Inativo';
                    checkbox.addEventListener('change', updateLabel);
                    updateLabel();
                });
            </script>
        @endif
    </div>

    {{-- Botões de ação --}}
    <div class="d-flex">
        @if ($isTrashed ?? false)
            {{-- Restaurar / Descartar --}}
            <button type="button" class="btn btn-sm btn-light-success me-3"
                    onclick="if(confirm('Deseja restaurar este registro?')) document.getElementById('restore-form').submit();">
                <i class="ki-solid ki-arrow-circle-left fs-3"></i> Restaurar
            </button>

            <a class="btn btn-sm btn-light-danger"
               href="{{ route('admin.module.index', ['module' => $module ?? 'credential']) }}">
                <i class="ki-solid ki-black-left-line fs-4 me-2"></i> Descartar
            </a>
        @else
            {{-- Salvar / Cancelar --}}
            <a class="btn btn-sm btn-light-danger me-3"
               href="{{ route('admin.module.index', ['module' => $module ?? 'credential']) }}">
                <i class="ki-solid ki-black-left-line fs-4 me-2"></i> Descartar
            </a>

            <button type="submit" class="btn btn-sm btn-light-primary">
                <i class="ki-duotone ki-send fs-2">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i> Salvar
            </button>
        @endif
    </div>
</div>

