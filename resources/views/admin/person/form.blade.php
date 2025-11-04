@php
    $item = $item ?? null;
    $disabled = isset($isTrashed) && $isTrashed ? 'disabled' : '';
@endphp

<fieldset class="border border-gray-300 rounded-2 p-8 mb-5">
    <legend class="float-none w-auto px-3 fs-5 fw-bold text-gray-700">Dados Pessoais:</legend>

    <div class="row mb-5">

        {{-- Crendencial --}}
        <div class="col-md-3 fv-row">
            <label class="required fs-5 fw-semibold mb-2">Credencial:</label>
            <select class="form-select form-select-solid" name="id_credential" data-control="select2" {{ $disabled }}
            required>
                <option value="">Selecione</option>
                @foreach ($credentials as $credential)
                    <option value="{{ $credential->id }}"
                        {{ old('id_credential', $item->id_credential ?? '') == $credential->id ? 'selected' : '' }}>
                        {{ $credential->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Nome --}}
        <div class="col-md-6">
            <label class="required form-label">Nome</label>
            <input type="text" name="name" id="name" class="form-control form-control-solid"
                   value="{{ old('name', $item->name ?? '') }}" required {{ $disabled }} />
        </div>

        {{-- Data de Nascimento --}}
        <div class="col-md-3">
            <label class="form-label">Data de Nascimento</label>
            <div class="input-group input-group-solid" id="kt_td_picker_birthdate">
                <input id="birthdate" name="birthdate" type="text"
                       class="form-control form-control-solid border-end-0" placeholder="Selecione a data"
                       data-td-target="#birthdate" data-td-toggle="datetimepicker"
                       value="{{ old('birthdate', isset($item) ? \Carbon\Carbon::parse($item->birthdate)->format('d/m/Y') : '') }}"
                       autocomplete="off" {{ $disabled }} />

                <span class="input-group-text border-start-0 px-3 bg-light-primary" data-td-target="#birthdate"
                      data-td-toggle="datetimepicker" style="cursor: pointer;">
                    <i class="ki-duotone ki-calendar fs-2 text-primary" style="margin-top: 1px;">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </span>
            </div>

            @if (empty($isTrashed))
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        // inicializa o datetimepicker existente
                        new tempusDominus.TempusDominus(document.getElementById('birthdate'), {
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

                        // aplica a máscara no campo
                        Inputmask({
                            mask: "99/99/9999",
                            placeholder: "_",
                            clearIncomplete: true
                        }).mask(document.getElementById('birthdate'));
                    });
                </script>
            @endif
        </div>

    </div>

    <div class="row mb-5">

        {{-- WhatsApp --}}
        <div class="col-12 col-md-6 fv-row">
            <label class="fs-5 fw-semibold mb-2">WhatsApp:</label>
            <div class="d-flex gap-3 align-items-center">
                {{-- Seletor de país --}}
                <div class="flex-shrink-0" style="width: 160px;">
                    <select class="form-select form-select-solid" data-control="select2" data-placeholder="Selecione"
                            id="kt_select_country_code" name="country_code" {{ $disabled }}>
                        <option></option>

                        <option value="+55" data-kt-select2-country="{{ asset('assets/media/flags/brazil.svg') }}"
                                selected>
                            Brasil (+55)
                        </option>
                        <option value="+54"
                                data-kt-select2-country="{{ asset('assets/media/flags/argentina.svg') }}">
                            Argentina (+54)
                        </option>
                        <option value="+56" data-kt-select2-country="{{ asset('assets/media/flags/chile.svg') }}">
                            Chile
                            (+56)
                        </option>
                        <option value="+57"
                                data-kt-select2-country="{{ asset('assets/media/flags/colombia.svg') }}">
                            Colômbia (+57)
                        </option>
                        <option value="+351"
                                data-kt-select2-country="{{ asset('assets/media/flags/portugal.svg') }}">
                            Portugal (+351)
                        </option>
                        <option value="+1"
                                data-kt-select2-country="{{ asset('assets/media/flags/united-states.svg') }}">EUA (+1)
                        </option>
                    </select>
                </div>

                {{-- Campo hidden para armazenar o código selecionado --}}
                <input type="hidden" name="country_code_hidden" id="country_code_hidden" value="+55">

                {{-- Número sem DDI --}}
                <input type="text" class="form-control form-control-solid flex-grow-1"
                       placeholder="Número do WhatsApp (apenas números)" name="whatsapp"
                       value="{{ old('whatsapp', isset($item->whatsapp) ? preg_replace('/^\+55/', '', $item->whatsapp) : '') }}"
                    {{ $disabled }} />
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const select = $('#kt_select_country_code');
                    const hidden = document.getElementById('country_code_hidden');
                    const form = document.querySelector('form');
                    const whatsapp = document.querySelector('input[name="whatsapp"]');

                    // Atualiza o campo hidden quando muda o país
                    select.on('change', function () {
                        hidden.value = this.value || '+55';
                    });

                    hidden.value = select.val() || '+55';

                    // Customização visual com bandeiras
                    const optionFormat = (item) => {
                        if (!item.id) return item.text;
                        const imgUrl = item.element.getAttribute('data-kt-select2-country');
                        return $(
                            `<span><img src="${imgUrl}" class="rounded-circle h-20px me-2" alt="flag"/>${item.text}</span>`
                        );
                    };

                    select.select2({
                        templateSelection: optionFormat,
                        templateResult: optionFormat,
                        minimumResultsForSearch: Infinity,
                        dropdownParent: $('#kt_select_country_code').closest('.fv-row')
                    });

                    // ✅ Antes de enviar o formulário, concatena o DDI no número
                    if (form && whatsapp && hidden) {
                        form.addEventListener('submit', function () {
                            let num = whatsapp.value.replace(/\D/g, '');
                            let ddi = hidden.value || '+55';

                            if (!num.startsWith(ddi.replace('+', ''))) {
                                whatsapp.value = `${ddi}${num}`;
                            }
                        });
                    }
                });
            </script>
        </div>

        {{-- CPF/CNPJ --}}
        <div class="col-12 col-md-3 fv-row">
            <label class="required fs-5 fw-semibold mb-2">CPF/CNPJ:</label>
            <input id="cpf_cnpj" type="text" class="form-control form-control-solid" placeholder="CPF ou CNPJ"
                   name="cpf_cnpj" value="{{ old('cpf_cnpj', $item->cpf_cnpj ?? '') }}" inputmode="numeric"
                   maxlength="18"
                {{ $disabled }} />

            <script>
                const cpfCnpjInput = document.getElementById('cpf_cnpj');

                cpfCnpjInput.addEventListener('input', function (e) {
                    let v = e.target.value.replace(/\D/g, '');

                    if (v.length <= 11) {
                        // CPF → 000.000.000-00
                        v = v.slice(0, 11)
                            .replace(/(\d{3})(\d)/, '$1.$2')
                            .replace(/(\d{3})(\d)/, '$1.$2')
                            .replace(/(\d{3})(\d{1,2})$/, '$1-$2');
                    } else {
                        // CNPJ → 00.000.000/0000-00
                        v = v.slice(0, 14)
                            .replace(/^(\d{2})(\d)/, '$1.$2')
                            .replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3')
                            .replace(/\.(\d{3})(\d)/, '.$1/$2')
                            .replace(/(\d{4})(\d{1,2})$/, '$1-$2');
                    }

                    e.target.value = v;
                });

                // Função opcional para pegar o valor limpo (sem pontuação)
                function getCpfCnpjDigits() {
                    return cpfCnpjInput.value.replace(/\D/g, '');
                }
            </script>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const cpfInput = document.getElementById('cpf_cnpj');
                    const feedback = document.createElement('div');
                    feedback.classList.add('mt-1', 'small');
                    cpfInput.after(feedback);

                    cpfInput.addEventListener('blur', function () {
                        const raw = cpfInput.value.replace(/\D/g, '');
                        if (!raw) return;

                        fetch(`/check-cpf-cnpj?cpf_cnpj=${encodeURIComponent(raw)}`)
                            .then(res => res.json())
                            .then(data => {
                                if (data.exists) {
                                    feedback.textContent = '❌ CPF/CNPJ já cadastrado.';
                                    feedback.className = 'text-danger small mt-1';
                                } else {
                                    feedback.textContent = '✅ CPF/CNPJ disponível.';
                                    feedback.className = 'text-success small mt-1';
                                }
                            })
                            .catch(() => {
                                feedback.textContent = 'Erro ao verificar CPF/CNPJ.';
                                feedback.className = 'text-muted small mt-1';
                            });
                    });
                });
            </script>
        </div>


        {{-- Gênero --}}
        <div class="col-md-3 fv-row">
            <label class="required fs-5 fw-semibold mb-2">Gênero:</label>
            <select class="form-select form-select-solid" name="gender" data-control="select2" {{ $disabled }}>
                <option value="">Selecione</option>
                <option value="Masculino" {{ old('gender', $item->gender ?? '') == 'Masculino' ? 'selected' : '' }}>
                    Masculino
                </option>
                <option value="Feminino" {{ old('gender', $item->gender ?? '') == 'Feminino' ? 'selected' : '' }}>
                    Feminino
                </option>

            </select>
        </div>

    </div>

