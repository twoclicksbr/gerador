@php
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

            zip.addEventListener('input', function (e) {
                let v = e.target.value.replace(/\D/g, '').slice(0, 8);
                v = v.replace(/(\d{5})(\d)/, '$1-$2');
                e.target.value = v;
            });

            zip.addEventListener('blur', function () {
                const cep = zip.value.replace(/\D/g, '');
                if (cep.length !== 8) return;

                fetch(`https://viacep.com.br/ws/${cep}/json/`)
                    .then(r => r.json())
                    .then(data => {
                        if (data.erro) return;
                        document.getElementById('street').value = data.logradouro || '';
                        document.getElementById('district').value = data.bairro || '';
                        document.getElementById('city').value = data.localidade || '';
                        document.getElementById('state').value = data.uf || '';
                    })
                    .catch(() => console.warn('Erro ao buscar CEP'));
            });
        });
    </script>
</fieldset>


<fieldset class="border border-gray-300 rounded-2 p-8 mb-5">
    <legend class="float-none w-auto px-3 fs-5 fw-bold text-gray-700">Acesso ao DevsAPI:</legend>

    <div class="row gy-4">
        {{-- 📧 Seção: Atualizar E-mail --}}
        <div class="col-md-4">
            <div class="fv-row mb-3">
                <label class="form-label required">E-mail:</label>
                <input type="email" id="email_input" class="form-control form-control-solid"
                       value="{{ old('email', $item->user?->email ?? '') }}" />
            </div>

            <div class="">
                <button type="button" class="btn btn-light-primary" id="btn-update-email">Atualizar E-mail</button>
                <div id="email-feedback" class="mt-2 small"></div>
            </div>
        </div>

        {{-- 🔐 Seção: Atualizar Senha --}}
        <div class="col-md-8">
            <div class="row gy-3">
                {{-- Nova Senha --}}
                <div class="col-md-6 fv-row" data-kt-password-meter="true">
                    <label class="form-label">Nova Senha:</label>
                    <div class="position-relative mb-3">
                        <input class="form-control form-control-solid" type="password"
                               placeholder="Em branco mantem senha atual" id="password_input" autocomplete="off" />
                        <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                              id="btn-toggle-password" style="cursor: pointer;">
                            <i class="ki-outline ki-eye-slash fs-2"></i>
                            <i class="ki-outline ki-eye fs-2 d-none"></i>
                        </span>
                    </div>

                    <div class="d-flex align-items-center mb-3" id="password-bars">
                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                    </div>

                    <div id="passwordMessage" class="text-muted">
                        Use 8 ou mais caracteres com uma mistura de letras, números, símbolos e ao menos uma letra maiúscula.
                    </div>
                </div>

                {{-- Confirmar Senha --}}
                <div class="col-md-6 fv-row">
                    <label class="form-label">Confirmar Senha:</label>
                    <input id="confirm_password_input" type="password"
                           class="form-control form-control-solid"
                           autocomplete="off" placeholder="Confirme a nova senha" />

                    <div id="confirmMessage" class="text-muted mt-2">
                        Repita a senha.
                    </div>
                </div>

                {{-- Botão em nova linha --}}
                <div class="col-12">
                    <button type="button" class="btn btn-light-primary" id="btn-update-password">Atualizar Senha</button>
                    <div id="password-feedback" class="mt-2 small"></div>
                </div>
            </div>
        </div>
    </div>
