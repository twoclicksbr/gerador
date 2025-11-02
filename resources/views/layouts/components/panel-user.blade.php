@if (session('auth_user'))
    <div class="d-flex align-items-center ms-lg-5" id="kt_header_user_menu_toggle">
        <div class="btn btn-active-light d-flex align-items-center bg-hover-light py-2 px-2 px-md-3"
            data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
            data-kt-menu-placement="bottom-end">
            <div class="d-none d-md-flex flex-column align-items-end justify-content-center me-2">
                @php
                    $hour = now()->format('H');
                    if ($hour < 12) {
                        $greeting = 'Bom dia!';
                    } elseif ($hour < 18) {
                        $greeting = 'Boa tarde!';
                    } else {
                        $greeting = 'Boa noite!';
                    }

                    $name = session('auth_person.name') ?? '';
                    $firstNames = implode(' ', array_slice(explode(' ', $name), 0, 2));
                @endphp

                <span class="text-muted fs-7 fw-semibold lh-1 mb-2">{{ $greeting }}</span>

                <span class="text-gray-900 fs-base fw-bold lh-1">{{ $firstNames }}</span>
            </div>
            {{-- <div class="symbol symbol-30px symbol-md-40px ms-2">
                <img src="{{ asset('assets/media/avatars/300-1.jpg') }}" alt="image" />
            </div> --}}
        </div>
        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-250px"
            data-kt-menu="true">
            <div class="menu-item px-3">
                <div class="menu-content d-flex align-items-center px-3">
                    {{-- <div class="symbol symbol-50px me-5">
                        <img alt="Logo" src="{{ asset('assets/media/avatars/300-1.jpg') }}" />
                    </div> --}}
                    <div class="d-flex flex-column">
                        <div class="fw-bold d-flex align-items-center fs-5">
                            {{ $firstNames }}

                        </div>

                        <div class="fw-bold d-flex align-items-center fs-5">
                            <span class="text-success fw-bold fs-8 ">
                                {{ session('auth_credential.plan.name') ?? 'Sem plano' }} - ({{ session('auth_credential.plan.payment_cycle') ?? 'Mensal' }})

                            </span>
                        </div>
                        <a href="mailto:{{ session('auth_user.email') }}"
                            class="fw-semibold text-muted text-hover-primary fs-7">
                            {{ session('auth_user.email') }}
                        </a>
                    </div>


                </div>
            </div>
            <div class="separator my-2"></div>
            <div class="menu-item px-5">
                <a href="account/overview.html" class="menu-link px-5">My Profile</a>
            </div>
            <div class="menu-item px-5">
                <a href="apps/projects/list.html" class="menu-link px-5">
                    <span class="menu-text">My Projects</span>
                    <span class="menu-badge">
                        <span class="badge badge-light-danger badge-circle fw-bold fs-7">3</span>
                    </span>
                </a>
            </div>
            <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
                <a href="#" class="menu-link px-5">
                    <span class="menu-title">My Subscription</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                    <div class="menu-item px-3">
                        <a href="account/referrals.html" class="menu-link px-5">Referrals</a>
                    </div>
                    <div class="menu-item px-3">
                        <a href="account/billing.html" class="menu-link px-5">Billing</a>
                    </div>
                    <div class="menu-item px-3">
                        <a href="account/statements.html" class="menu-link px-5">Payments</a>
                    </div>
                    <div class="menu-item px-3">
                        <a href="account/statements.html" class="menu-link d-flex flex-stack px-5">Statements
                            <span class="ms-2 lh-0" data-bs-toggle="tooltip" title="View your statements">
                                <i class="ki-duotone ki-information-5 fs-5">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span></a>
                    </div>
                    <div class="separator my-2"></div>
                    <div class="menu-item px-3">
                        <div class="menu-content px-3">
                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input w-30px h-20px" type="checkbox" value="1"
                                    checked="checked" name="notifications" />
                                <span class="form-check-label text-muted fs-7">Notifications</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="menu-item px-5">
                <a href="account/statements.html" class="menu-link px-5">My Statements</a>
            </div>
            <div class="separator my-2"></div>
            <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
                <a href="#" class="menu-link px-5">
                    <span class="menu-title position-relative">Language
                        <span
                            class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">English
                            <img class="w-15px h-15px rounded-1 ms-2"
                                src="{{ asset('assets/media/flags/united-states.svg') }}"
                                alt="" /></span></span>
                </a>
                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                    <div class="menu-item px-3">
                        <a href="account/settings.html" class="menu-link d-flex px-5 active">
                            <span class="symbol symbol-20px me-4">
                                <img class="rounded-1" src="{{ asset('assets/media/flags/united-states.svg') }}"
                                    alt="" />
                            </span>English</a>
                    </div>
                    <div class="menu-item px-3">
                        <a href="account/settings.html" class="menu-link d-flex px-5">
                            <span class="symbol symbol-20px me-4">
                                <img class="rounded-1" src="{{ asset('assets/media/flags/spain.svg') }}"
                                    alt="" />
                            </span>Spanish</a>
                    </div>
                    <div class="menu-item px-3">
                        <a href="account/settings.html" class="menu-link d-flex px-5">
                            <span class="symbol symbol-20px me-4">
                                <img class="rounded-1" src="{{ asset('assets/media/flags/germany.svg') }}"
                                    alt="" />
                            </span>German</a>
                    </div>
                    <div class="menu-item px-3">
                        <a href="account/settings.html" class="menu-link d-flex px-5">
                            <span class="symbol symbol-20px me-4">
                                <img class="rounded-1" src="{{ asset('assets/media/flags/japan.svg') }}"
                                    alt="" />
                            </span>Japanese</a>
                    </div>
                    <div class="menu-item px-3">
                        <a href="account/settings.html" class="menu-link d-flex px-5">
                            <span class="symbol symbol-20px me-4">
                                <img class="rounded-1" src="{{ asset('assets/media/flags/france.svg') }}"
                                    alt="" />
                            </span>French</a>
                    </div>
                </div>
            </div>
            <div class="menu-item px-5 my-1">
                <a href="account/settings.html" class="menu-link px-5">Account Settings</a>
            </div>
            <div class="menu-item px-5">
                <a href="{{ route('logout') }}" class="menu-link px-5">
                    Sair
                </a>
            </div>
        </div>
    </div>
@else
    {{-- 🔹 Usuário não logado --}}
    <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start"
        class="menu-item me-0 me-lg-2 align-items-center d-flex ms-5">

        <a href="{{ route('login') }}" class="menu-link py-3 px-4 btn btn-light-primary fw-bold">
            <i class="ki-solid ki-entrance-left fs-2"></i>
            Entrar
        </a>
    </div>
@endif
