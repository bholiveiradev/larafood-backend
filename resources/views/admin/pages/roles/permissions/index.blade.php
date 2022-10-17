@extends('adminlte::page')

@section('title', $role->name)

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('admin.roles.index') }}">Cargos</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('admin.roles.show', $role->id) }}">{{ $role->name }}</a>
        </li>
        <li class="breadcrumb-item active">
            Permissões
        </li>
    </ol>

    <h1>Permissões do Perfil: <strong>{{ $role->name }}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.roles.permissions.available', $role->id) }}" class="btn btn-info btn-sm">
                    <i class="fas fa-plus-circle"></i>
                    <span class="ml-1 d-none d-md-inline-block text-uppercase">Adicionar Permissões</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            @include('admin.includes.alerts')
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th width="50">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($role->permissions as $permission)
                        <tr>
                            <td>{{ $permission->name }}</td>
                            <td>
                                <form action="{{ route('admin.roles.permissions.detach', [$role->id, $permission->id]) }}" method="post" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="left" title="Remover">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center font-italic">
                                Nenhum registro encontrado
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('adminlte_js')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection
