<div id="kt_header" class="header align-items-stretch">
    <div class="container-xxl d-flex align-items-stretch justify-content-between">
        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0 w-lg-225px me-5">

            @if (session('auth_user'))
                <div class="btn btn-icon btn-active-icon-primary ms-n2 me-2 d-flex d-lg-none" id="kt_aside_toggle">
                    <i class="ki-duotone ki-abstract-14 fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
            @endif

            <a href="{{ route('home') }}">
                <img alt="Logo" src="{{ asset('assets/media/logos/logo-light.svg') }}"
                    class="d-none d-lg-inline h-50px theme-light-show" />
                <img alt="Logo" src="{{ asset('assets/media/logos/logo-dark.svg') }}"
                    class="d-none d-lg-inline h-50px theme-dark-show" />
                <img alt="Logo" src="{{ asset('assets/media/logos/logo-mobile.svg') }}" class="d-lg-none h-45px" />
            </a>

        </div>
        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
            <div class="d-flex align-items-stretch" id="kt_header_nav">
                <div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu"
                    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
                    data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="end"
                    data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true"
                    data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
                    <div class="menu menu-rounded menu-column menu-lg-row menu-root-here-bg-desktop menu-active-bg menu-state-primary menu-title-gray-800 menu-arrow-gray-500 align-items-stretch my-5 my-lg-0 px-2 px-lg-0 fw-semibold fs-6"
                        id="#kt_header_menu" data-kt-menu="true">


                        {{-- <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                data-kt-menu-placement="bottom-start"
                                class="menu-item here show menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
                                <span class="menu-link py-3">
                                    <span class="menu-title">Dashboards</span>
                                    <span class="menu-arrow d-lg-none"></span>
                                </span>
                                <div
                                    class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown p-0 w-100 w-lg-850px">
                                    <div class="menu-state-bg menu-extended overflow-hidden overflow-lg-visible"
                                        data-kt-menu-dismiss="true">
                                        <div class="row">
                                            <div class="col-lg-8 mb-3 mb-lg-0 py-3 px-3 py-lg-6 px-lg-6">
                                                <div class="row">
                                                    <div class="col-lg-6 mb-3">
                                                        <div class="menu-item p-0 m-0">
                                                            <a href="index.html" class="menu-link active">
                                                                <span
                                                                    class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                                                    <i
                                                                        class="ki-duotone ki-element-11 text-primary fs-1">
                                                                        <span class="path1"></span>
                                                                        <span class="path2"></span>
                                                                        <span class="path3"></span>
                                                                        <span class="path4"></span>
                                                                    </i>
                                                                </span>
                                                                <span class="d-flex flex-column">
                                                                    <span
                                                                        class="fs-6 fw-bold text-gray-800">Default</span>
                                                                    <span class="fs-7 fw-semibold text-muted">Reports
                                                                        & statistics</span>
                                                                </span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 mb-3">
                                                        <div class="menu-item p-0 m-0">
                                                            <a href="dashboards/ecommerce.html" class="menu-link">
                                                                <span
                                                                    class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                                                    <i class="ki-duotone ki-basket text-danger fs-1">
                                                                        <span class="path1"></span>
                                                                        <span class="path2"></span>
                                                                        <span class="path3"></span>
                                                                        <span class="path4"></span>
                                                                    </i>
                                                                </span>
                                                                <span class="d-flex flex-column">
                                                                    <span
                                                                        class="fs-6 fw-bold text-gray-800">eCommerce</span>
                                                                    <span class="fs-7 fw-semibold text-muted">Sales
                                                                        reports</span>
                                                                </span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 mb-3">
                                                        <div class="menu-item p-0 m-0">
                                                            <a href="dashboards/projects.html" class="menu-link">
                                                                <span
                                                                    class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                                                    <i class="ki-duotone ki-abstract-44 text-info fs-1">
                                                                        <span class="path1"></span>
                                                                        <span class="path2"></span>
                                                                    </i>
                                                                </span>
                                                                <span class="d-flex flex-column">
                                                                    <span
                                                                        class="fs-6 fw-bold text-gray-800">Projects</span>
                                                                    <span class="fs-7 fw-semibold text-muted">Tasts,
                                                                        graphs & charts</span>
                                                                </span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 mb-3">
                                                        <div class="menu-item p-0 m-0">
                                                            <a href="dashboards/online-courses.html" class="menu-link">
                                                                <span
                                                                    class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                                                    <i
                                                                        class="ki-duotone ki-color-swatch text-success fs-1">
                                                                        <span class="path1"></span>
                                                                        <span class="path2"></span>
                                                                        <span class="path3"></span>
                                                                        <span class="path4"></span>
                                                                        <span class="path5"></span>
                                                                        <span class="path6"></span>
                                                                        <span class="path7"></span>
                                                                        <span class="path8"></span>
                                                                        <span class="path9"></span>
                                                                        <span class="path10"></span>
                                                                        <span class="path11"></span>
                                                                        <span class="path12"></span>
                                                                        <span class="path13"></span>
                                                                        <span class="path14"></span>
                                                                        <span class="path15"></span>
                                                                        <span class="path16"></span>
                                                                        <span class="path17"></span>
                                                                        <span class="path18"></span>
                                                                        <span class="path19"></span>
                                                                        <span class="path20"></span>
                                                                        <span class="path21"></span>
                                                                    </i>
                                                                </span>
                                                                <span class="d-flex flex-column">
                                                                    <span class="fs-6 fw-bold text-gray-800">Online
                                                                        Courses</span>
                                                                    <span class="fs-7 fw-semibold text-muted">Student
                                                                        progress</span>
                                                                </span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 mb-3">
                                                        <div class="menu-item p-0 m-0">
                                                            <a href="dashboards/marketing.html" class="menu-link">
                                                                <span
                                                                    class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                                                    <i
                                                                        class="ki-duotone ki-chart-simple text-gray-900 fs-1">
                                                                        <span class="path1"></span>
                                                                        <span class="path2"></span>
                                                                        <span class="path3"></span>
                                                                        <span class="path4"></span>
                                                                    </i>
                                                                </span>
                                                                <span class="d-flex flex-column">
                                                                    <span
                                                                        class="fs-6 fw-bold text-gray-800">Marketing</span>
                                                                    <span class="fs-7 fw-semibold text-muted">Campaings
                                                                        & conversions</span>
                                                                </span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 mb-3">
                                                        <div class="menu-item p-0 m-0">
                                                            <a href="dashboards/bidding.html" class="menu-link">
                                                                <span
                                                                    class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                                                    <i class="ki-duotone ki-switch text-warning fs-1">
                                                                        <span class="path1"></span>
                                                                        <span class="path2"></span>
                                                                    </i>
                                                                </span>
                                                                <span class="d-flex flex-column">
                                                                    <span
                                                                        class="fs-6 fw-bold text-gray-800">Bidding</span>
                                                                    <span class="fs-7 fw-semibold text-muted">Campaings
                                                                        & conversions</span>
                                                                </span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 mb-3">
                                                        <div class="menu-item p-0 m-0">
                                                            <a href="dashboards/pos.html" class="menu-link">
                                                                <span
                                                                    class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                                                    <i
                                                                        class="ki-duotone ki-abstract-42 text-danger fs-1">
                                                                        <span class="path1"></span>
                                                                        <span class="path2"></span>
                                                                    </i>
                                                                </span>
                                                                <span class="d-flex flex-column">
                                                                    <span class="fs-6 fw-bold text-gray-800">POS
                                                                        System</span>
                                                                    <span class="fs-7 fw-semibold text-muted">Campaings
                                                                        & conversions</span>
                                                                </span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 mb-3">
                                                        <div class="menu-item p-0 m-0">
                                                            <a href="dashboards/call-center.html" class="menu-link">
                                                                <span
                                                                    class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                                                    <i class="ki-duotone ki-call text-primary fs-1">
                                                                        <span class="path1"></span>
                                                                        <span class="path2"></span>
                                                                        <span class="path3"></span>
                                                                        <span class="path4"></span>
                                                                        <span class="path5"></span>
                                                                        <span class="path6"></span>
                                                                        <span class="path7"></span>
                                                                        <span class="path8"></span>
                                                                    </i>
                                                                </span>
                                                                <span class="d-flex flex-column">
                                                                    <span class="fs-6 fw-bold text-gray-800">Call
                                                                        Center</span>
                                                                    <span class="fs-7 fw-semibold text-muted">Campaings
                                                                        & conversions</span>
                                                                </span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="separator separator-dashed mx-5 my-5"></div>
                                                <div class="d-flex flex-stack flex-wrap flex-lg-nowrap gap-2 mx-5">
                                                    <div class="d-flex flex-column me-5">
                                                        <div class="fs-6 fw-bold text-gray-800">Landing Page
                                                            Template</div>
                                                        <div class="fs-7 fw-semibold text-muted">Onpe page
                                                            landing template with pricing & others</div>
                                                    </div>
                                                    <a href="landing.html"
                                                        class="btn btn-sm btn-primary fw-bold">Explore</a>
                                                </div>
                                            </div>
                                            <div
                                                class="menu-more bg-light col-lg-4 py-3 px-3 py-lg-6 px-lg-6 rounded-end">
                                                <h4 class="fs-6 fs-lg-4 text-gray-800 fw-bold mt-3 mb-3 ms-4">
                                                    More Dashboards</h4>
                                                <div class="menu-item p-0 m-0">
                                                    <a href="dashboards/logistics.html" class="menu-link py-2">
                                                        <span class="menu-title">Logistics</span>
                                                    </a>
                                                </div>
                                                <div class="menu-item p-0 m-0">
                                                    <a href="dashboards/website-analytics.html"
                                                        class="menu-link py-2">
                                                        <span class="menu-title">Website Analytics</span>
                                                    </a>
                                                </div>
                                                <div class="menu-item p-0 m-0">
                                                    <a href="dashboards/finance-performance.html"
                                                        class="menu-link py-2">
                                                        <span class="menu-title">Finance Performance</span>
                                                    </a>
                                                </div>
                                                <div class="menu-item p-0 m-0">
                                                    <a href="dashboards/store-analytics.html" class="menu-link py-2">
                                                        <span class="menu-title">Store Analytics</span>
                                                    </a>
                                                </div>
                                                <div class="menu-item p-0 m-0">
                                                    <a href="dashboards/social.html" class="menu-link py-2">
                                                        <span class="menu-title">Social</span>
                                                    </a>
                                                </div>
                                                <div class="menu-item p-0 m-0">
                                                    <a href="dashboards/delivery.html" class="menu-link py-2">
                                                        <span class="menu-title">Delivery</span>
                                                    </a>
                                                </div>
                                                <div class="menu-item p-0 m-0">
                                                    <a href="dashboards/crypto.html" class="menu-link py-2">
                                                        <span class="menu-title">Crypto</span>
                                                    </a>
                                                </div>
                                                <div class="menu-item p-0 m-0">
                                                    <a href="dashboards/school.html" class="menu-link py-2">
                                                        <span class="menu-title">School</span>
                                                    </a>
                                                </div>
                                                <div class="menu-item p-0 m-0">
                                                    <a href="dashboards/podcast.html" class="menu-link py-2">
                                                        <span class="menu-title">Podcast</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                data-kt-menu-placement="bottom-start"
                                class="menu-item menu-lg-down-accordion me-0 me-lg-2">
                                <span class="menu-link py-3">
                                    <span class="menu-title">Pages</span>
                                    <span class="menu-arrow d-lg-none"></span>
                                </span>
                                <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown p-0">
                                    <div class="menu-active-bg px-4 px-lg-0">
                                        <div class="d-flex w-100 overflow-auto">
                                            <ul
                                                class="nav nav-stretch nav-line-tabs fw-bold fs-6 p-0 p-lg-10 flex-nowrap flex-grow-1">
                                                <li class="nav-item mx-lg-1">
                                                    <a class="nav-link py-3 py-lg-6 active text-active-primary"
                                                        href="#" data-bs-toggle="tab"
                                                        data-bs-target="#kt_app_header_menu_pages_pages">General</a>
                                                </li>
                                                <li class="nav-item mx-lg-1">
                                                    <a class="nav-link py-3 py-lg-6 text-active-primary"
                                                        href="#" data-bs-toggle="tab"
                                                        data-bs-target="#kt_app_header_menu_pages_account">Account</a>
                                                </li>
                                                <li class="nav-item mx-lg-1">
                                                    <a class="nav-link py-3 py-lg-6 text-active-primary"
                                                        href="#" data-bs-toggle="tab"
                                                        data-bs-target="#kt_app_header_menu_pages_authentication">Authentication</a>
                                                </li>
                                                <li class="nav-item mx-lg-1">
                                                    <a class="nav-link py-3 py-lg-6 text-active-primary"
                                                        href="#" data-bs-toggle="tab"
                                                        data-bs-target="#kt_app_header_menu_pages_utilities">Utilities</a>
                                                </li>
                                                <li class="nav-item mx-lg-1">
                                                    <a class="nav-link py-3 py-lg-6 text-active-primary"
                                                        href="#" data-bs-toggle="tab"
                                                        data-bs-target="#kt_app_header_menu_pages_widgets">Widgets</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-content py-4 py-lg-8 px-lg-7">
                                            <div class="tab-pane active w-lg-1000px"
                                                id="kt_app_header_menu_pages_pages">
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <div class="row">
                                                            <div class="col-lg-3 mb-6 mb-lg-0">
                                                                <h4 class="fs-6 fs-lg-4 fw-bold mb-3 ms-4">User
                                                                    Profile</h4>
                                                                <div class="menu-item p-0 m-0">
                                                                    <a href="pages/user-profile/overview.html"
                                                                        class="menu-link">
                                                                        <span class="menu-title">Overview</span>
                                                                    </a>
                                                                </div>
                                                                <div class="menu-item p-0 m-0">
                                                                    <a href="pages/user-profile/projects.html"
                                                                        class="menu-link">
                                                                        <span class="menu-title">Projects</span>
                                                                    </a>
                                                                </div>
                                                                <div class="menu-item p-0 m-0">
                                                                    <a href="pages/user-profile/campaigns.html"
                                                                        class="menu-link">
                                                                        <span class="menu-title">Campaigns</span>
                                                                    </a>
                                                                </div>
                                                                <div class="menu-item p-0 m-0">
                                                                    <a href="pages/user-profile/documents.html"
                                                                        class="menu-link">
                                                                        <span class="menu-title">Documents</span>
                                                                    </a>
                                                                </div>
                                                                <div class="menu-item p-0 m-0">
                                                                    <a href="pages/user-profile/followers.html"
                                                                        class="menu-link">
                                                                        <span class="menu-title">Followers</span>
                                                                    </a>
                                                                </div>
                                                                <div class="menu-item p-0 m-0">
                                                                    <a href="pages/user-profile/activity.html"
                                                                        class="menu-link">
                                                                        <span class="menu-title">Activity</span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 mb-6 mb-lg-0">
                                                                <div class="mb-6">
                                                                    <h4 class="fs-6 fs-lg-4 fw-bold mb-3 ms-4">
                                                                        Corporate</h4>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="pages/about.html" class="menu-link">
                                                                            <span class="menu-title">About</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="pages/team.html" class="menu-link">
                                                                            <span class="menu-title">Our
                                                                                Team</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="pages/contact.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">Contact
                                                                                Us</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="pages/licenses.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">Licenses</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="pages/sitemap.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">Sitemap</span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-0">
                                                                    <h4 class="fs-6 fs-lg-4 fw-bold mb-3 ms-4">
                                                                        Careers</h4>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="pages/careers/list.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">Careers
                                                                                List</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="pages/careers/apply.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">Careers
                                                                                Apply</span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 mb-6 mb-lg-0">
                                                                <div class="mb-6">
                                                                    <h4 class="fs-6 fs-lg-4 fw-bold mb-3 ms-4">
                                                                        FAQ</h4>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="pages/faq/classic.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">FAQ
                                                                                Classic</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="pages/faq/extended.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">FAQ
                                                                                Extended</span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-6">
                                                                    <h4 class="fs-6 fs-lg-4 fw-bold mb-3 ms-4">
                                                                        Blog</h4>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="pages/blog/home.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">Blog
                                                                                Home</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="pages/blog/post.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">Blog
                                                                                Post</span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-0">
                                                                    <h4 class="fs-6 fs-lg-4 fw-bold mb-3 ms-4">
                                                                        Pricing</h4>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="pages/pricing.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">Column
                                                                                Pricing</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="pages/pricing/table.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">Table
                                                                                Pricing</span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 mb-6 mb-lg-0">
                                                                <div class="mb-0">
                                                                    <h4 class="fs-6 fs-lg-4 fw-bold mb-3 ms-4">
                                                                        Social</h4>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="pages/social/feeds.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">Feeds</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="pages/social/activity.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">Activty</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="pages/social/followers.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">Followers</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="pages/social/settings.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">Settings</span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <img src="{{ asset('assets/media/stock/600x600/img-82.jpg') }}"
                                                            class="rounded mw-100" alt="" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane w-lg-600px" id="kt_app_header_menu_pages_account">
                                                <div class="row">
                                                    <div class="col-lg-5 mb-6 mb-lg-0">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="menu-item p-0 m-0">
                                                                    <a href="account/overview.html" class="menu-link">
                                                                        <span class="menu-title">Overview</span>
                                                                    </a>
                                                                </div>
                                                                <div class="menu-item p-0 m-0">
                                                                    <a href="account/settings.html" class="menu-link">
                                                                        <span class="menu-title">Settings</span>
                                                                    </a>
                                                                </div>
                                                                <div class="menu-item p-0 m-0">
                                                                    <a href="account/security.html" class="menu-link">
                                                                        <span class="menu-title">Security</span>
                                                                    </a>
                                                                </div>
                                                                <div class="menu-item p-0 m-0">
                                                                    <a href="account/activity.html" class="menu-link">
                                                                        <span class="menu-title">Activity</span>
                                                                    </a>
                                                                </div>
                                                                <div class="menu-item p-0 m-0">
                                                                    <a href="account/billing.html" class="menu-link">
                                                                        <span class="menu-title">Billing</span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="menu-item p-0 m-0">
                                                                    <a href="account/statements.html"
                                                                        class="menu-link">
                                                                        <span class="menu-title">Statements</span>
                                                                    </a>
                                                                </div>
                                                                <div class="menu-item p-0 m-0">
                                                                    <a href="account/referrals.html"
                                                                        class="menu-link">
                                                                        <span class="menu-title">Referrals</span>
                                                                    </a>
                                                                </div>
                                                                <div class="menu-item p-0 m-0">
                                                                    <a href="account/api-keys.html" class="menu-link">
                                                                        <span class="menu-title">API
                                                                            Keys</span>
                                                                    </a>
                                                                </div>
                                                                <div class="menu-item p-0 m-0">
                                                                    <a href="account/logs.html" class="menu-link">
                                                                        <span class="menu-title">Logs</span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-7">
                                                        <img src="{{ asset('assets/media/stock/900x600/46.jpg') }}"
                                                            class="rounded mw-100" alt="" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane w-lg-1000px"
                                                id="kt_app_header_menu_pages_authentication">
                                                <div class="row">
                                                    <div class="col-lg-3 mb-6 mb-lg-0">
                                                        <div class="mb-6">
                                                            <h4 class="fs-6 fs-lg-4 fw-bold mb-3 ms-4">
                                                                Corporate Layout</h4>
                                                            <div class="menu-item p-0 m-0">
                                                                <a href="authentication/layouts/corporate/sign-in.html"
                                                                    class="menu-link">
                                                                    <span class="menu-title">Sign-In</span>
                                                                </a>
                                                            </div>
                                                            <div class="menu-item p-0 m-0">
                                                                <a href="authentication/layouts/corporate/sign-up.html"
                                                                    class="menu-link">
                                                                    <span class="menu-title">Sign-Up</span>
                                                                </a>
                                                            </div>
                                                            <div class="menu-item p-0 m-0">
                                                                <a href="authentication/layouts/corporate/two-factor.html"
                                                                    class="menu-link">
                                                                    <span class="menu-title">Two-Factor</span>
                                                                </a>
                                                            </div>
                                                            <div class="menu-item p-0 m-0">
                                                                <a href="authentication/layouts/corporate/reset-password.html"
                                                                    class="menu-link">
                                                                    <span class="menu-title">Reset
                                                                        Password</span>
                                                                </a>
                                                            </div>
                                                            <div class="menu-item p-0 m-0">
                                                                <a href="authentication/layouts/corporate/new-password.html"
                                                                    class="menu-link">
                                                                    <span class="menu-title">New
                                                                        Password</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="mb-0">
                                                            <h4 class="fs-6 fs-lg-4 fw-bold mb-3 ms-4">Overlay
                                                                Layout</h4>
                                                            <div class="menu-item p-0 m-0">
                                                                <a href="authentication/layouts/overlay/sign-in.html"
                                                                    class="menu-link">
                                                                    <span class="menu-title">Sign-In</span>
                                                                </a>
                                                            </div>
                                                            <div class="menu-item p-0 m-0">
                                                                <a href="authentication/layouts/overlay/sign-up.html"
                                                                    class="menu-link">
                                                                    <span class="menu-title">Sign-Up</span>
                                                                </a>
                                                            </div>
                                                            <div class="menu-item p-0 m-0">
                                                                <a href="authentication/layouts/overlay/two-factor.html"
                                                                    class="menu-link">
                                                                    <span class="menu-title">Two-Factor</span>
                                                                </a>
                                                            </div>
                                                            <div class="menu-item p-0 m-0">
                                                                <a href="authentication/layouts/overlay/reset-password.html"
                                                                    class="menu-link">
                                                                    <span class="menu-title">Reset
                                                                        Password</span>
                                                                </a>
                                                            </div>
                                                            <div class="menu-item p-0 m-0">
                                                                <a href="authentication/layouts/overlay/new-password.html"
                                                                    class="menu-link">
                                                                    <span class="menu-title">New
                                                                        Password</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 mb-6 mb-lg-0">
                                                        <div class="mb-6">
                                                            <h4 class="fs-6 fs-lg-4 fw-bold mb-3 ms-4">Creative
                                                                Layout</h4>
                                                            <div class="menu-item p-0 m-0">
                                                                <a href="authentication/layouts/creative/sign-in.html"
                                                                    class="menu-link">
                                                                    <span class="menu-title">Sign-in</span>
                                                                </a>
                                                            </div>
                                                            <div class="menu-item p-0 m-0">
                                                                <a href="authentication/layouts/creative/sign-up.html"
                                                                    class="menu-link">
                                                                    <span class="menu-title">Sign-up</span>
                                                                </a>
                                                            </div>
                                                            <div class="menu-item p-0 m-0">
                                                                <a href="authentication/layouts/creative/two-factor.html"
                                                                    class="menu-link">
                                                                    <span class="menu-title">Two-Factor</span>
                                                                </a>
                                                            </div>
                                                            <div class="menu-item p-0 m-0">
                                                                <a href="authentication/layouts/creative/reset-password.html"
                                                                    class="menu-link">
                                                                    <span class="menu-title">Reset
                                                                        Password</span>
                                                                </a>
                                                            </div>
                                                            <div class="menu-item p-0 m-0">
                                                                <a href="authentication/layouts/creative/new-password.html"
                                                                    class="menu-link">
                                                                    <span class="menu-title">New
                                                                        Password</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="mb-6">
                                                            <h4 class="fs-6 fs-lg-4 fw-bold mb-3 ms-4">Fancy
                                                                Layout</h4>
                                                            <div class="menu-item p-0 m-0">
                                                                <a href="authentication/layouts/fancy/sign-in.html"
                                                                    class="menu-link">
                                                                    <span class="menu-title">Sign-In</span>
                                                                </a>
                                                            </div>
                                                            <div class="menu-item p-0 m-0">
                                                                <a href="authentication/layouts/fancy/sign-up.html"
                                                                    class="menu-link">
                                                                    <span class="menu-title">Sign-Up</span>
                                                                </a>
                                                            </div>
                                                            <div class="menu-item p-0 m-0">
                                                                <a href="authentication/layouts/fancy/two-factor.html"
                                                                    class="menu-link">
                                                                    <span class="menu-title">Two-Factor</span>
                                                                </a>
                                                            </div>
                                                            <div class="menu-item p-0 m-0">
                                                                <a href="authentication/layouts/fancy/reset-password.html"
                                                                    class="menu-link">
                                                                    <span class="menu-title">Reset
                                                                        Password</span>
                                                                </a>
                                                            </div>
                                                            <div class="menu-item p-0 m-0">
                                                                <a href="authentication/layouts/fancy/new-password.html"
                                                                    class="menu-link">
                                                                    <span class="menu-title">New
                                                                        Password</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 mb-6 mb-lg-0">
                                                        <div class="mb-0">
                                                            <h4 class="fs-6 fs-lg-4 fw-bold mb-3 ms-4">General
                                                            </h4>
                                                            <div class="menu-item p-0 m-0">
                                                                <a href="authentication/extended/multi-steps-sign-up.html"
                                                                    class="menu-link">
                                                                    <span class="menu-title">Multi-Steps
                                                                        Sign-Up</span>
                                                                </a>
                                                            </div>
                                                            <div class="menu-item p-0 m-0">
                                                                <a href="authentication/general/welcome.html"
                                                                    class="menu-link">
                                                                    <span class="menu-title">Welcome
                                                                        Message</span>
                                                                </a>
                                                            </div>
                                                            <div class="menu-item p-0 m-0">
                                                                <a href="authentication/general/verify-email.html"
                                                                    class="menu-link">
                                                                    <span class="menu-title">Verify
                                                                        Email</span>
                                                                </a>
                                                            </div>
                                                            <div class="menu-item p-0 m-0">
                                                                <a href="authentication/general/coming-soon.html"
                                                                    class="menu-link">
                                                                    <span class="menu-title">Coming Soon</span>
                                                                </a>
                                                            </div>
                                                            <div class="menu-item p-0 m-0">
                                                                <a href="authentication/general/password-confirmation.html"
                                                                    class="menu-link">
                                                                    <span class="menu-title">Password
                                                                        Confirmation</span>
                                                                </a>
                                                            </div>
                                                            <div class="menu-item p-0 m-0">
                                                                <a href="authentication/general/account-deactivated.html"
                                                                    class="menu-link">
                                                                    <span class="menu-title">Account
                                                                        Deactivation</span>
                                                                </a>
                                                            </div>
                                                            <div class="menu-item p-0 m-0">
                                                                <a href="authentication/general/error-404.html"
                                                                    class="menu-link">
                                                                    <span class="menu-title">Error 404</span>
                                                                </a>
                                                            </div>
                                                            <div class="menu-item p-0 m-0">
                                                                <a href="authentication/general/error-500.html"
                                                                    class="menu-link">
                                                                    <span class="menu-title">Error 500</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 mb-6 mb-lg-0">
                                                        <div class="mb-0">
                                                            <h4 class="fs-6 fs-lg-4 fw-bold mb-3 ms-4">Email
                                                                Templates</h4>
                                                            <div class="menu-item p-0 m-0">
                                                                <a href="authentication/email/welcome-message.html"
                                                                    class="menu-link">
                                                                    <span class="menu-title">Welcome
                                                                        Message</span>
                                                                </a>
                                                            </div>
                                                            <div class="menu-item p-0 m-0">
                                                                <a href="authentication/email/reset-password.html"
                                                                    class="menu-link">
                                                                    <span class="menu-title">Reset
                                                                        Password</span>
                                                                </a>
                                                            </div>
                                                            <div class="menu-item p-0 m-0">
                                                                <a href="authentication/email/subscription-confirmed.html"
                                                                    class="menu-link">
                                                                    <span class="menu-title">Subscription
                                                                        Confirmed</span>
                                                                </a>
                                                            </div>
                                                            <div class="menu-item p-0 m-0">
                                                                <a href="authentication/email/card-declined.html"
                                                                    class="menu-link">
                                                                    <span class="menu-title">Credit Card
                                                                        Declined</span>
                                                                </a>
                                                            </div>
                                                            <div class="menu-item p-0 m-0">
                                                                <a href="authentication/email/promo-1.html"
                                                                    class="menu-link">
                                                                    <span class="menu-title">Promo 1</span>
                                                                </a>
                                                            </div>
                                                            <div class="menu-item p-0 m-0">
                                                                <a href="authentication/email/promo-2.html"
                                                                    class="menu-link">
                                                                    <span class="menu-title">Promo 2</span>
                                                                </a>
                                                            </div>
                                                            <div class="menu-item p-0 m-0">
                                                                <a href="authentication/email/promo-3.html"
                                                                    class="menu-link">
                                                                    <span class="menu-title">Promo 3</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane w-lg-1000px" id="kt_app_header_menu_pages_utilities">
                                                <div class="row">
                                                    <div class="col-lg-7">
                                                        <div class="row">
                                                            <div class="col-lg-4 mb-6 mb-lg-0">
                                                                <div class="mb-0">
                                                                    <h4 class="fs-6 fs-lg-4 fw-bold mb-3 ms-4">
                                                                        General Modals</h4>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="utilities/modals/general/invite-friends.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">Invite
                                                                                Friends</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="utilities/modals/general/view-users.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">View
                                                                                Users</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="utilities/modals/general/select-users.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">Select
                                                                                Users</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="utilities/modals/general/upgrade-plan.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">Upgrade
                                                                                Plan</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="utilities/modals/general/share-earn.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">Share &
                                                                                Earn</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="utilities/modals/forms/new-target.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">New
                                                                                Target</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="utilities/modals/forms/new-card.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">New
                                                                                Card</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="utilities/modals/forms/new-address.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">New
                                                                                Address</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="utilities/modals/forms/create-api-key.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">Create API
                                                                                Key</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="utilities/modals/forms/bidding.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">Bidding</span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 mb-6 mb-lg-0">
                                                                <div class="mb-6">
                                                                    <h4 class="fs-6 fs-lg-4 fw-bold mb-3 ms-4">
                                                                        Advanced Modals</h4>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="utilities/modals/wizards/create-app.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">Create
                                                                                App</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="utilities/modals/wizards/create-campaign.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">Create
                                                                                Campaign</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="utilities/modals/wizards/create-account.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">Create
                                                                                Business Acc</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="utilities/modals/wizards/create-project.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">Create
                                                                                Project</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="utilities/modals/wizards/top-up-wallet.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">Top Up
                                                                                Wallet</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="utilities/modals/wizards/offer-a-deal.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">Offer a
                                                                                Deal</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="utilities/modals/wizards/two-factor-authentication.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">Two Factor
                                                                                Auth</span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-0">
                                                                    <h4 class="fs-6 fs-lg-4 fw-bold mb-3 ms-4">
                                                                        Search</h4>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="utilities/search/horizontal.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">Horizontal</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="utilities/search/vertical.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">Vertical</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="utilities/modals/search/users.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">Users</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="utilities/modals/search/select-location.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">Select
                                                                                Location</span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 mb-6 mb-lg-0">
                                                                <div class="mb-0">
                                                                    <h4 class="fs-6 fs-lg-4 fw-bold mb-3 ms-4">
                                                                        Wizards</h4>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="utilities/wizards/horizontal.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">Horizontal</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="utilities/wizards/vertical.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">Vertical</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="utilities/wizards/two-factor-authentication.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">Two Factor
                                                                                Auth</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="utilities/wizards/create-app.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">Create
                                                                                App</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="utilities/wizards/create-campaign.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">Create
                                                                                Campaign</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="utilities/wizards/create-account.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">Create
                                                                                Account</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="utilities/wizards/create-project.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">Create
                                                                                Project</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="utilities/modals/wizards/top-up-wallet.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">Top Up
                                                                                Wallet</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="menu-item p-0 m-0">
                                                                        <a href="utilities/wizards/offer-a-deal.html"
                                                                            class="menu-link">
                                                                            <span class="menu-title">Offer a
                                                                                Deal</span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5 pe-lg-5">
                                                        <img src="{{ asset('assets/media/stock/600x600/img-84.jpg') }}"
                                                            class="rounded mw-100" alt="" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane w-lg-500px" id="kt_app_header_menu_pages_widgets">
                                                <div class="row">
                                                    <div class="col-lg-4 mb-6 mb-lg-0">
                                                        <div class="menu-item p-0 m-0">
                                                            <a href="widgets/lists.html" class="menu-link">
                                                                <span class="menu-title">Lists</span>
                                                            </a>
                                                        </div>
                                                        <div class="menu-item p-0 m-0">
                                                            <a href="widgets/statistics.html" class="menu-link">
                                                                <span class="menu-title">Statistics</span>
                                                            </a>
                                                        </div>
                                                        <div class="menu-item p-0 m-0">
                                                            <a href="widgets/charts.html" class="menu-link">
                                                                <span class="menu-title">Charts</span>
                                                            </a>
                                                        </div>
                                                        <div class="menu-item p-0 m-0">
                                                            <a href="widgets/mixed.html" class="menu-link">
                                                                <span class="menu-title">Mixed</span>
                                                            </a>
                                                        </div>
                                                        <div class="menu-item p-0 m-0">
                                                            <a href="widgets/tables.html" class="menu-link">
                                                                <span class="menu-title">Tables</span>
                                                            </a>
                                                        </div>
                                                        <div class="menu-item p-0 m-0">
                                                            <a href="widgets/feeds.html" class="menu-link">
                                                                <span class="menu-title">Feeds</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <img src="{{ asset('assets/media/stock/900x600/44.jpg') }}"
                                                            class="rounded mw-100" alt="" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                data-kt-menu-placement="bottom-start"
                                class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
                                <span class="menu-link py-3">
                                    <span class="menu-title">Apps</span>
                                    <span class="menu-arrow d-lg-none"></span>
                                </span>
                                <div
                                    class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-250px">
                                    <div data-kt-menu-trigger="{default:'click', lg: 'hover'}"
                                        data-kt-menu-placement="right-start" class="menu-item menu-lg-down-accordion">
                                        <span class="menu-link py-3">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-rocket fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title">Projects</span>
                                            <span class="menu-arrow"></span>
                                        </span>
                                        <div
                                            class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px">
                                            <div class="menu-item">
                                                <a class="menu-link py-3" href="apps/projects/list.html">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">My Projects</span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link py-3" href="apps/projects/project.html">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">View Project</span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link py-3" href="apps/projects/targets.html">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Targets</span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link py-3" href="apps/projects/budget.html">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Budget</span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link py-3" href="apps/projects/users.html">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Users</span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link py-3" href="apps/projects/files.html">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Files</span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link py-3" href="apps/projects/activity.html">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Activity</span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link py-3" href="apps/projects/settings.html">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Settings</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div data-kt-menu-trigger="{default:'click', lg: 'hover'}"
                                        data-kt-menu-placement="right-start" class="menu-item menu-lg-down-accordion">
                                        <span class="menu-link py-3">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-handcart fs-2"></i>
                                            </span>
                                            <span class="menu-title">eCommerce</span>
                                            <span class="menu-arrow"></span>
                                        </span>
                                        <div
                                            class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px">
                                            <div data-kt-menu-trigger="{default:'click', lg: 'hover'}"
                                                data-kt-menu-placement="right-start"
                                                class="menu-item menu-lg-down-accordion">
                                                <span class="menu-link py-3">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Catalog</span>
                                                    <span class="menu-arrow"></span>
                                                </span>
                                                <div
                                                    class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px">
                                                    <div class="menu-item">
                                                        <a class="menu-link py-3"
                                                            href="apps/ecommerce/catalog/products.html">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">Products</span>
                                                        </a>
                                                    </div>
                                                    <div class="menu-item">
                                                        <a class="menu-link py-3"
                                                            href="apps/ecommerce/catalog/categories.html">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">Categories</span>
                                                        </a>
                                                    </div>
                                                    <div class="menu-item">
                                                        <a class="menu-link py-3"
                                                            href="apps/ecommerce/catalog/add-product.html">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">Add Product</span>
                                                        </a>
                                                    </div>
                                                    <div class="menu-item">
                                                        <a class="menu-link py-3"
                                                            href="apps/ecommerce/catalog/edit-product.html">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">Edit Product</span>
                                                        </a>
                                                    </div>
                                                    <div class="menu-item">
                                                        <a class="menu-link py-3"
                                                            href="apps/ecommerce/catalog/add-category.html">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">Add Category</span>
                                                        </a>
                                                    </div>
                                                    <div class="menu-item">
                                                        <a class="menu-link py-3"
                                                            href="apps/ecommerce/catalog/edit-category.html">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">Edit Category</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div data-kt-menu-trigger="click"
                                                class="menu-item menu-accordion menu-sub-indention">
                                                <span class="menu-link py-3">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Sales</span>
                                                    <span class="menu-arrow"></span>
                                                </span>
                                                <div class="menu-sub menu-sub-accordion">
                                                    <div class="menu-item">
                                                        <a class="menu-link py-3"
                                                            href="apps/ecommerce/sales/listing.html">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">Orders Listing</span>
                                                        </a>
                                                    </div>
                                                    <div class="menu-item">
                                                        <a class="menu-link py-3"
                                                            href="apps/ecommerce/sales/details.html">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">Order Details</span>
                                                        </a>
                                                    </div>
                                                    <div class="menu-item">
                                                        <a class="menu-link py-3"
                                                            href="apps/ecommerce/sales/add-order.html">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">Add Order</span>
                                                        </a>
                                                    </div>
                                                    <div class="menu-item">
                                                        <a class="menu-link py-3"
                                                            href="apps/ecommerce/sales/edit-order.html">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">Edit Order</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div data-kt-menu-trigger="click"
                                                class="menu-item menu-accordion menu-sub-indention">
                                                <span class="menu-link py-3">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Customers</span>
                                                    <span class="menu-arrow"></span>
                                                </span>
                                                <div class="menu-sub menu-sub-accordion">
                                                    <div class="menu-item">
                                                        <a class="menu-link py-3"
                                                            href="apps/ecommerce/customers/listing.html">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">Customers Listing</span>
                                                        </a>
                                                    </div>
                                                    <div class="menu-item">
                                                        <a class="menu-link py-3"
                                                            href="apps/ecommerce/customers/details.html">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">Customers Details</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div data-kt-menu-trigger="click"
                                                class="menu-item menu-accordion menu-sub-indention">
                                                <span class="menu-link py-3">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Reports</span>
                                                    <span class="menu-arrow"></span>
                                                </span>
                                                <div class="menu-sub menu-sub-accordion">
                                                    <div class="menu-item">
                                                        <a class="menu-link py-3"
                                                            href="apps/ecommerce/reports/view.html">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">Products Viewed</span>
                                                        </a>
                                                    </div>
                                                    <div class="menu-item">
                                                        <a class="menu-link py-3"
                                                            href="apps/ecommerce/reports/sales.html">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">Sales</span>
                                                        </a>
                                                    </div>
                                                    <div class="menu-item">
                                                        <a class="menu-link py-3"
                                                            href="apps/ecommerce/reports/returns.html">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">Returns</span>
                                                        </a>
                                                    </div>
                                                    <div class="menu-item">
                                                        <a class="menu-link py-3"
                                                            href="apps/ecommerce/reports/customer-orders.html">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">Customer Orders</span>
                                                        </a>
                                                    </div>
                                                    <div class="menu-item">
                                                        <a class="menu-link py-3"
                                                            href="apps/ecommerce/reports/shipping.html">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">Shipping</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link py-3" href="apps/ecommerce/settings.html">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Settings</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div data-kt-menu-trigger="{default:'click', lg: 'hover'}"
                                        data-kt-menu-placement="right-start" class="menu-item menu-lg-down-accordion">
                                        <span class="menu-link py-3">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-chart fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title">Support Center</span>
                                            <span class="menu-arrow"></span>
                                        </span>
                                        <div
                                            class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px">
                                            <div class="menu-item">
                                                <a class="menu-link py-3" href="apps/support-center/overview.html">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Overview</span>
                                                </a>
                                            </div>
                                            <div data-kt-menu-trigger="{default:'click', lg: 'hover'}"
                                                data-kt-menu-placement="right-start"
                                                class="menu-item menu-lg-down-accordion">
                                                <span class="menu-link py-3">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Tickets</span>
                                                    <span class="menu-arrow"></span>
                                                </span>
                                                <div
                                                    class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px">
                                                    <div class="menu-item">
                                                        <a class="menu-link py-3"
                                                            href="apps/support-center/tickets/list.html">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">Ticket List</span>
                                                        </a>
                                                    </div>
                                                    <div class="menu-item">
                                                        <a class="menu-link py-3"
                                                            href="apps/support-center/tickets/view.html">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">Ticket View</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div data-kt-menu-trigger="{default:'click', lg: 'hover'}"
                                                data-kt-menu-placement="right-start"
                                                class="menu-item menu-lg-down-accordion">
                                                <span class="menu-link py-3">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Tutorials</span>
                                                    <span class="menu-arrow"></span>
                                                </span>
                                                <div
                                                    class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px">
                                                    <div class="menu-item">
                                                        <a class="menu-link py-3"
                                                            href="apps/support-center/tutorials/list.html">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">Tutorials List</span>
                                                        </a>
                                                    </div>
                                                    <div class="menu-item">
                                                        <a class="menu-link py-3"
                                                            href="apps/support-center/tutorials/post.html">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">Tutorials Post</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link py-3" href="apps/support-center/faq.html">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">FAQ</span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link py-3" href="apps/support-center/licenses.html">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Licenses</span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link py-3" href="apps/support-center/contact.html">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Contact Us</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div data-kt-menu-trigger="{default:'click', lg: 'hover'}"
                                        data-kt-menu-placement="right-start"
                                        class="menu-item menu-lg-down-accordion">
                                        <span class="menu-link py-3">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-shield-tick fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title">User Management</span>
                                            <span class="menu-arrow"></span>
                                        </span>
                                        <div
                                            class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px">
                                            <div data-kt-menu-trigger="{default:'click', lg: 'hover'}"
                                                data-kt-menu-placement="right-start"
                                                class="menu-item menu-lg-down-accordion">
                                                <span class="menu-link py-3">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Users</span>
                                                    <span class="menu-arrow"></span>
                                                </span>
                                                <div
                                                    class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px">
                                                    <div class="menu-item">
                                                        <a class="menu-link py-3"
                                                            href="apps/user-management/users/list.html">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">Users List</span>
                                                        </a>
                                                    </div>
                                                    <div class="menu-item">
                                                        <a class="menu-link py-3"
                                                            href="apps/user-management/users/view.html">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">View User</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div data-kt-menu-trigger="{default:'click', lg: 'hover'}"
                                                data-kt-menu-placement="right-start"
                                                class="menu-item menu-lg-down-accordion">
                                                <span class="menu-link py-3">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Roles</span>
                                                    <span class="menu-arrow"></span>
                                                </span>
                                                <div
                                                    class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px">
                                                    <div class="menu-item">
                                                        <a class="menu-link py-3"
                                                            href="apps/user-management/roles/list.html">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">Roles List</span>
                                                        </a>
                                                    </div>
                                                    <div class="menu-item">
                                                        <a class="menu-link py-3"
                                                            href="apps/user-management/roles/view.html">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">View Roles</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link py-3"
                                                    href="apps/user-management/permissions.html">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Permissions</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div data-kt-menu-trigger="{default:'click', lg: 'hover'}"
                                        data-kt-menu-placement="right-start"
                                        class="menu-item menu-lg-down-accordion">
                                        <span class="menu-link py-3">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-phone fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title">Contacts</span>
                                            <span class="menu-arrow"></span>
                                        </span>
                                        <div
                                            class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px">
                                            <div class="menu-item">
                                                <a class="menu-link py-3" href="apps/contacts/getting-started.html">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Getting Started</span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link py-3" href="apps/contacts/add-contact.html">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Add Contact</span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link py-3" href="apps/contacts/edit-contact.html">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Edit Contact</span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link py-3" href="apps/contacts/view-contact.html">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">View Contact</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div data-kt-menu-trigger="{default:'click', lg: 'hover'}"
                                        data-kt-menu-placement="right-start"
                                        class="menu-item menu-lg-down-accordion">
                                        <span class="menu-link py-3">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-basket fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title">Subscriptions</span>
                                            <span class="menu-arrow"></span>
                                        </span>
                                        <div
                                            class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px">
                                            <div class="menu-item">
                                                <a class="menu-link py-3"
                                                    href="apps/subscriptions/getting-started.html">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Getting Started</span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link py-3" href="apps/subscriptions/list.html">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Subscription List</span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link py-3" href="apps/subscriptions/add.html">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Add Subscription</span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link py-3" href="apps/subscriptions/view.html">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">View Subscription</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div data-kt-menu-trigger="{default:'click', lg: 'hover'}"
                                        data-kt-menu-placement="right-start"
                                        class="menu-item menu-lg-down-accordion">
                                        <span class="menu-link py-3">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-briefcase fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title">Customers</span>
                                            <span class="menu-arrow"></span>
                                        </span>
                                        <div
                                            class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px">
                                            <div class="menu-item">
                                                <a class="menu-link py-3"
                                                    href="apps/customers/getting-started.html">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Getting Started</span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link py-3" href="apps/customers/list.html">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Customer Listing</span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link py-3" href="apps/customers/view.html">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Customer Details</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div data-kt-menu-trigger="{default:'click', lg: 'hover'}"
                                        data-kt-menu-placement="right-start"
                                        class="menu-item menu-lg-down-accordion">
                                        <span class="menu-link py-3">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-credit-cart fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title">Invoice Management</span>
                                            <span class="menu-arrow"></span>
                                        </span>
                                        <div
                                            class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px">
                                            <div data-kt-menu-trigger="{default:'click', lg: 'hover'}"
                                                data-kt-menu-placement="right-start"
                                                class="menu-item menu-lg-down-accordion">
                                                <span class="menu-link py-3">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Profile</span>
                                                    <span class="menu-arrow"></span>
                                                </span>
                                                <div
                                                    class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px">
                                                    <div class="menu-item">
                                                        <a class="menu-link py-3"
                                                            href="apps/invoices/view/invoice-1.html">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">Invoice 1</span>
                                                        </a>
                                                    </div>
                                                    <div class="menu-item">
                                                        <a class="menu-link py-3"
                                                            href="apps/invoices/view/invoice-2.html">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">Invoice 2</span>
                                                        </a>
                                                    </div>
                                                    <div class="menu-item">
                                                        <a class="menu-link py-3"
                                                            href="apps/invoices/view/invoice-3.html">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">Invoice 3</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link py-3" href="apps/invoices/create.html">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Create Invoice</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div data-kt-menu-trigger="{default:'click', lg: 'hover'}"
                                        data-kt-menu-placement="right-start"
                                        class="menu-item menu-lg-down-accordion">
                                        <span class="menu-link py-3">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-file-added fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title">File Manager</span>
                                            <span class="menu-arrow"></span>
                                        </span>
                                        <div
                                            class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px">
                                            <div class="menu-item">
                                                <a class="menu-link py-3" href="apps/file-manager/folders.html">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Folders</span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link py-3" href="apps/file-manager/files.html">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Files</span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link py-3" href="apps/file-manager/blank.html">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Blank Directory</span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link py-3" href="apps/file-manager/settings.html">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Settings</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div data-kt-menu-trigger="{default:'click', lg: 'hover'}"
                                        data-kt-menu-placement="right-start"
                                        class="menu-item menu-lg-down-accordion">
                                        <span class="menu-link py-3">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-sms fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title">Inbox</span>
                                            <span class="menu-arrow"></span>
                                        </span>
                                        <div
                                            class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px">
                                            <div class="menu-item">
                                                <a class="menu-link py-3" href="apps/inbox/listing.html">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Messages</span>
                                                    <span class="menu-badge">
                                                        <span class="badge badge-light-success">3</span>
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link py-3" href="apps/inbox/compose.html">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Compose</span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link py-3" href="apps/inbox/reply.html">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">View & Reply</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div data-kt-menu-trigger="{default:'click', lg: 'hover'}"
                                        data-kt-menu-placement="right-start"
                                        class="menu-item menu-lg-down-accordion">
                                        <span class="menu-link py-3">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-message-text-2 fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title">Chat</span>
                                            <span class="menu-arrow"></span>
                                        </span>
                                        <div
                                            class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px">
                                            <div class="menu-item">
                                                <a class="menu-link py-3" href="apps/chat/private.html">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Private Chat</span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link py-3" href="apps/chat/group.html">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Group Chat</span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link py-3" href="apps/chat/drawer.html">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Drawer Chat</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="menu-item">
                                        <a class="menu-link py-3" href="apps/calendar.html">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-calendar-8 fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                    <span class="path5"></span>
                                                    <span class="path6"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title">Calendar</span>
                                        </a>
                                    </div>
                                    <div data-kt-menu-trigger="{default:'click', lg: 'hover'}"
                                        data-kt-menu-placement="right-start"
                                        class="menu-item menu-lg-down-accordion">
                                        <span class="menu-link py-3">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-faceid fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                    <span class="path5"></span>
                                                    <span class="path6"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title">Devs</span>
                                            <span class="menu-arrow"></span>
                                        </span>
                                        <div
                                            class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px">
                                            <div class="menu-item">
                                                <a class="menu-link py-3" href="apps/devs/question.html">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">View Question</span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link py-3" href="apps/devs/ask.html">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Ask Question</span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link py-3" href="apps/devs/search.html">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Search Questions</span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link py-3" href="apps/devs/tag.html">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Tags</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                data-kt-menu-placement="bottom-start"
                                class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
                                <span class="menu-link py-3">
                                    <span class="menu-title">Site</span>
                                    <span class="menu-arrow d-lg-none"></span>
                                </span>
                                <div
                                    class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-200px">
                                    <div class="menu-item">
                                        <a class="menu-link py-3" href="{{ route('home') }}">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-home fs-2"></i>
                                            </span>
                                            <span class="menu-title">Home</span>
                                        </a>
                                    </div>

                                    <div class="menu-item">
                                        <a class="menu-link py-3" href="{{ route('about') }}">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-information fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title">Sobre</span>
                                        </a>
                                    </div>

                                    <div class="menu-item">
                                        <a class="menu-link py-3" href="{{ route('features') }}">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-gear fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title">Funcionalidades</span>
                                        </a>
                                    </div>

                                    <div class="menu-item">
                                        <a class="menu-link py-3" href="{{ route('plans') }}">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-note-2 fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title">Planos</span>
                                        </a>
                                    </div>

                                </div>

                            </div> --}}

                        <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                            data-kt-menu-placement="bottom-start"
                            class="menu-item @if (Route::currentRouteName() === 'home') here show @endif  me-0 me-lg-2">
                            <a href="{{ route('home') }}" class="menu-link py-3">
                                <span class="menu-icon">
                                    <i class="ki-solid ki-home fs-2"></i>
                                </span>
                                <span class="menu-title">Home</span>
                                <span class="menu-arrow d-lg-none"></span>
                            </a>
                        </div>

                        <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                            data-kt-menu-placement="bottom-start"
                            class="menu-item @if (Request::is('about*')) here show @endif  me-0 me-lg-2">
                            <a href="{{ route('about') }}" class="menu-link py-3">
                                <span class="menu-icon">
                                    <i class="ki-solid ki-information fs-2"></i>
                                </span>
                                <span class="menu-title">Sobre</span>
                                <span class="menu-arrow d-lg-none"></span>
                            </a>
                        </div>

                        <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                            data-kt-menu-placement="bottom-start"
                            class="menu-item @if (Request::is('features*')) here show @endif  me-0 me-lg-2">
                            <a href="{{ route('features') }}" class="menu-link py-3">
                                <span class="menu-icon">
                                    <i class="ki-solid ki-gear fs-2"></i>
                                </span>
                                <span class="menu-title">Funcionalidades</span>
                                <span class="menu-arrow d-lg-none"></span>
                            </a>
                        </div>

                        <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                            data-kt-menu-placement="bottom-start"
                            class="menu-item @if (Request::is('plans*')) here show @endif  me-0 me-lg-2">
                            <a href="{{ route('plans') }}" class="menu-link py-3">
                                <span class="menu-icon">
                                    <i class="ki-solid ki-note-2 fs-2"></i>
                                </span>
                                <span class="menu-title">Planos</span>
                                <span class="menu-arrow d-lg-none"></span>
                            </a>
                        </div>

                        <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                            data-kt-menu-placement="bottom-start"
                            class="menu-item @if (Request::is('register*')) here show @endif  me-0 me-lg-2">
                            <a href="{{ route('register') }}" class="menu-link py-3">
                                <span class="menu-icon">
                                    <i class="ki-solid ki-address-book fs-2"></i>
                                </span>
                                <span class="menu-title">Registre-se</span>
                                <span class="menu-arrow d-lg-none"></span>
                            </a>
                        </div>











                    </div>
                </div>
            </div>
            <div class="d-flex align-items-stretch flex-shrink-0">

                <div class="d-flex align-items-center ms-1 ms-lg-2">
                    <a href="#"
                        class="btn btn-icon btn-active-light btn-active-color-primary w-30px h-30px w-md-40px h-md-40px"
                        data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-attach="parent"
                        data-kt-menu-placement="bottom-end">
                        <i class="ki-duotone ki-night-day theme-light-show fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                            <span class="path5"></span>
                            <span class="path6"></span>
                            <span class="path7"></span>
                            <span class="path8"></span>
                            <span class="path9"></span>
                            <span class="path10"></span>
                        </i>
                        <i class="ki-duotone ki-moon theme-dark-show fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </a>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px"
                        data-kt-menu="true" data-kt-element="theme-mode-menu">
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                data-kt-value="light">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="ki-duotone ki-night-day fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                        <span class="path6"></span>
                                        <span class="path7"></span>
                                        <span class="path8"></span>
                                        <span class="path9"></span>
                                        <span class="path10"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Light</span>
                            </a>
                        </div>
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                data-kt-value="dark">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="ki-duotone ki-moon fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Dark</span>
                            </a>
                        </div>
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                data-kt-value="system">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="ki-duotone ki-screen fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                    </i>
                                </span>
                                <span class="menu-title">System</span>
                            </a>
                        </div>
                    </div>
                </div>

                @include('layouts.components.panel-user')

                <div class="d-flex d-lg-none align-items-center" title="Show header menu">
                    <button class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px"
                        id="kt_header_menu_mobile_toggle">
                        <i class="ki-duotone ki-text-align-left fs-1 fw-bold">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                        </i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