</fieldset>

<fieldset class="border border-gray-300 rounded-2 p-8 mb-5">
    <legend class="float-none w-auto px-3 fs-5 fw-bold text-gray-700">Endereço:</legend>

    <div class="row gy-3">

        {{-- CEP --}}
        <div class="col-md-2 fv-row">
            <label class="form-label required">CEP:</label>
            <input type="text" id="zip_code" name="zip_code" class="form-control form-control-solid"
                   placeholder="Digite o CEP" maxlength="9" {{ $disabled }}
                   value="{{ old('zip_code', $item->address->cep ?? '') }}"/>
        </div>

        {{-- Tipo --}}
        <div class="col-md-2 fv-row">
            <label class="form-label required">Tipo:</label>
            <select class="form-select form-select-solid" name="id_type_address" data-control="select2" required
                {{ $disabled }}>
                <option value="">Selecione</option>
                @foreach ($typeAddresses as $type)
                    <option value="{{ $type->id }}"
                        {{ old('id_type_address', $item->address->id_type_address ?? '') == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Rua --}}
        <div class="col-md-6 fv-row">
            <label class="form-label required">Rua:</label>
            <input type="text" id="street" name="street" class="form-control form-control-solid"
                   placeholder="Nome da rua" value="{{ old('street', $item->address->street ?? '') }}"
                {{ $disabled }} />
        </div>

        {{-- Número --}}
        <div class="col-md-2 fv-row">
            <label class="form-label required">Número:</label>
            <input type="text" id="number" name="number" class="form-control form-control-solid"
                   placeholder="Número" value="{{ old('number', $item->address->number ?? '') }}"
                {{ $disabled }} />
        </div>

        {{-- Complemento --}}
        <div class="col-md-3 fv-row">
            <label class="form-label">Complemento:</label>
            <input type="text" id="complement" name="complement" class="form-control form-control-solid"
                   placeholder="Complemento (opcional)"
                   value="{{ old('complement', $item->address->complement ?? '') }}" {{ $disabled }} />
        </div>

        {{-- Bairro --}}
        <div class="col-md-3 fv-row">
            <label class="form-label required">Bairro:</label>
            <input type="text" id="district" name="district" class="form-control form-control-solid"
                   placeholder="Bairro" value="{{ old('district', $item->address->district ?? '') }}"
                {{ $disabled }} />
        </div>

        {{-- Cidade --}}
        <div class="col-md-4 fv-row">
            <label class="form-label required">Cidade:</label>
            <input type="text" id="city" name="city" class="form-control form-control-solid"
                   placeholder="Cidade" value="{{ old('city', $item->address->city ?? '') }}" {{ $disabled }} />
        </div>

        {{-- Estado --}}
        <div class="col-md-2 fv-row">
            <label class="form-label required">Estado:</label>
            <input type="text" id="state" name="state" class="form-control form-control-solid"
                   placeholder="UF" maxlength="2" value="{{ old('state', $item->address->state ?? '') }}"
                {{ $disabled }} />
        </div>

    </div>

    {{-- Script: máscara e busca automática via CEP --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const zip = document.getElementById('zip_code');

            // Função para aplicar máscara
            function applyMask(input) {
                let v = input.value.replace(/\D/g, '').slice(0, 8);
                v = v.replace(/(\d{5})(\d)/, '$1-$2');
                input.value = v;
            }

            // ✅ Aplica máscara ao carregar a página (se houver valor)
            applyMask(zip);

            zip.addEventListener('input', function (e) {
                applyMask(e.target);
            });

            zip.addEventListener('blur', function () {
                const cep = zip.value.replace(/\D/g, '');
                if (cep.length !== 8) return;

                fetch(`https://viacep.com.br/ws/${cep}/json/`)
                    .then(r => r.json())
                    .then(data => {
                        if (data.erro) {
                            alert('❌ CEP não encontrado. Verifique o CEP e tente novamente.');
                            return;
                        }
                        document.getElementById('street').value = data.logradouro || '';
                        document.getElementById('district').value = data.bairro || '';
                        document.getElementById('city').value = data.localidade || '';
                        document.getElementById('state').value = data.uf || '';
                    })
                    .catch(() => alert('❌ Erro ao buscar CEP. Tente novamente.'));
            });
        });
    </script>