</fieldset>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const personId = "{{ $item->id }}";
        const module = "{{ $module }}";

        // ========== EMAIL SECTION ==========
        const emailInput = document.getElementById('email_input');
        const btnUpdateEmail = document.getElementById('btn-update-email');
        const emailFeedback = document.getElementById('email-feedback');

        btnUpdateEmail.addEventListener('click', function() {
            const email = emailInput.value.trim();

            if (!email) {
                emailFeedback.textContent = '❌ Por favor, preencha o e-mail.';
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
                body: JSON.stringify({ email })
            })
                .then(res => {
                    console.log('Response status:', res.status);
                    if (!res.ok) throw new Error(`HTTP ${res.status}`);
                    return res.json();
                })
                .then(data => {
                    console.log('Email update response:', data);
                    if (data.success) {
                        emailFeedback.textContent = '✅ ' + data.message;
                        emailFeedback.className = 'text-success small mt-2';
                    } else {
                        emailFeedback.textContent = '❌ ' + (data.message || 'Erro desconhecido');
                        emailFeedback.className = 'text-danger small mt-2';
                    }
                })
                .catch(err => {
                    console.error('Email update error:', err);
                    emailFeedback.textContent = '❌ ' + err.message;
                    emailFeedback.className = 'text-danger small mt-2';
                })
                .finally(() => {
                    btnUpdateEmail.disabled = false;
                    btnUpdateEmail.innerHTML = 'Atualizar E-mail';
                });
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

        const defaultMsg = 'Use 8 ou mais caracteres com uma mistura de letras, números, símbolos e ao menos uma letra maiúscula.';
        const defaultConfirmMsg = 'Repita a senha.';

        function isPasswordValid(password) {
            const hasMinLength = password.length >= 8;
            const hasUpperCase = /[A-Z]/.test(password);
            const hasNumbers = /\d/.test(password);
            const hasSymbols = /[\W_]/.test(password);
            return hasMinLength && hasUpperCase && hasNumbers && hasSymbols;
        }

        function getPasswordStrength(password) {
            if (!password) return 0;
            let strength = 0;
            if (password.length >= 8) strength++;
            if (password.length >= 12) strength++;
            if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
            if (/\d/.test(password)) strength++;
            if (/[\W_]/.test(password)) strength++;
            return Math.min(strength, 4);
        }

        function updatePasswordBars(password) {
            const strength = getPasswordStrength(password);
            const isValid = isPasswordValid(password);

            passwordBars.forEach((bar, index) => {
                if (index < strength) {
                    if (isValid) {
                        bar.classList.add('bg-success');
                        bar.classList.remove('bg-warning');
                    } else {
                        bar.classList.add('bg-warning');
                        bar.classList.remove('bg-success');
                    }
                } else {
                    bar.classList.remove('bg-success', 'bg-warning');
                }
            });
        }

        btnTogglePassword.addEventListener('click', function(e) {
            e.preventDefault();
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            btnTogglePassword.querySelectorAll('i').forEach(icon => icon.classList.toggle('d-none'));
        });

        passwordInput.addEventListener('input', function() {
            const value = passwordInput.value;
            updatePasswordBars(value);

            if (!value) {
                passwordMessage.textContent = defaultMsg;
                passwordMessage.className = 'text-muted';
            } else if (!isPasswordValid(value)) {
                passwordMessage.textContent = '❌ A senha ainda não atende aos requisitos.';
                passwordMessage.className = 'text-danger';
            } else {
                passwordMessage.textContent = '✅ A senha atende a todos os requisitos.';
                passwordMessage.className = 'text-success';
            }

            validateConfirm();
        });

        function validateConfirm() {
            const pass = passwordInput.value;
            const conf = confirmPasswordInput.value;

            if (!conf) {
                confirmMessage.textContent = defaultConfirmMsg;
                confirmMessage.className = 'text-muted mt-2';
            } else if (conf !== pass) {
                confirmMessage.textContent = '❌ As senhas não conferem.';
                confirmMessage.className = 'text-danger mt-2';
            } else {
                confirmMessage.textContent = '✅ As senhas conferem.';
                confirmMessage.className = 'text-success mt-2';
            }
        }

        confirmPasswordInput.addEventListener('input', validateConfirm);

        btnUpdatePassword.addEventListener('click', function() {
            const password = passwordInput.value.trim();
            const confirmPassword = confirmPasswordInput.value.trim();

            if (!password) {
                passwordFeedback.textContent = '❌ Por favor, preencha a senha.';
                passwordFeedback.className = 'text-danger small mt-2';
                return;
            }

            if (password !== confirmPassword) {
                passwordFeedback.textContent = '❌ As senhas não conferem.';
                passwordFeedback.className = 'text-danger small mt-2';
                return;
            }

            if (!isPasswordValid(password)) {
                passwordFeedback.textContent = '❌ A senha não atende aos requisitos.';
                passwordFeedback.className = 'text-danger small mt-2';
                return;
            }

            btnUpdatePassword.disabled = true;
            btnUpdatePassword.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Atualizando...';

            fetch(`/ajax/update/${module}/password/${personId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({ password })
            })
                .then(res => {
                    console.log('Response status:', res.status);
                    if (!res.ok) throw new Error(`HTTP ${res.status}`);
                    return res.json();
                })
                .then(data => {
                    console.log('Password update response:', data);
                    if (data.success) {
                        passwordFeedback.textContent = '✅ ' + data.message;
                        passwordFeedback.className = 'text-success small mt-2';
                        passwordInput.value = '';
                        confirmPasswordInput.value = '';
                        updatePasswordBars('');
                        validateConfirm();
                    } else {
                        passwordFeedback.textContent = '❌ ' + (data.message || 'Erro desconhecido');
                        passwordFeedback.className = 'text-danger small mt-2';
                    }
                })
                .catch(err => {
                    console.error('Password update error:', err);
                    passwordFeedback.textContent = '❌ ' + err.message;
                    passwordFeedback.className = 'text-danger small mt-2';
                })
                .finally(() => {
                    btnUpdatePassword.disabled = false;
                    btnUpdatePassword.innerHTML = 'Atualizar Senha';
                });
        });
    });
</script>

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
