@extends('layouts.app')

@section('title', 'Tipos de Endereço')
@section('page-title', 'type_address')

@section('content')

    <div class="wrapper d-flex flex-column flex-row-fluid mt-5 mt-lg-10" id="kt_wrapper">
        <div class="content flex-column-fluid" id="kt_content">

            <div class="card mb-5 mb-xl-8">

                @include('admin.components.card-header-module', [
                    'count' => $count ?? 0,
                    'module' => $module ?? 'type_address',
                ])

                <div class="card-body py-3">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-4">
                            <thead>
                            <tr class="fw-bold text-muted bg-light">
                                <th class="ps-4 min-w-250px rounded-start">Nome</th>
                                <th style="width: 15%">Status</th>
                                <th class="text-end pe-4 rounded-end" style="width: 5%">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($items as $item)
                                <tr class="{{ $item->trashed() ? 'bg-dark bg-opacity-10' : '' }}">
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="ms-3">
                                                <a href="{{ route('admin.module.edit', ['module' => 'type_address', 'id' => $item->id]) }}"
                                                   class="fw-semibold fs-6 text-hover-primary
                                                        {{ $item->trashed() ? 'text-gray-500 text-decoration-line-through' : 'text-primary' }}">
                                                    {{ $item->name }}
                                                </a>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        @if ($item->trashed())
                                            <span class="badge badge-light-warning fs-7 fw-bold">Excluído</span>
                                        @elseif ($item->active)
                                            <span class="badge badge-light-success fs-7 fw-bold">Ativo</span>
                                        @else
                                            <span class="badge badge-light-danger fs-7 fw-bold">Inativo</span>
                                        @endif
                                    </td>

                                    <td class="text-end pe-4">
                                        <div class="d-flex justify-content-end">
                                            @if ($item->trashed())
                                                <form
                                                    action="{{ route('admin.module.restore', ['module' => 'type_address', 'id' => $item->id]) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Deseja restaurar este registro?')">
                                                    @csrf
                                                    <button type="submit" class="btn btn-icon btn-light-success btn-sm"
                                                            data-bs-toggle="tooltip" data-bs-placement="left"
                                                            title="Restaurar">
                                                        <i class="ki-outline ki-arrow-circle-left fs-3"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <a href="{{ route('admin.module.edit', ['module' => 'type_address', 'id' => $item->id]) }}"
                                                   class="btn btn-icon btn-light-warning btn-sm me-1"
                                                   data-bs-toggle="tooltip" data-bs-placement="top" title="Editar">
                                                    <i class="ki-outline ki-pencil fs-3"></i>
                                                </a>
                                                <form
                                                    action="{{ route('admin.module.destroy', ['module' => 'type_address', 'id' => $item->id]) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Deseja excluir este registro?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-icon btn-light-danger btn-sm"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Excluir">
                                                        <i class="ki-solid ki-trash fs-3"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-10">Nenhum registro encontrado.
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