</fieldset>


<fieldset class="border border-gray-300 rounded-2 p-8 mb-5">
    <legend class="float-none w-auto px-3 fs-5 fw-bold text-gray-700">Acesso ao DevsAPI:</legend>

    <div class="row gy-4">
        {{-- 📧 E-mail --}}
        <div class="col-md-4">
            <div class="fv-row mb-3">
                <label class="form-label required">E-mail:</label>
                <input type="email"
                       id="email_input"
                       name="{{ isset($item) ? '' : 'email' }}"
                       class="form-control form-control-solid"
                       value="{{ old('email', $item->user?->email ?? '') }}"
                    {{ isset($item) ? '' : 'required' }} />
                <div id="email-feedback" class="mt-2 small"></div>
            </div>

            {{-- Só mostra o botão de atualização no EDIT --}}
            @if(isset($item))
                <button type="button" class="btn btn-light-primary" id="btn-update-email">Atualizar E-mail</button>
            @endif
        </div>

        {{-- 🔐 Senha --}}
        <div class="col-md-8">
            <div class="row gy-3">
                {{-- Nova Senha --}}
                <div class="col-md-6 fv-row" data-kt-password-meter="true">
                    <label class="form-label">{{ isset($item) ? 'Nova Senha:' : 'Senha:' }}</label>
                    <div class="position-relative mb-3">
                        <input class="form-control form-control-solid"
                               type="password"
                               id="password_input"
                               name="{{ isset($item) ? '' : 'password' }}"
                               placeholder="{{ isset($item) ? 'Em branco mantém senha atual' : 'Crie uma senha' }}"
                               autocomplete="off"
                            {{ isset($item) ? '' : 'required' }} />

                        <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                              id="btn-toggle-password" style="cursor: pointer;">
                            <i class="ki-outline ki-eye-slash fs-2"></i>
                            <i class="ki-outline ki-eye fs-2 d-none"></i>
                        </span>
                    </div>

                    {{-- Barra de força --}}
                    <div class="d-flex align-items-center mb-3" id="password-bars">
                        @for ($i = 0; $i < 4; $i++)
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                        @endfor
                    </div>

                    <div id="passwordMessage" class="text-muted">
                        Use 8 ou mais caracteres com letras, números, símbolos e ao menos uma maiúscula.
                    </div>
                </div>

                {{-- Confirmar Senha --}}
                <div class="col-md-6 fv-row">
                    <label class="form-label">Confirmar Senha:</label>
                    <input id="confirm_password_input"
                           type="password"
                           name="{{ isset($item) ? '' : 'password_confirmation' }}"
                           class="form-control form-control-solid"
                           autocomplete="off"
                           placeholder="Confirme a senha"
                        {{ isset($item) ? '' : 'required' }} />
                    <div id="confirmMessage" class="text-muted mt-2">Repita a senha.</div>
                </div>

                {{-- Só mostra o botão de atualização no EDIT --}}
                @if(isset($item))
                    <div class="col-12">
                        <button type="button" class="btn btn-light-primary" id="btn-update-password">Atualizar Senha</button>
                        <div id="password-feedback" class="mt-2 small"></div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</fieldset>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const personId = "{{ $item->id ?? '' }}";
        const module = "{{ $module }}";

        // ========== EMAIL SECTION ==========
        const emailInput = document.getElementById('email_input');
        const btnUpdateEmail = document.getElementById('btn-update-email');
        const emailFeedback = document.getElementById('email-feedback');

        if (btnUpdateEmail && personId) {
            btnUpdateEmail.addEventListener('click', function () {
                const email = emailInput.value.trim();

                if (!email) {
                    emailFeedback.textContent = '❌ Por favor, preencha o e-mail.';
                    emailFeedback.className = 'text-danger small mt-2';
                    return;
                }

                if (!email.includes('@')) {
                    emailFeedback.textContent = '❌ Informe um e-mail válido.';
                    emailFeedback.className = 'text-danger small mt-2';
                    return;
                }

                btnUpdateEmail.disabled = true;
                btnUpdateEmail.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Atualizando...';

                fetch(`/ajax/update/${module}/email/${personId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({email})
                })
                    .then(res => res.ok ? res.json() : Promise.reject(res))
                    .then(data => {
                        if (data.success) {
                            emailFeedback.textContent = '✅ ' + data.message;
                            emailFeedback.className = 'text-success small mt-2';
                        } else {
                            emailFeedback.textContent = '❌ ' + (data.message || 'Erro desconhecido');
                            emailFeedback.className = 'text-danger small mt-2';
                        }
                    })
                    .catch(() => {
                        emailFeedback.textContent = '❌ Erro ao atualizar o e-mail.';
                        emailFeedback.className = 'text-danger small mt-2';
                    })
                    .finally(() => {
                        btnUpdateEmail.disabled = false;
                        btnUpdateEmail.innerHTML = 'Atualizar E-mail';
                    });
            });
        }

        // ✅ Verificação de e-mail duplicado (ativa em ambas as telas)
        emailInput?.addEventListener('blur', function () {
            const email = emailInput.value.trim();
            const currentEmail = '{{ $item->user?->email ?? '' }}';

            if (!email || !email.includes('@')) {
                emailFeedback.textContent = '';
                return;
            }

            if (email.toLowerCase() === currentEmail.toLowerCase()) {
                emailFeedback.textContent = '✅ E-mail atual.';
                emailFeedback.className = 'text-success small mt-2';
                return;
            }

            fetch(`/check-email?email=${encodeURIComponent(email)}&person_id=${personId}`)
                .then(res => res.json())
                .then(data => {
                    if (data.exists) {
                        emailFeedback.textContent = '⚠️ Este e-mail já está cadastrado.';
                        emailFeedback.className = 'text-warning small mt-2';
                    } else {
                        emailFeedback.textContent = '✅ E-mail disponível.';
                        emailFeedback.className = 'text-success small mt-2';
                    }
                })
                .catch(() => emailFeedback.textContent = '');
        });

        // ========== PASSWORD SECTION ==========
        const passwordInput = document.getElementById('password_input');
        const confirmPasswordInput = document.getElementById('confirm_password_input');
        const btnTogglePassword = document.getElementById('btn-toggle-password');
        const btnUpdatePassword = document.getElementById('btn-update-password');
        const passwordMessage = document.getElementById('passwordMessage');
        const confirmMessage = document.getElementById('confirmMessage');
        const passwordFeedback = document.getElementById('password-feedback');
        const passwordBars = document.querySelectorAll('#password-bars > div');

        const defaultMsg = 'Use 8 ou mais caracteres com letras, números, símbolos e ao menos uma maiúscula.';
        const defaultConfirmMsg = 'Repita a senha.';

        const isPasswordValid = p =>
            p.length >= 8 && /[A-Z]/.test(p) && /\d/.test(p) && /[\W_]/.test(p);

        const getStrength = p => Math.min(
            [p.length >= 8, p.length >= 12, /[a-z]/.test(p) && /[A-Z]/.test(p), /\d/.test(p), /[\W_]/.test(p)]
                .filter(Boolean).length, 4
        );

        const updateBars = p => {
            const s = getStrength(p);
            const valid = isPasswordValid(p);
            passwordBars.forEach((bar, i) => {
                bar.classList.toggle('bg-success', i < s && valid);
                bar.classList.toggle('bg-warning', i < s && !valid);
                if (i >= s) bar.classList.remove('bg-success', 'bg-warning');
            });
        };

        btnTogglePassword?.addEventListener('click', () => {
            const isPass = passwordInput.type === 'password';
            passwordInput.type = isPass ? 'text' : 'password';
            btnTogglePassword.querySelectorAll('i').forEach(i => i.classList.toggle('d-none'));
        });

        passwordInput?.addEventListener('input', e => {
            const v = e.target.value;
            updateBars(v);
            passwordMessage.textContent = !v ? defaultMsg :
                isPasswordValid(v) ? '✅ A senha atende aos requisitos.' : '❌ A senha ainda não atende.';
            passwordMessage.className = !v ? 'text-muted' :
                isPasswordValid(v) ? 'text-success' : 'text-danger';
            validateConfirm();
        });

        const validateConfirm = () => {
            const p = passwordInput.value;
            const c = confirmPasswordInput.value;
            confirmMessage.textContent = !c ? defaultConfirmMsg :
                (c !== p ? '❌ As senhas não conferem.' : '✅ As senhas conferem.');
            confirmMessage.className = !c ? 'text-muted mt-2' :
                (c !== p ? 'text-danger mt-2' : 'text-success mt-2');
        };

        confirmPasswordInput?.addEventListener('input', validateConfirm);

        if (btnUpdatePassword && personId) {
            btnUpdatePassword.addEventListener('click', () => {
                const p = passwordInput.value.trim();
                const c = confirmPasswordInput.value.trim();

                if (!p) return showFeedback('❌ Por favor, preencha a senha.');
                if (p !== c) return showFeedback('❌ As senhas não conferem.');
                if (!isPasswordValid(p)) return showFeedback('❌ A senha não atende aos requisitos.');

                btnUpdatePassword.disabled = true;
                btnUpdatePassword.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Atualizando...';

                fetch(`/ajax/update/${module}/password/${personId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({password: p})
                })
                    .then(res => res.ok ? res.json() : Promise.reject(res))
                    .then(data => {
                        if (data.success) {
                            showFeedback('✅ ' + data.message, true);
                            passwordInput.value = '';
                            confirmPasswordInput.value = '';
                            updateBars('');
                            validateConfirm();
                        } else {
                            showFeedback('❌ ' + (data.message || 'Erro desconhecido'));
                        }
                    })
                    .catch(() => showFeedback('❌ Erro ao atualizar senha.'))
                    .finally(() => {
                        btnUpdatePassword.disabled = false;
                        btnUpdatePassword.innerHTML = 'Atualizar Senha';
                    });

                function showFeedback(msg, success = false) {
                    passwordFeedback.textContent = msg;
                    passwordFeedback.className = (success ? 'text-success' : 'text-danger') + ' small mt-2';
                }
            });
        }
    });
