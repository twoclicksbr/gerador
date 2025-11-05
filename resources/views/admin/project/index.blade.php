@extends('layouts.app')

@section('title', 'Projetos')
@section('page-title', 'project')

@section('content')

    <div class="wrapper d-flex flex-column flex-row-fluid mt-5 mt-lg-10" id="kt_wrapper">
        <div class="content flex-column-fluid" id="kt_content">

            <div class="card mb-5 mb-xl-8">

                @include('admin.components.card-header-module', [
                    'count' => $count ?? 0,
                    'module' => $module ?? 'project',
                ])

                <div class="card-body py-3">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-4">
                            <thead>
                            <tr class="fw-bold text-muted bg-light">
                                <th class="ps-4 min-w-200px rounded-start">Nome</th>
                                <th style="width: 15%">Slug</th>
                                <th style="width: 15%">Credencial</th>
                                <th style="width: 10%">Status</th>
                                <th class="text-end pe-4 rounded-end" style="width: 10%">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($items as $item)
                                <tr class="{{ $item->trashed() ? 'bg-dark bg-opacity-10' : '' }}">
                                    {{-- Nome --}}
                                    <td class="ps-4">
                                        <a href="{{ route('admin.module.edit', ['module' => 'project', 'id' => $item->id]) }}"
                                           class="fw-semibold fs-6 text-hover-primary {{ $item->trashed() ? 'text-gray-500 text-decoration-line-through' : 'text-primary' }}">
                                            {{ $item->name }}
                                        </a>
                                    </td>

                                    {{-- Slug --}}
                                    <td>{{ $item->slug }}</td>

                                    {{-- Credencial --}}
                                    <td>{{ $item->credential->name ?? '—' }}</td>

                                    {{-- Status --}}
                                    <td>
                                        @if ($item->trashed())
                                            <span class="badge badge-light-warning fs-7 fw-bold">Excluído</span>
                                        @elseif ($item->active)
                                            <span class="badge badge-light-success fs-7 fw-bold">Ativo</span>
                                        @else
                                            <span class="badge badge-light-danger fs-7 fw-bold">Inativo</span>
                                        @endif
                                    </td>

                                    {{-- Ações --}}
                                    <td class="text-end pe-4">
                                        <div class="d-flex justify-content-end">
                                            @if ($item->trashed())
                                                <form action="{{ route('admin.module.restore', ['module' => 'project', 'id' => $item->id]) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Deseja restaurar este projeto?')">
                                                    @csrf
                                                    <button type="submit"
                                                            class="btn btn-icon btn-light-success btn-sm"
                                                            title="Restaurar">
                                                        <i class="ki-outline ki-arrow-circle-left fs-3"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <a href="{{ route('admin.module.edit', ['module' => 'project', 'id' => $item->id]) }}"
                                                   class="btn btn-icon btn-light-warning btn-sm me-1"
                                                   title="Editar">
                                                    <i class="ki-outline ki-pencil fs-3"></i>
                                                </a>
                                                <form action="{{ route('admin.module.destroy', ['module' => 'project', 'id' => $item->id]) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Deseja excluir este projeto?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="btn btn-icon btn-light-danger btn-sm"
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
                                    <td colspan="5" class="text-center text-muted py-10">
                                        Nenhum projeto encontrado.
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
