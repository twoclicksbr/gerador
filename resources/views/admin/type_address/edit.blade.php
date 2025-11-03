@extends('layouts.app')

@section('title', 'Editar Tipo de Endereço')
@section('page-title', 'type_address')

@section('content')
    <div class="wrapper d-flex flex-column flex-row-fluid mt-5 mt-lg-10" id="kt_wrapper">
        <div class="content flex-column-fluid" id="kt_content">
            <div class="card mb-5 mb-xl-8">
                @include('admin.components.card-header-simple', [
                    'title' => $isTrashed ? 'Visualizando (Registro Excluído)' : 'Editar Tipo de Endereço',
                ])

                <div class="card-body">
                    <form action="{{ route('admin.module.update', ['module' => 'type_address', 'id' => $item->id]) }}"
                          method="POST">
                        @csrf
                        @method('PUT')

                        @include('admin.type_address.form', [
                            'item' => $item,
                            'isTrashed' => $isTrashed ?? false,
                            'module' => 'type_address',
                        ])
                    </form>

                    @if ($isTrashed ?? false)
                        <form id="restore-form"
                              action="{{ route('admin.module.restore', ['module' => $module ?? 'type_address', 'id' => $item->id]) }}"
                              method="POST" style="display:none;">
                            @csrf
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
