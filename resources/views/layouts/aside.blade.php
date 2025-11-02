<div id="kt_aside" class="aside" data-kt-drawer="true" data-kt-drawer-name="aside"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
    data-kt-drawer-width="{default:'200px', '300px': '225px'}" data-kt-drawer-direction="start"
    data-kt-drawer-toggle="#kt_aside_toggle" data-kt-sticky="true" data-kt-sticky-name="aside-sticky"
    data-kt-sticky-offset="{default: false, lg: '1px'}" data-kt-sticky-width="{lg: '225px'}" data-kt-sticky-left="auto"
    data-kt-sticky-top="94px" data-kt-sticky-animation="false" data-kt-sticky-zindex="95">

    <div class="hover-scroll-overlay-y my-5 my-lg-5 w-100 ps-4 ps-lg-0 pe-4 me-1" id="kt_aside_menu_wrapper"
        style="max-height: 90vh; overflow-y: auto;" data-kt-scroll="true"
        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-dependencies="#kt_header"
        data-kt-scroll-wrappers="#kt_aside" data-kt-scroll-offset="5px">

        <div class="menu menu-column menu-active-bg menu-hover-bg menu-title-gray-700 fs-6 menu-rounded w-100"
            id="#kt_aside_menu" data-kt-menu="true">

            @if (session('auth_credential.id') == 1)
                <div class="mb-5">
                    <div class="menu-item">
                        <div class="menu-content pb-2">
                            <span class="menu-section text-muted text-uppercase fs-7 fw-bold">Administração</span>
                        </div>
                    </div>
                    <div class="menu-item">
                        <a href="{{ route('admin.overview') }}"
                            class="menu-link {{ request()->routeIs('admin.overview') ? 'active' : '' }}">
                            <span class="menu-title">Visão Geral</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a href="{{ route('admin.module.index', ['module' => 'credential']) }}"
                            class="menu-link {{ request()->is('admin/credential*') ? 'active' : '' }}">
                            <span class="menu-title">Credenciais</span>
                            <span class="badge badge-light-primary">
                                {{ number_format(\App\Models\Api\Credential::count(), 0, ',', '.') }}
                            </span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a href="{{ route('admin.module.index', ['module' => 'person']) }}"
                            class="menu-link {{ request()->is('admin/person*') ? 'active' : '' }}">
                            <span class="menu-title">Pessoas</span>
                            <span class="badge badge-light-primary">
                                {{ number_format(\App\Models\Api\Person::count(), 0, ',', '.') }}
                            </span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a href="" class="menu-link">
                            <span class="menu-title">Tags</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="" class="menu-link">
                            <span class="menu-title">Ask Question</span>
                        </a>
                    </div>
                </div>
            @endif



            <div class="mb-5">
                <div class="menu-item">
                    <div class="menu-content pb-2">
                        <span class="menu-section text-muted text-uppercase fs-7 fw-bold">Public</span>
                    </div>
                </div>
                <div class="menu-item">
                    <a href="{{ route('panel.overview') }}"
                        class="menu-link {{ request()->routeIs('panel.overview') ? 'active' : '' }}">
                        <span class="menu-title">Visão Geral</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="apps/devs/search.html" class="menu-link">
                        <span class="menu-title">Search</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="apps/devs/tag.html" class="menu-link">
                        <span class="menu-title">Tags</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="apps/devs/ask.html" class="menu-link">
                        <span class="menu-title">Ask Question</span>
                    </a>
                </div>
            </div>

            <div class="menu-item">
                <div class="menu-link">
                    <a hred="#" class="menu-title text-muted fs-7" id="kt_aside_categories_toggle"
                        data-bs-toggle="collapse" data-bs-target="#kt_aside_categories_more">More Categories</a>
                </div>
            </div>
        </div>
    </div>
</div>
