@extends('layouts.app')

@section('title', 'Nova Pessoa')
@section('page-title', 'person')

@section('content')
    <div class="wrapper d-flex flex-column flex-row-fluid mt-5 mt-lg-10" id="kt_wrapper">
        <div class="content flex-column-fluid" id="kt_content">
            <div class="card mb-5 mb-xl-8">
                @include('admin.components.card-header-simple', ['title' => 'Cadastrar Pessoa'])
                <div class="card-body">
                    <form action="{{ route('admin.module.store', ['module' => 'person']) }}" method="POST">
                        @csrf
                        @include('admin.person.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
