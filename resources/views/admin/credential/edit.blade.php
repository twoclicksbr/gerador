@extends('layouts.app')

@section('title', 'Editar Credencial')
@section('page-title', 'credential')

@section('content')
    <div class="wrapper d-flex flex-column flex-row-fluid mt-5 mt-lg-10" id="kt_wrapper">
        <div class="content flex-column-fluid" id="kt_content">
            <div class="card mb-5 mb-xl-8">
                @include('admin.components.card-header-simple', [
                    'title' => $isTrashed ? 'Visualizando (Registro Excluido)' : 'Editar Credencial',
                ])

                <div class="card-body">
                    <form action="{{ route('admin.module.update', ['module' => 'credential', 'id' => $item->id]) }}"
                        method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Form dinâmico (bloqueia se for soft deleted) --}}
                        @include('admin.credential.form', [
                            'item' => $item,
                            'isTrashed' => $isTrashed ?? false,
                        ])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