</script>





<fieldset class="border border-gray-300 rounded-2 p-8 mb-5">
    <legend class="float-none w-auto px-3 fs-5 fw-bold text-gray-700">Planos:</legend>

    <div class="row gy-4">

        <!--begin::Interruptor Mensal/Anual-->
        <div class="mb-10 text-center">
            <button
                class="btn btn-color-gray-600 btn-active btn-active-secondary px-6 py-3 me-2
                {{ ($item->personPlan?->payment_cycle ?? 'month') === 'month' ? 'active' : '' }}"
                data-kt-plan="month">Mensal</button>

            <button
                class="btn btn-color-gray-600 btn-active btn-active-secondary px-6 py-3
                {{ ($item->personPlan?->payment_cycle ?? 'month') === 'annual' ? 'active' : '' }}"
                data-kt-plan="annual">Anual</button>
        </div>

        <!--begin::Planos-->
        <div class="d-flex flex-wrap justify-content-between gap-5">
            @foreach ($plans as $plan)
                @php
                    $currentPlan = strtolower($item->personPlan?->plan?->name ?? '');
                    $isActive = $currentPlan
                        ? $currentPlan === strtolower($plan->name)
                        : $loop->first;
                @endphp

                <label data-plan="{{ strtolower($plan->name) }}"
                       class="btn btn-outline btn-outline-dashed btn-active-light-primary flex-fill text-center p-6 {{ $isActive ? 'active' : '' }}">
                    <h2 class="fs-3 fw-bold mb-1">{{ $plan->name }}</h2>
                    <div>
                        <span class="fs-7 opacity-50 text-muted">R$</span>
                        <span class="fs-2x fw-bold text-primary"
                              data-kt-plan-price-month="{{ $plan->price_monthly }}"
                              data-kt-plan-price-annual="{{ $plan->price_yearly / 12 }}">
                              {{ number_format($plan->price_monthly, 0, ',', '.') }}
                        </span>
                        <span class="fs-7 opacity-50 text-muted"
                              data-kt-element="period">/Mês</span>
                    </div>
                </label>
            @endforeach
        </div>
        <!--end::Planos-->

        <input type="hidden" name="selected_period" id="selected_period"
               value="{{ $item->personPlan?->payment_cycle ?? 'month' }}">

        <input type="hidden" name="selected_plan" id="selected_plan"
               value="{{ strtolower($item->personPlan?->plan?->name ?? $plans->first()->name ?? '') }}">

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const buttons = document.querySelectorAll("[data-kt-plan]");
                const prices = document.querySelectorAll("[data-kt-plan-price-month]");
                const labels = document.querySelectorAll("[data-plan]");
                const inputPlan = document.getElementById("selected_plan");
                const inputPeriod = document.getElementById("selected_period");

                const currentPeriod = "{{ $item->personPlan?->payment_cycle ?? 'month' }}";
                const currentPlan = "{{ strtolower($item->personPlan?->plan?->name ?? $plans->first()->name ?? '') }}";

                const params = new URLSearchParams(window.location.search);
                const planFromUrl = params.get("plans");
                const periodFromUrl = params.get("period");

                function formatCurrency(value) {
                    const num = parseFloat(value.toString().replace(",", "."));
                    return num.toLocaleString("pt-BR", {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                }

                function setPeriod(period) {
                    buttons.forEach(b => b.classList.remove("active"));
                    const btn = document.querySelector(`[data-kt-plan="${period}"]`);
                    if (btn) btn.classList.add("active");

                    prices.forEach(span => {
                        const monthValue = parseFloat(span.dataset.ktPlanPriceMonth);
                        const annualValue = parseFloat(span.dataset.ktPlanPriceAnnual);
                        const label = span.closest("label");

                        let extraTop = label.querySelector(".plan-extra-top");
                        let extraBottom = label.querySelector(".plan-extra-bottom");
                        if (!extraTop) {
                            extraTop = document.createElement("div");
                            extraTop.className = "plan-extra-top text-muted small fw-semibold mb-1";
                            label.prepend(extraTop);
                        }
                        if (!extraBottom) {
                            extraBottom = document.createElement("div");
                            extraBottom.className = "plan-extra-bottom text-muted small mt-1";
                            label.append(extraBottom);
                        }

                        const periodEl = span.parentElement.querySelector("[data-kt-element='period']");

                        if (period === "annual") {
                            const total = annualValue * 12;
                            extraTop.innerHTML = `Em até <strong>12x</strong>`;
                            extraBottom.innerHTML =
                                `Total: <strong>R$ ${formatCurrency(total)}</strong> por ano.`;
                            span.textContent = formatCurrency(annualValue);
                            if (periodEl) periodEl.textContent = "/Mês";
                        } else {
                            extraTop.innerHTML = "";
                            extraBottom.innerHTML = "";
                            span.textContent = formatCurrency(monthValue);
                            if (periodEl) periodEl.textContent = "/Mês";
                        }
                    });

                    inputPeriod.value = period;
                }

                function setPlan(plan) {
                    labels.forEach(l => l.classList.remove("active"));
                    const match = document.querySelector(`[data-plan="${plan}"]`);
                    if (match) {
                        match.classList.add("active");
                        inputPlan.value = plan;
                    }
                }

                // Inicializa com dados do banco ou URL
                if (periodFromUrl) setPeriod(periodFromUrl);
                else setPeriod(currentPeriod);

                if (planFromUrl) setPlan(planFromUrl);
                else setPlan(currentPlan);

                // Clique em planos
                labels.forEach(label => {
                    label.addEventListener("click", () => {
                        labels.forEach(l => l.classList.remove("active"));
                        label.classList.add("active");
                        inputPlan.value = label.dataset.plan;
                    });
                });

                // Clique no interruptor Mensal/Anual
                buttons.forEach(btn => {
                    btn.addEventListener("click", e => {
                        e.preventDefault();
                        setPeriod(btn.getAttribute("data-kt-plan"));
                    });
                });
            });
        </script>
    </div>
</fieldset>



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

@include('admin.components.card-footer-submit')
