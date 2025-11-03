@extends('layouts.app')

@section('title', 'Novo Tipo de Endereço')
@section('page-title', 'type_address')

@section('content')
    <div class="wrapper d-flex flex-column flex-row-fluid mt-5 mt-lg-10" id="kt_wrapper">
        <div class="content flex-column-fluid" id="kt_content">
            <div class="card mb-5 mb-xl-8">
                @include('admin.components.card-header-simple', ['title' => 'Cadastrar Tipo de Endereço'])
                <div class="card-body">
                    <form action="{{ route('admin.module.store', ['module' => 'type_address']) }}" method="POST">
                        @csrf
                        @include('admin.type_address.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
