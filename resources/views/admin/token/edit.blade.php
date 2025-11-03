@extends('layouts.app')

@section('title', 'Editar Token')
@section('page-title', 'token')

@section('content')
    <div class="wrapper d-flex flex-column flex-row-fluid mt-5 mt-lg-10" id="kt_wrapper">
        <div class="content flex-column-fluid" id="kt_content">
            <div class="card mb-5 mb-xl-8">
                @include('admin.components.card-header-simple', [
                    'title' => $isTrashed ? 'Visualizando (Token Excluído)' : 'Editar Token',
                ])

                <div class="card-body">
                    <form action="{{ route('admin.module.update', ['module' => 'token', 'id' => $item->id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        @include('admin.token.form', [
                            'item' => $item,
                            'isTrashed' => $isTrashed ?? false,
                            'module' => 'token',
                        ])
                    </form>

                    @if ($isTrashed ?? false)
                        <form id="restore-form"
                              action="{{ route('admin.module.restore', ['module' => $module ?? 'token', 'id' => $item->id]) }}"
                              method="POST" style="display:none;">
                            @csrf
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
