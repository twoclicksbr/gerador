@extends('layouts.app')

@section('title', 'Editar Pessoa')
@section('page-title', 'person')

@section('content')
    <div class="wrapper d-flex flex-column flex-row-fluid mt-5 mt-lg-10" id="kt_wrapper">
        <div class="content flex-column-fluid" id="kt_content">
            <div class="card mb-5 mb-xl-8">
                @include('admin.components.card-header-simple', [
                    'title' => $isTrashed ? 'Visualizando (Registro Excluído)' : 'Editar Pessoa',
                ])

                <div class="card-body">
                    <form action="{{ route('admin.module.update', ['module' => 'person', 'id' => $item->id]) }}"
                        method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Form dinâmico (bloqueia se for soft deleted) --}}
                        @include('admin.person.form', [
                            'item' => $item,
                            'isTrashed' => $isTrashed ?? false,
                            'module' => 'person',
                        ])
                    </form>

                    {{-- ⚙️ Form de restauração fora do form principal --}}
                    @if ($isTrashed ?? false)
                        <form id="restore-form"
                              action="{{ route('admin.module.restore', ['module' => $module ?? 'person', 'id' => $item->id]) }}"
                              method="POST" style="display:none;">
                            @csrf
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
