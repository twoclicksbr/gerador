@extends('layouts.app')

@section('title', 'Funcionalidades - DevsAPI')
@section('page-title', 'features')

@section('content')

    <div class="wrapper d-flex flex-column flex-row-fluid mt-5 mt-lg-10" id="kt_wrapper">
        <div class="content flex-column-fluid" id="kt_content">
            <div class="toolbar d-flex flex-stack flex-wrap mb-5 mb-lg-7" id="kt_toolbar">
                <div class="page-title d-flex flex-column py-1">

                    <h1 class="d-flex align-items-center my-1">
                        <span class="text-gray-900 fw-bold fs-1">Funcionalidades</span>
                    </h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('home') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-200 w-5px h-2px"></span>
                        </li>

                        <li class="breadcrumb-item text-gray-900">Funcionalidades</li>
                    </ul>
                </div>

            </div>
            <div class="post" id="kt_post">
                <div class="card">
                    <div class="card-body p-lg-17">
                        <div class="position-relative mb-17">
                            <div class="overlay overlay-show">
                                <div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-250px"
                                    style="background-image:url('assets/media/stock/1600x800/img-1.jpg')"></div>
                                <div class="overlay-layer rounded bg-black" style="opacity: 0.4"></div>
                            </div>
                            <div class="position-absolute text-white mb-8 ms-10 bottom-0">
                                <h3 class="text-white fs-2qx fw-bold mb-3 m">Careers at KeenThemes</h3>
                                <div class="fs-5 fw-semibold">You sit down. You stare at your screen. The cursor blinks.
                                </div>
                            </div>
                        </div>
                        <div class="position-relative mb-17">
                            <div class="overlay overlay-show">
                                <form action="m-0" class="form mb-15" method="post" id="kt_careers_form">

                                    <label class="fs-5 fw-semibold mt-10 mb-2">Planos</label>
                                    <div class="separator mb-8"></div>

                                    <!--begin::Interruptor Mensal/Anual-->
                                    <div class=" mb-10">
                                        <button
                                            class="btn btn-color-gray-600 btn-active btn-active-secondary px-6 py-3 me-2 active"
                                            data-kt-plan="month">Mensal</button>
                                        <button class="btn btn-color-gray-600 btn-active btn-active-secondary px-6 py-3"
                                            data-kt-plan="annual">Anual</button>
                                    </div>

                                    <!--begin::Planos-->
                                    <div class="d-flex flex-wrap justify-content-between gap-5">
                                        <label data-plan="starter"
                                            class="btn btn-outline btn-outline-dashed btn-active-light-primary flex-fill text-center p-6 active">
                                            <h2 class="fs-3 fw-bold mb-1">Starter</h2>
                                            <div>
                                                <span class="fs-7 opacity-50 text-muted" data-kt-element="">R$</span>
                                                <span class="fs-2x fw-bold text-primary" data-kt-plan-price-month="297"
                                                    data-kt-plan-price-annual="247">297</span>
                                                <span class="fs-7 opacity-50 text-muted"
                                                    data-kt-element="period">/Mês</span>
                                            </div>
                                        </label>

                                        <label data-plan="builder"
                                            class="btn btn-outline btn-outline-dashed btn-active-light-primary flex-fill text-center p-6">
                                            <h2 class="fs-3 fw-bold mb-1">Builder</h2>
                                            <div>
                                                <span class="fs-7 opacity-50 text-muted" data-kt-element="">R$</span>
                                                <span class="fs-2x fw-bold text-primary" data-kt-plan-price-month="597"
                                                    data-kt-plan-price-annual="497">597</span>
                                                <span class="fs-7 opacity-50 text-muted"
                                                    data-kt-element="period">/Mês</span>
                                            </div>
                                        </label>

                                        <label data-plan="infinity"
                                            class="btn btn-outline btn-outline-dashed btn-active-light-primary flex-fill text-center p-6">
                                            <h2 class="fs-3 fw-bold mb-1">Infinity</h2>
                                            <div>
                                                <span class="fs-7 opacity-50 text-muted" data-kt-element="">R$</span>
                                                <span class="fs-2x fw-bold text-primary" data-kt-plan-price-month="897"
                                                    data-kt-plan-price-annual="747">897</span>
                                                <span class="fs-7 opacity-50 text-muted"
                                                    data-kt-element="period">/Mês</span>
                                            </div>
                                        </label>
                                    </div>
                                    <!--end::Planos-->

                                    <input type="hidden" name="selected_period" id="selected_period" value="month">
                                    <input type="hidden" name="selected_plan" id="selected_plan" value="starter">

                                    <script>
                                        document.addEventListener("DOMContentLoaded", () => {
                                            const buttons = document.querySelectorAll("[data-kt-plan]");
                                            const prices = document.querySelectorAll("[data-kt-plan-price-month]");
                                            const labels = document.querySelectorAll("[data-plan]");
                                            const inputPlan = document.getElementById("selected_plan");
                                            const inputPeriod = document.getElementById("selected_period");

                                            const params = new URLSearchParams(window.location.search);
                                            const planFromUrl = params.get("plans");
                                            const periodFromUrl = params.get("period");

                                            function formatCurrency(value) {
                                                const num = parseFloat(value.toString().replace(",", "."));
                                                return num.toLocaleString("pt-BR", {
                                                    minimumFractionDigits: 0
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
                                                    const priceWrapper = span.parentElement;

                                                    // cria container de extras se não existir
                                                    let extraTop = label.querySelector(".plan-extra-top");
                                                    let extraBottom = label.querySelector(".plan-extra-bottom");
                                                    if (!extraTop) {
                                                        extraTop = document.createElement("div");
                                                        extraTop.className = "plan-extra-top text-muted small fw-semibold mb-1";
                                                        priceWrapper.before(extraTop);
                                                    }
                                                    if (!extraBottom) {
                                                        extraBottom = document.createElement("div");
                                                        extraBottom.className = "plan-extra-bottom text-muted small mt-1";
                                                        priceWrapper.after(extraBottom);
                                                    }

                                                    const periodEl = span.parentElement.querySelector("[data-kt-element='period']");

                                                    if (period === "annual") {
                                                        const total = annualValue * 12;
                                                        extraTop.innerHTML = `Em até <strong>12x</strong>`;
                                                        extraBottom.innerHTML = `Total: <strong>R$ ${formatCurrency(total)}</strong>`;
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

                                            if (periodFromUrl) setPeriod(periodFromUrl);
                                            if (planFromUrl) setPlan(planFromUrl);

                                            labels.forEach(label => {
                                                label.addEventListener("click", () => {
                                                    labels.forEach(l => l.classList.remove("active"));
                                                    label.classList.add("active");
                                                    inputPlan.value = label.dataset.plan;
                                                });
                                            });

                                            buttons.forEach(btn => {
                                                btn.addEventListener("click", e => {
                                                    e.preventDefault();
                                                    setPeriod(btn.getAttribute("data-kt-plan"));
                                                });
                                            });
                                        });
                                    </script>


                                    <label class="fs-5 fw-semibold mt-10 mb-2">Acesso ao <strong>DevsAPI</strong></label>
                                    <div class="separator mb-8"></div>
                                    <div class="row mb-5 gy-3">
                                        <div class="col-12 col-md-12 fv-row">
                                            <label class="required fs-5 fw-semibold mb-2">E-mail:</label>
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                name="email" />
                                        </div>

                                        <div class="col-12 col-md-6 fv-row" data-kt-password-meter="true">
                                            <div class="position-relative mb-3">
                                                <label class="required fs-5 fw-semibold mb-2">Senha:</label>
                                                <input id="password" class="form-control form-control-solid"
                                                    type="password" placeholder="Senha" name="password"
                                                    autocomplete="off" />

                                                <span
                                                    class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                                    data-kt-password-meter-control="visibility">
                                                    <i class="ki-duotone ki-eye-slash fs-2"></i>
                                                    <i class="ki-duotone ki-eye fs-2 d-none"></i>
                                                </span>
                                            </div>

                                            <div class="d-flex align-items-center mb-3"
                                                data-kt-password-meter-control="highlight">
                                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                                </div>
                                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                                </div>
                                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                                </div>
                                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px">
                                                </div>
                                            </div>

                                            <div id="passwordMessage" class="text-muted">
                                                Use 8 ou mais caracteres com uma mistura de letras, números, símbolos e ao
                                                menos uma letra maiúscula.
                                            </div>
                                        </div>

                                        <script>
                                            const passwordInput = document.getElementById('password');
                                            const passwordMessage = document.getElementById('passwordMessage');
                                            const regex = /^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;

                                            const defaultMsg =
                                                'Use 8 ou mais caracteres com uma mistura de letras, números, símbolos e ao menos uma letra maiúscula.';

                                            passwordInput.addEventListener('input', function() {
                                                const value = passwordInput.value.trim();

                                                if (!value) {
                                                    passwordMessage.textContent = defaultMsg;
                                                    passwordMessage.className = 'text-muted';
                                                    return;
                                                }

                                                if (!regex.test(value)) {
                                                    passwordMessage.textContent = '❌ A senha ainda não atende aos requisitos.';
                                                    passwordMessage.className = 'text-danger';
                                                } else {
                                                    passwordMessage.textContent = '✅ A senha atende a todos os requisitos.';
                                                    passwordMessage.className = 'text-success';
                                                }
                                            });
                                        </script>

                                        <div class="col-12 col-md-6 fv-row">
                                            <label class="required fs-5 fw-semibold mb-2">Confirmar senha:</label>
                                            <input id="confirm_password" type="password"
                                                class="form-control form-control-solid" name="confirm_password"
                                                autocomplete="off" />

                                            <div id="confirmMessage" class="text-muted mt-1">
                                                Repita a senha.
                                            </div>
                                        </div>

                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                const passwordInput = document.querySelector('input[name="password"]');
                                                const confirmInput = document.getElementById('confirm_password');
                                                const confirmMessage = document.getElementById('confirmMessage');
                                                const defaultMsg = 'Repita a senha.';

                                                function validateConfirm() {
                                                    const pass = passwordInput.value.trim();
                                                    const conf = confirmInput.value.trim();

                                                    if (!conf) {
                                                        confirmMessage.textContent = defaultMsg;
                                                        confirmMessage.className = 'text-muted mt-1';
                                                        return;
                                                    }

                                                    if (conf !== pass) {
                                                        confirmMessage.textContent = '❌ As senhas não conferem.';
                                                        confirmMessage.className = 'text-danger mt-1';
                                                    } else {
                                                        confirmMessage.textContent = '✅ As senhas conferem.';
                                                        confirmMessage.className = 'text-success mt-1';
                                                    }
                                                }

                                                // verifica sempre que digita em qualquer um dos dois campos
                                                confirmInput.addEventListener('input', validateConfirm);
                                                passwordInput.addEventListener('input', validateConfirm);
                                            });
                                        </script>
                                    </div>

                                    <label class="fs-5 fw-semibold mt-10 mb-2">Dados Pessoais</label>
                                    <div class="separator mb-8"></div>
                                    <div class="row mb-5 gy-3">
                                        <div class="col-12 col-md-8 fv-row">
                                            <label class="required fs-5 fw-semibold mb-2">Nome:</label>
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="Nome Completo" name="name" />
                                        </div>

                                        <div class="col-12 col-md-4 fv-row">
                                            <label class="required fs-5 fw-semibold mb-2">Nascimento:</label>
                                            <input type="date" class="form-control form-control-solid"
                                                placeholder="Nome Completo" name="name" />
                                        </div>

                                    </div>

                                    <div class="row mb-5 gy-3">

                                        <div class="col-12 col-md-6 fv-row">
                                            <label class="required fs-5 fw-semibold mb-2">WhatsApp:</label>
                                            <div class="d-flex gap-3 align-items-center">
                                                <div class="flex-shrink-0" style="width: 160px;">
                                                    <select class="form-select form-select-solid" data-control="select2"
                                                        data-placeholder="Selecione" id="kt_select_country_code">
                                                        <option></option>
                                                        <option value="+55"
                                                            data-kt-select2-country="{{ asset('assets/media/flags/brazil.svg') }}"
                                                            selected>Brasil (+55)</option>
                                                        <option value="+54"
                                                            data-kt-select2-country="{{ asset('assets/media/flags/argentina.svg') }}">
                                                            Argentina (+54)</option>
                                                        <option value="+591"
                                                            data-kt-select2-country="{{ asset('assets/media/flags/bolivia.svg') }}">
                                                            Bolívia (+591)</option>
                                                        <option value="+56"
                                                            data-kt-select2-country="{{ asset('assets/media/flags/chile.svg') }}">
                                                            Chile
                                                            (+56)</option>
                                                        <option value="+57"
                                                            data-kt-select2-country="{{ asset('assets/media/flags/colombia.svg') }}">
                                                            Colômbia (+57)</option>
                                                        <option value="+593"
                                                            data-kt-select2-country="{{ asset('assets/media/flags/ecuador.svg') }}">
                                                            Equador (+593)</option>
                                                        <option value="+592"
                                                            data-kt-select2-country="{{ asset('assets/media/flags/guyana.svg') }}">
                                                            Guiana
                                                            (+592)</option>
                                                        <option value="+595"
                                                            data-kt-select2-country="{{ asset('assets/media/flags/paraguay.svg') }}">
                                                            Paraguai (+595)</option>
                                                        <option value="+51"
                                                            data-kt-select2-country="{{ asset('assets/media/flags/peru.svg') }}">
                                                            Peru
                                                            (+51)</option>
                                                        <option value="+597"
                                                            data-kt-select2-country="{{ asset('assets/media/flags/suriname.svg') }}">
                                                            Suriname (+597)</option>
                                                        <option value="+58"
                                                            data-kt-select2-country="{{ asset('assets/media/flags/venezuela.svg') }}">
                                                            Venezuela (+58)</option>
                                                        <option value="+598"
                                                            data-kt-select2-country="{{ asset('assets/media/flags/uruguay.svg') }}">
                                                            Uruguai (+598)</option>
                                                        <!-- Extras mantidos -->
                                                        <option value="+1"
                                                            data-kt-select2-country="{{ asset('assets/media/flags/united-states.svg') }}">
                                                            EUA (+1)</option>
                                                        <option value="+44"
                                                            data-kt-select2-country="{{ asset('assets/media/flags/united-kingdom.svg') }}">
                                                            Reino Unido (+44)</option>
                                                        <option value="+351"
                                                            data-kt-select2-country="{{ asset('assets/media/flags/portugal.svg') }}">
                                                            Portugal (+351)</option>
                                                    </select>
                                                    {{-- <label for="kt_select_country_code">País</label> --}}
                                                </div>

                                                <input type="text" class="form-control form-control-solid flex-grow-1"
                                                    placeholder="Número do WhatsApp" name="whatsapp_number" />
                                            </div>
                                        </div>

                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                const optionFormat = (item) => {
                                                    if (!item.id) return item.text;
                                                    const imgUrl = item.element.getAttribute('data-kt-select2-country');
                                                    return $(
                                                        `<span><img src="${imgUrl}" class="rounded-circle h-20px me-2" alt="flag"/>${item.text}</span>`
                                                    );
                                                };

                                                $('#kt_select_country_code').select2({
                                                    templateSelection: optionFormat,
                                                    templateResult: optionFormat,
                                                    minimumResultsForSearch: Infinity,
                                                    dropdownParent: $('#kt_select_country_code').closest('.fv-row')
                                                });
                                            });
                                        </script>



                                        <div class="col-12 col-md-3 fv-row">
                                            <label class="required fs-5 fw-semibold mb-2">CPF:</label>
                                            <input id="cpf" type="text" class="form-control form-control-solid"
                                                placeholder="CPF" name="cpf" inputmode="numeric" maxlength="14" />

                                            <script>
                                                const cpfInput = document.getElementById('cpf');

                                                cpfInput.addEventListener('input', function(e) {
                                                    // remove tudo que não for dígito e limita a 11 dígitos
                                                    let v = e.target.value.replace(/\D/g, '').slice(0, 11);

                                                    // aplica as quebras: 000.000.000-00
                                                    v = v.replace(/(\d{3})(\d)/, '$1.$2');
                                                    v = v.replace(/(\d{3})(\d)/, '$1.$2');
                                                    v = v.replace(/(\d{3})(\d{1,2})$/, '$1-$2');

                                                    e.target.value = v;
                                                });

                                                // se quiser o valor "limpo" (apenas dígitos) antes de enviar:
                                                function getCpfOnlyDigits() {
                                                    return cpfInput.value.replace(/\D/g, '');
                                                }
                                            </script>
                                        </div>

                                        <div class="col-md-3 fv-row">
                                            <label class="required fs-5 fw-semibold mb-2">Gênero:</label>
                                            <select class="form-control form-control-solid" name="gender"
                                                data-control="select2">
                                                <option value="-">Selecione</option>
                                                <option value="masculino">Masculino</option>
                                                <option value="feminimo">Feminimo</option>
                                            </select>
                                        </div>

                                    </div>

                                    <label class="fs-5 fw-semibold mt-10 mb-2">Endereço</label>
                                    <div class="separator mb-8"></div>
                                    <div class="row gy-3">
                                        <div class="col-md-2">
                                            <label class="form-label required">CEP:</label>
                                            <input type="text" id="zip_code" name="zip_code"
                                                class="required form-control form-control-solid"
                                                placeholder="Digite o CEP" maxlength="9" />
                                        </div>

                                        <div class="col-md-8">
                                            <label class="form-label required">Rua:</label>
                                            <input type="text" id="street" name="street"
                                                class="required form-control form-control-solid"
                                                placeholder="Nome da rua" />
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label required">Número:</label>
                                            <input type="text" id="number" name="number"
                                                class="required form-control form-control-solid" placeholder="Número" />
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Complemento:</label>
                                            <input type="text" id="complement" name="complement"
                                                class="form-control form-control-solid"
                                                placeholder="Complemento (opcional)" />
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label required">Bairro:</label>
                                            <input type="text" id="district" name="district"
                                                class="required form-control form-control-solid" placeholder="Bairro" />
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label required">Cidade:</label>
                                            <input type="text" id="city" name="city"
                                                class="required form-control form-control-solid" placeholder="Cidade" />
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label required">Estado:</label>
                                            <input type="text" id="state" name="state"
                                                class="required form-control form-control-solid" placeholder="UF"
                                                maxlength="2" />
                                        </div>


                                    </div>

                                    <script>
                                        const zip = document.getElementById('zip_code');

                                        zip.addEventListener('input', function(e) {
                                            let v = e.target.value.replace(/\D/g, '').slice(0, 8);
                                            v = v.replace(/(\d{5})(\d)/, '$1-$2');
                                            e.target.value = v;
                                        });

                                        zip.addEventListener('blur', function() {
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
                                    </script>

                                    <div class="separator mt-10 mb-8"></div>
                                    <button type="submit" class="btn btn-primary" id="kt_careers_submit_button">
                                        <span class="indicator-label">Apply Now</span>
                                        <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>

                                    <script>
                                        document.addEventListener("DOMContentLoaded", () => {
                                            const btnSubmit = document.getElementById("kt_careers_submit_button");
                                            const spanLabel = btnSubmit.querySelector(".indicator-label");
                                            const inputPlan = document.getElementById("selected_plan");
                                            const inputPeriod = document.getElementById("selected_period");
                                            const planButtons = document.querySelectorAll("[data-plan]");
                                            const periodButtons = document.querySelectorAll("[data-kt-plan]");

                                            // Função: capitaliza a primeira letra
                                            const capitalize = str => str.charAt(0).toUpperCase() + str.slice(1);

                                            // Função: atualiza texto do botão
                                            function updateButtonLabel() {
                                                const plan = inputPlan.value?.trim() || "Starter";
                                                const period = inputPeriod.value?.trim() === "annual" ? "Anual" : "Mensal";
                                                spanLabel.textContent = `Criar conta no plano ${capitalize(plan)} - ${period}`;
                                            }

                                            // --- Eventos dos botões de plano ---
                                            planButtons.forEach(label => {
                                                label.addEventListener("click", () => {
                                                    planButtons.forEach(l => l.classList.remove("active"));
                                                    label.classList.add("active");
                                                    inputPlan.value = label.dataset.plan;
                                                    updateButtonLabel();
                                                });
                                            });

                                            // --- Eventos dos botões Mensal/Anual ---
                                            periodButtons.forEach(btn => {
                                                btn.addEventListener("click", e => {
                                                    e.preventDefault();
                                                    periodButtons.forEach(b => b.classList.remove("active"));
                                                    btn.classList.add("active");
                                                    inputPeriod.value = btn.dataset.ktPlan;
                                                    updateButtonLabel();
                                                });
                                            });

                                            // --- Inicialização via URL ---
                                            const params = new URLSearchParams(window.location.search);
                                            const planFromUrl = params.get("plans");
                                            const periodFromUrl = params.get("period");

                                            if (planFromUrl) inputPlan.value = planFromUrl;
                                            if (periodFromUrl) inputPeriod.value = periodFromUrl;
                                            updateButtonLabel();
                                        });
                                    </script>


                                </form>

                            </div>

                        </div>

                        @include('layouts.components.social')

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
