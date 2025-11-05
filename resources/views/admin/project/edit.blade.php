@extends('layouts.app')

@section('title', 'Editar Projeto')
@section('page-title', 'project')

@section('content')
    <div class="wrapper d-flex flex-column flex-row-fluid mt-5 mt-lg-10" id="kt_wrapper">
        <div class="content flex-column-fluid" id="kt_content">
            <div class="card mb-5 mb-xl-8">
                @include('admin.components.card-header-simple', [
                    'title' => $isTrashed ? 'Visualizando (Projeto Excluído)' : 'Editar Projeto',
                ])

                <div class="card-body">
                    <form action="{{ route('admin.module.update', ['module' => 'project', 'id' => $item->id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        @include('admin.project.form', [
                            'item' => $item,
                            'isTrashed' => $isTrashed ?? false,
                            'module' => 'project',
                        ])
                    </form>

                    @if ($isTrashed ?? false)
                        <form id="restore-form"
                              action="{{ route('admin.module.restore', ['module' => $module ?? 'project', 'id' => $item->id]) }}"
                              method="POST" style="display:none;">
                            @csrf
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
