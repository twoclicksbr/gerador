<div class="row mb-5">
    @php
        $disabled = isset($isTrashed) && $isTrashed ? 'disabled' : '';
        use Illuminate\Support\Str;
        $slugValue = old('slug', $item->slug ?? Str::random(24));
    @endphp

    {{-- Nome --}}
    <div class="col-md-5">
        <label class="required form-label">Nome</label>
        <input type="text" name="name" id="name" class="form-control form-control-solid"
            value="{{ old('name', $item->name ?? '') }}" required {{ $disabled }} />
    </div>

    {{-- Slug --}}
    <div class="col-md-4">
        <label class="form-label">Slug</label>
        <div class="input-group input-group-solid">
            <input id="slug_input" type="text" name="slug" class="form-control form-control-solid border-end-0"
                value="{{ $slugValue }}" readonly />

            <span class="input-group-text border-start-0 px-3 bg-light-primary" id="copy_slug_btn"
                data-clipboard-target="#slug_input" style="cursor: pointer;" data-bs-toggle="tooltip"
                data-bs-placement="top" title="Copiar">
                <i class="ki-duotone ki-copy fs-3 text-primary" style="margin-top: 1px;">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </span>
        </div>

        @if (empty($isTrashed))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const nameInput = document.getElementById('name');
                    const slugInput = document.getElementById('slug_input');
                    const button = document.getElementById('copy_slug_btn');

                    // Inicia clipboard
                    const clipboard = new ClipboardJS(button, {
                        text: () => slugInput.value
                    });

                    // Feedback visual
                    clipboard.on('success', function() {
                        const icon = button.querySelector('i');
                        icon.classList.replace('ki-copy', 'ki-check');
                        icon.classList.add('text-success');

                        setTimeout(() => {
                            icon.classList.replace('ki-check', 'ki-copy');
                            icon.classList.remove('text-success');
                        }, 2000);
                    });
                });
            </script>
        @endif
    </div>

    {{-- Data de Validade --}}
    @php
        use Carbon\Carbon;
        $defaultDate = isset($item)
            ? Carbon::parse($item->dt_limit_access)->format('d/m/Y')
            : Carbon::now()->addDays(7)->format('d/m/Y');
    @endphp

    <div class="col-md-3">
        <label class="form-label">Data de Validade</label>
        <div class="input-group input-group-solid" id="kt_td_picker_date">
            <input id="dt_limit_access" name="dt_limit_access" type="text"
                   class="form-control form-control-solid border-end-0"
                   placeholder="Selecione a data"
                   data-td-target="#dt_limit_access"
                   data-td-toggle="datetimepicker"
                   value="{{ old('dt_limit_access', $defaultDate) }}"
                   autocomplete="off" {{ $disabled }} />

            <span class="input-group-text border-start-0 px-3 bg-light-primary"
                  data-td-target="#dt_limit_access"
                  data-td-toggle="datetimepicker" style="cursor: pointer;">
            <i class="ki-duotone ki-calendar fs-2 text-primary" style="margin-top: 1px;">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </span>
        </div>

        @if (empty($isTrashed))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    new tempusDominus.TempusDominus(document.getElementById('dt_limit_access'), {
                        display: {
                            components: {
                                decades: true,
                                year: true,
                                month: true,
                                date: true,
                                hours: false,
                                minutes: false,
                                seconds: false
                            },
                            buttons: {
                                today: true,
                                clear: true,
                                close: true
                            }
                        },
                        localization: {
                            locale: 'pt-BR',
                            format: 'dd/MM/yyyy'
                        }
                    });
                });
            </script>
        @endif
    </div>
</div>

{{-- Criado / Alterado --}}
@if (isset($item))
    <div class="row mb-5">
        <div class="col-md-6 text-gray-600 fs-7">
            <span class="fw-semibold">Criado em:</span>
            {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i:s') }},
            <span class="fw-semibold">Alterado em:</span>
            {{ \Carbon\Carbon::parse($item->updated_at)->format('d/m/Y H:i:s') }}
        </div>
    </div>
@endif

@include('admin.components.card-footer-submit', [
    'module' => $module ?? 'credential',
])
