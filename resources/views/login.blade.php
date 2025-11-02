@extends('layouts.app')

@section('title', 'Login')
@section('page-title', 'login')

@section('content')

    <div class="d-flex flex-column flex-center justify-content-center align-items-center  w-100 py-10">
        <div class="card w-lg-600px shadow-sm">
            <div class="card-body p-lg-17">
                <div class="d-flex flex-column flex-lg-row-fluid order-2 order-lg-1 ">
                    <div class="d-flex flex-center flex-column flex-lg-row-fluid ">
                        <div class="w-lg-500px">

                            <form class="form w-100" method="POST" action="{{ route('login.submit') }}">
                                @csrf

                                <div class="text-center mb-11">
                                    <h1 class="text-gray-900 fw-bolder mb-3">Acesse sua conta</h1>
                                    <div class="text-gray-500 fw-semibold fs-6">Entre para continuar usando o
                                        DevsAPI</div>
                                </div>

                                @if ($errors->any())
                                    <div class="alert alert-danger text-center py-2 mb-5">
                                        {{ $errors->first() }}
                                    </div>
                                @endif

                                <div class="fv-row mb-8">
                                    <input type="email" placeholder="E-mail" name="email" required autocomplete="off"
                                        class="form-control bg-transparent" value="alex@twoclicks.com.br" autofocus />
                                </div>

                                <div class="fv-row mb-3">
                                    <input type="password" placeholder="Senha" name="password" required autocomplete="off"
                                        class="form-control bg-transparent" value="Millena2012@" />
                                </div>

                                <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                    <div></div>
                                    <a href="#" class="link-primary">Esqueceu a senha?</a>
                                </div>

                                <div class="d-grid mb-10">
                                    <button type="submit" class="btn btn-primary">
                                        <span class="indicator-label">Entrar</span>
                                        <span class="indicator-progress">Aguarde...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                </div>

                                <div class="text-gray-500 text-center fw-semibold fs-6">
                                    Ainda não é membro?
                                    <a href="{{ route('register') }}" class="link-primary">Registre-se</a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
