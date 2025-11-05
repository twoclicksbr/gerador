@extends('layouts.app')

@section('title', 'Tokens')
@section('page-title', 'token')

@section('content')

    <div class="wrapper d-flex flex-column flex-row-fluid mt-5 mt-lg-10" id="kt_wrapper">
        <div class="content flex-column-fluid" id="kt_content">

            <div class="card mb-5 mb-xl-8">

                @include('admin.components.card-header-module', [
                    'count' => $count ?? 0,
                    'module' => $module ?? 'token',
                ])

                <div class="card-body py-3">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-4">
                            <thead>
                            <tr class="fw-bold text-muted bg-light">
                                {{-- <th style="width: 10%">Credencial</th> --}}
                                <th class="ps-4" style="width: 20%">Projeto</th>
                                <th style="width: 10%">Ambiente</th>
                                <th class="ps-4 min-w-250px rounded-start">Token</th>

                                <th style="width: 15%">Status</th>
                                <th class="text-end pe-4 rounded-end" style="width: 5%">Ações</th>
                            </tr>
                            </thead>

                            @php
                                $grouped = $items->groupBy(fn($item) => $item->credential->name ?? 'Sem Credencial');
                            @endphp

                            <tbody>
                            @forelse ($grouped as $credentialName => $tokens)
                                {{-- Cabeçalho do grupo --}}
                                <tr class="bg-light-primary">
                                    <td colspan="5" class="fw-bold text-primary fs-6 ps-4">
                                        {{ $credentialName }}
                                    </td>
                                </tr>

                                {{-- Tokens da credencial --}}
                                @foreach ($tokens as $item)
                                    <tr class="{{ $item->trashed() ? 'bg-dark bg-opacity-10' : '' }}">
                                        {{-- <td>{{ $item->credential->name ?? '—' }}</td> --}}

                                        {{-- Projeto 🆕 --}}
                                        <td class="text-nowrap ps-4">
                                            <a href="{{ route('admin.module.edit', ['module' => 'token', 'id' => $item->id]) }}"
                                               class="fw-semibold fs-6 text-hover-primary {{ $item->trashed() ? 'text-gray-500 text-decoration-line-through' : 'text-primary' }}">
                                                {{ $item->project->name ?? '—' }}
                                            </a>

                                        </td>

                                        <td>
                                            <span class="badge {{ $item->environment === 'sandbox' ? 'badge-light-warning' : 'badge-light-info' }}">
                                                {{ $item->environment === 'sandbox' ? 'Sandbox' : 'Produção' }}
                                            </span>
                                        </td>

                                        <td class="ps-4">
                                            <button type="button"
                                                    class="btn btn-icon btn-light btn-sm me-2"
                                                    data-clipboard-text="{{ $item->token }}"
                                                    title="Copiar token">
                                                <i class="ki-outline ki-copy fs-3"></i>
                                            </button>
                                            {{ \Illuminate\Support\Str::limit($item->token, 40) }}

                                            <script src="https://cdn.jsdelivr.net/npm/clipboard@2/dist/clipboard.min.js"></script>
                                            <script>
                                                document.addEventListener('DOMContentLoaded', function () {
                                                    const clipboard = new ClipboardJS('[data-clipboard-text]');
                                                    clipboard.on('success', function(e) {
                                                        const btn = e.trigger;
                                                        const icon = btn.querySelector('i');
                                                        icon.classList.remove('ki-copy');
                                                        icon.classList.add('ki-check', 'text-success');
                                                        setTimeout(() => {
                                                            icon.classList.remove('ki-check', 'text-success');
                                                            icon.classList.add('ki-copy');
                                                        }, 1500);
                                                    });
                                                });
                                            </script>
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
                                                        action="{{ route('admin.module.restore', ['module' => 'token', 'id' => $item->id]) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Deseja restaurar este token?')">
                                                        @csrf
                                                        <button type="submit"
                                                                class="btn btn-icon btn-light-success btn-sm"
                                                                title="Restaurar">
                                                            <i class="ki-outline ki-arrow-circle-left fs-3"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <a href="{{ route('admin.module.edit', ['module' => 'token', 'id' => $item->id]) }}"
                                                       class="btn btn-icon btn-light-warning btn-sm me-1"
                                                       title="Editar">
                                                        <i class="ki-outline ki-pencil fs-3"></i>
                                                    </a>
                                                    <form
                                                        action="{{ route('admin.module.destroy', ['module' => 'token', 'id' => $item->id]) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Deseja excluir este token?')">
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
                                @endforeach
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-10">Nenhum token encontrado.</td>
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
