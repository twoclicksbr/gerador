@extends('layouts.app')

@section('title', 'Sobre nós - DevsAPI')
@section('page-title', 'about')

@section('content')

    <div class="wrapper d-flex flex-column flex-row-fluid mt-5 mt-lg-10" id="kt_wrapper">
        <div class="content flex-column-fluid" id="kt_content">
            <div class="toolbar d-flex flex-stack flex-wrap mb-5 mb-lg-7" id="kt_toolbar">
                <div class="page-title d-flex flex-column py-1">
                    <h1 class="d-flex align-items-center my-1">
                        <span class="text-gray-900 fw-bold fs-1">Sobre o DevsAPI</span>
                    </h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('home') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-200 w-5px h-2px"></span>
                        </li>

                        <li class="breadcrumb-item text-gray-900">Sobre nós</li>
                    </ul>
                </div>

            </div>
            <div class="post" id="kt_post">
                <div class="card">
                    <div class="card-body p-lg-17">
                        <div class="mb-18">
                            <div class="mb-10">
                                <div class="text-center mb-15">
                                    <h3 class="fs-2hx text-gray-900 mb-5">Sobre o DevsAPI</h3>
                                    <div class="fs-2 text-muted fw-semibold">
                                        O DevsAPI transforma ideias em sistemas prontos em poucos minutos.
                                        <br>
                                        Automatize o código, mantenha o padrão e ganhe tempo para inovar.
                                    </div>
                                </div>
                                <div class="overlay">
                                    <img class="w-100 card-rounded" src="assets/media/stock/1600x800/img-1.jpg"
                                        alt="" />
                                    <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                        <a href="{{ route('plans') }}" class="btn btn-primary">Planos</a>
                                        <a href="{{ route('register') }}" class="btn btn-light-primary ms-3">Criar Conta</a>
                                    </div>
                                </div>
                            </div>
                            <div class="fs-3 fw-semibold text-gray-800">
                                <p class="mb-8">
                                    O DevsAPI nasceu para simplificar o desenvolvimento e dar poder às ideias.
                                </p>
                                <p class="mb-8">
                                    Criamos uma plataforma que transforma a forma como sistemas são construídos — reduzindo
                                    semanas de trabalho a poucos minutos.
                                </p>
                                <p class="mb-8">
                                    Nosso objetivo é libertar o desenvolvedor da repetição e entregar uma experiência
                                    fluida, onde cada módulo, API e tela nasce pronta para evoluir.
                                </p>
                                <p class="mb-8">
                                    O DevsAPI entende a rotina de quem cria. Por isso, automatiza o que é técnico, mas
                                    preserva o que é criativo. Você define os campos, relacionamentos e regras — nós geramos
                                    todo o código com padrão, segurança e performance.
                                </p>
                                <p class="mb-8">
                                    É mais que um gerador de código: é um ambiente completo de produtividade para quem
                                    acredita que tecnologia deve acelerar sonhos, não complicá-los.
                                </p>



                            </div>
                        </div>
                        <div class="card bg-light mb-18">
                            <div class="card-body py-15">
                                <div class="d-flex flex-center">
                                    <div class="d-flex flex-center flex-wrap mb-10 mx-auto gap-5 w-xl-900px">

                                        <div class="octagon d-flex flex-center h-200px w-200px bg-body mx-lg-10">
                                            <div class="text-center">
                                                <i class="ki-duotone ki-element-11 fs-2tx text-primary">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                </i>
                                                <div class="mt-1">
                                                    <div
                                                        class="fs-lg-2hx fs-2x fw-bold text-gray-800 d-flex align-items-center">
                                                        <div class="min-w-70px" data-kt-countup="true"
                                                            data-kt-countup-value="700">0</div>+
                                                    </div>
                                                    <span class="text-gray-600 fw-semibold fs-5 lh-0">
                                                        Módulos <br> Gerados
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="octagon d-flex flex-center h-200px w-200px bg-body mx-lg-10">
                                            <div class="text-center">
                                                <i class="ki-duotone ki-chart-pie-4 fs-2tx text-success">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                                <div class="mt-1">
                                                    <div
                                                        class="fs-lg-2hx fs-2x fw-bold text-gray-800 d-flex align-items-center">
                                                        <div class="min-w-50px" data-kt-countup="true"
                                                            data-kt-countup-value="80">0</div>K+
                                                    </div>
                                                    <span class="text-gray-600 fw-semibold fs-5 lh-0">
                                                        Linhas <br>
                                                        Otimizadas
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="octagon d-flex flex-center h-200px w-200px bg-body mx-lg-10">
                                            <div class="text-center">
                                                <i class="ki-duotone ki-basket fs-2tx text-info">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                </i>
                                                <div class="mt-1">
                                                    <div
                                                        class="fs-lg-2hx fs-2x fw-bold text-gray-800 d-flex align-items-center">
                                                        <div class="min-w-50px" data-kt-countup="true"
                                                            data-kt-countup-value="35">0</div>M+
                                                    </div>
                                                    <span class="text-gray-600 fw-semibold fs-5 lh-0">
                                                        Requisições <br> Processadas
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="fs-2 fw-semibold text-muted text-center mb-3">
                                    <span class="fs-1 lh-1 text-gray-700">“</span>
                                    Automatizar é libertar o desenvolvedor da repetição —
                                    <br />
                                    <span class="text-gray-700 me-1">para focar no que realmente importa:</span> criar.
                                    <span class="fs-1 lh-1 text-gray-700">“</span>
                                </div>

                                <div class="fs-2 fw-semibold text-muted text-center">
                                    <a href="#" class="link-primary fs-4 fw-bold">DevsAPI</a>
                                    <span class="fs-4 fw-bold text-gray-600">, by TwoClicks</span>
                                </div>
                            </div>
                        </div>



                        <div class="mb-16">
                            <div class="text-center mb-12">
                                <h3 class="fs-2hx text-gray-900 mb-5">Missão, Visão e Valores</h3>
                                <div class="fs-5 text-muted fw-semibold">
                                    O propósito do DevsAPI é impulsionar o desenvolvimento com propósito,
                                    <br />transformando ideias em soluções reais com agilidade, qualidade e simplicidade.
                                </div>
                            </div>

                            <div class="row g-10">
                                <!-- Missão -->
                                <div class="col-md-4">
                                    <div class="card-xl-stretch me-md-6">
                                        <div
                                            class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px bg-light-primary d-flex align-items-center justify-content-center">
                                            <i class="ki-duotone ki-focus fs-4tx text-primary">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                            </i>
                                        </div>
                                        <div class="m-0 mt-5 text-center">
                                            <h4 class="fs-4 text-gray-900 fw-bold mb-3">Missão</h4>
                                            <div class="fw-semibold fs-5 text-gray-600">
                                                Simplificar a criação de sistemas e APIs, automatizando o que é técnico
                                                para que desenvolvedores e equipes foquem na inovação e no impacto das
                                                ideias.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Visão -->
                                <div class="col-md-4">
                                    <div class="card-xl-stretch mx-md-3">
                                        <div
                                            class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px bg-light-success d-flex align-items-center justify-content-center">
                                            <i class="ki-duotone ki-eye fs-4tx text-success">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                            </i>
                                        </div>
                                        <div class="m-0 mt-5 text-center">
                                            <h4 class="fs-4 text-gray-900 fw-bold mb-3">Visão</h4>
                                            <div class="fw-semibold fs-5 text-gray-600">
                                                Ser a principal plataforma de automação de código da América Latina,
                                                reconhecida por acelerar o desenvolvimento e elevar o padrão de qualidade de
                                                software.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Valores -->
                                <div class="col-md-4">
                                    <div class="card-xl-stretch ms-md-6">
                                        <div
                                            class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px bg-light-info d-flex align-items-center justify-content-center">
                                            <i class="ki-duotone ki-chart-simple-2 fs-4tx text-info">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                            </i>
                                        </div>
                                        <div class="m-0 mt-5 text-center">
                                            <h4 class="fs-4 text-gray-900 fw-bold mb-3">Valores</h4>
                                            <div class="fw-semibold fs-5 text-gray-600">
                                                Inovação constante, colaboração, ética, e compromisso com resultados.
                                                Valorizamos o tempo do desenvolvedor e acreditamos que tecnologia deve
                                                simplificar.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        {{-- <div class="mb-18">
                            <div class="text-center mb-12">
                                <h3 class="fs-2hx text-gray-900 mb-5">Our Great Team</h3>
                                <div class="fs-5 text-muted fw-semibold">It’s no doubt that when a development takes longer
                                    to complete, additional costs to
                                    <br />integrate and test each extra feature creeps up and haunts most of us.
                                </div>
                            </div>
                            <div class="tns tns-default mb-10">
                                <div data-tns="true" data-tns-loop="true" data-tns-swipe-angle="false"
                                    data-tns-speed="2000" data-tns-autoplay="true" data-tns-autoplay-timeout="18000"
                                    data-tns-controls="true" data-tns-nav="false" data-tns-items="1"
                                    data-tns-center="false" data-tns-dots="false"
                                    data-tns-prev-button="#kt_team_slider_prev"
                                    data-tns-next-button="#kt_team_slider_next"
                                    data-tns-responsive="{1200: {items: 3}, 992: {items: 2}}">
                                    <div class="text-center">
                                        <div class="octagon mx-auto mb-5 d-flex w-200px h-200px bgi-no-repeat bgi-size-contain bgi-position-center"
                                            style="background-image:url('assets/media/avatars/300-1.jpg')"></div>
                                        <div class="mb-0">
                                            <a href="#" class="text-gray-900 fw-bold text-hover-primary fs-3">Paul
                                                Miles</a>
                                            <div class="text-muted fs-6 fw-semibold mt-1">Development Lead</div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <div class="octagon mx-auto mb-5 d-flex w-200px h-200px bgi-no-repeat bgi-size-contain bgi-position-center"
                                            style="background-image:url('assets/media/avatars/300-2.jpg')"></div>
                                        <div class="mb-0">
                                            <a href="#" class="text-gray-900 fw-bold text-hover-primary fs-3">Melisa
                                                Marcus</a>
                                            <div class="text-muted fs-6 fw-semibold mt-1">Creative Director</div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <div class="octagon mx-auto mb-5 d-flex w-200px h-200px bgi-no-repeat bgi-size-contain bgi-position-center"
                                            style="background-image:url('assets/media/avatars/300-5.jpg')"></div>
                                        <div class="mb-0">
                                            <a href="#" class="text-gray-900 fw-bold text-hover-primary fs-3">David
                                                Nilson</a>
                                            <div class="text-muted fs-6 fw-semibold mt-1">Python Expert</div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <div class="octagon mx-auto mb-5 d-flex w-200px h-200px bgi-no-repeat bgi-size-contain bgi-position-center"
                                            style="background-image:url('assets/media/avatars/300-20.jpg')"></div>
                                        <div class="mb-0">
                                            <a href="#" class="text-gray-900 fw-bold text-hover-primary fs-3">Anne
                                                Clarc</a>
                                            <div class="text-muted fs-6 fw-semibold mt-1">Project Manager</div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <div class="octagon mx-auto mb-5 d-flex w-200px h-200px bgi-no-repeat bgi-size-contain bgi-position-center"
                                            style="background-image:url('assets/media/avatars/300-23.jpg')"></div>
                                        <div class="mb-0">
                                            <a href="#" class="text-gray-900 fw-bold text-hover-primary fs-3">Ricky
                                                Hunt</a>
                                            <div class="text-muted fs-6 fw-semibold mt-1">Art Director</div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <div class="octagon mx-auto mb-5 d-flex w-200px h-200px bgi-no-repeat bgi-size-contain bgi-position-center"
                                            style="background-image:url('assets/media/avatars/300-12.jpg')"></div>
                                        <div class="mb-0">
                                            <a href="#" class="text-gray-900 fw-bold text-hover-primary fs-3">Alice
                                                Wayde</a>
                                            <div class="text-muted fs-6 fw-semibold mt-1">Marketing Manager</div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <div class="octagon mx-auto mb-5 d-flex w-200px h-200px bgi-no-repeat bgi-size-contain bgi-position-center"
                                            style="background-image:url('assets/media/avatars/300-9.jpg')"></div>
                                        <div class="mb-0">
                                            <a href="#" class="text-gray-900 fw-bold text-hover-primary fs-3">Carles
                                                Puyol</a>
                                            <div class="text-muted fs-6 fw-semibold mt-1">QA Managers</div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-icon btn-active-color-primary" id="kt_team_slider_prev">
                                    <i class="ki-duotone ki-left fs-3x"></i>
                                </button>
                                <button class="btn btn-icon btn-active-color-primary" id="kt_team_slider_next">
                                    <i class="ki-duotone ki-right fs-3x"></i>
                                </button>
                            </div>
                        </div> --}}

                        @include('layouts.components.social')

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
