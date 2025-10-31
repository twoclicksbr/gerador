@extends('layouts.app')

@section('title', 'Confirmação de E-mail - DevsAPI')
@section('page-title', 'features')

@section('content')

    <div class="wrapper d-flex flex-column flex-row-fluid mt-5 mt-lg-10" id="kt_wrapper">
        <div class="content flex-column-fluid" id="kt_content">
            <div class="toolbar d-flex flex-stack flex-wrap mb-5 mb-lg-7" id="kt_toolbar">
                <div class="page-title d-flex flex-column py-1">

                    <h1 class="d-flex align-items-center my-1">
                        <span class="text-gray-900 fw-bold fs-1">Confirmação de E-mail</span>
                    </h1>

                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('home') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-200 w-5px h-2px"></span>
                        </li>

                        <li class="breadcrumb-item text-gray-900">Registre-se</li>

                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-200 w-5px h-2px"></span>
                        </li>

                        <li class="breadcrumb-item text-gray-900">Confirmação de E-mail</li>
                    </ul>
                </div>

            </div>
            <div class="post" id="kt_post">
                <div class="card">
                    <div class="card-body p-lg-17">

                        {{-- @include('layouts.components.banner') --}}

                        <div class="position-relative mb-17">
                            <div class="overlay overlay-show">

                                <h1 class="fs-2x fw-bold text-gray-900 mb-0 me-1">
                                    E-mail de confirmação.
                                </h1>

                                <div class="fs-4 fw-normal text-gray-800 mb-5">
                                    <p class="mt-10">Oi {{ $name }}, {{ $email }}</p>

                                    <p>Enviamos um e-mail com um código de verifiação, informe abaixo para confiramação.</p>

                                    <form method="POST" action="{{ route('confirm.email') }}">
                                        @csrf

                                        <div class="col-12 col-md-5 d-flex flex-wrap flex-stack mb-10">

                                            <input type="hidden" name="email" value="{{ $email }}">

                                            <input type="text" name="code_1"
                                                data-inputmask="'mask': '9', 'placeholder': ''"
                                                class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2"
                                                value="" inputmode="text" data-gtm-form-interact-field-id="0"
                                                style="background-color: #d4d4d4; color: #4f4f4f">
                                            <input type="text" name="code_2"
                                                data-inputmask="'mask': '9', 'placeholder': ''"
                                                class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2"
                                                value="" inputmode="text"
                                                style="background-color: #d4d4d4; color: #4f4f4f">
                                            <input type="text" name="code_3"
                                                data-inputmask="'mask': '9', 'placeholder': ''"
                                                class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2"
                                                value="" inputmode="text"
                                                style="background-color: #d4d4d4; color: #4f4f4f">
                                            <input type="text" name="code_4"
                                                data-inputmask="'mask': '9', 'placeholder': ''"
                                                class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2"
                                                value="" inputmode="text"
                                                style="background-color: #d4d4d4; color: #4f4f4f">
                                            <input type="text" name="code_5"
                                                data-inputmask="'mask': '9', 'placeholder': ''"
                                                class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2"
                                                value="" inputmode="text"
                                                style="background-color: #d4d4d4; color: #4f4f4f">
                                            <input type="text" name="code_6"
                                                data-inputmask="'mask': '9', 'placeholder': ''"
                                                class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2"
                                                value="" inputmode="text"
                                                style="background-color: #d4d4d4; color: #4f4f4f">
                                        </div>

                                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                const inputs = document.querySelectorAll('input[name^="code_"]');
                                                if (inputs.length) inputs[0].focus();

                                                inputs.forEach((input, index) => {
                                                    input.addEventListener("input", function() {
                                                        if (this.value.length === 1 && index < inputs.length - 1) {
                                                            inputs[index + 1].focus();
                                                        } else if (this.value.length === 1 && index === inputs.length - 1) {
                                                            this.form?.submit();
                                                        }
                                                    });

                                                    input.addEventListener("keydown", function(e) {
                                                        if (e.key === "Backspace" && !this.value && index > 0) {
                                                            inputs[index - 1].focus();
                                                        }
                                                    });

                                                    input.addEventListener("paste", function(e) {
                                                        e.preventDefault();
                                                        const paste = (e.clipboardData || window.clipboardData)
                                                            .getData("text")
                                                            .replace(/\D/g, "")
                                                            .slice(0, inputs.length);

                                                        inputs.forEach(i => i.value = ""); // limpa antes de preencher

                                                        paste.split("").forEach((digit, i) => {
                                                            if (inputs[i]) inputs[i].value = digit;
                                                        });

                                                        if (paste.length >= inputs.length) {
                                                            this.form?.submit();
                                                        } else if (inputs[paste.length]) {
                                                            inputs[paste.length].focus();
                                                        }
                                                    });
                                                });
                                            });
                                        </script>


                                    </form>


                                    <p>Não recebeu o e-mail? Verifique a pasta Spam.</p>

                                    <button class="btn btn-light-primary">Reenviar e-mail de confirmação</button>
                                </div>

                            </div>

                        </div>

                        @include('layouts.components.social')

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
