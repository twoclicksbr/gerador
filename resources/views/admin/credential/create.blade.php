@extends('layouts.app')

@section('title', 'Nova Credencial')
@section('page-title', 'credential')

@section('content')
    <div class="wrapper d-flex flex-column flex-row-fluid mt-5 mt-lg-10" id="kt_wrapper">
        <div class="content flex-column-fluid" id="kt_content">
            <div class="card mb-5 mb-xl-8">
                @include('admin.components.card-header-simple', ['title' => 'Cadastrar Credencial'])
                <div class="card-body">
                    <form action="{{ route('admin.module.store', ['module' => 'credential']) }}" method="POST">
                        @csrf
                        @include('admin.credential.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
