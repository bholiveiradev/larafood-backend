@extends('adminlte::page')

@section('title', $user->name)

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('admin.users.index') }}">Usuários</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('admin.users.show', $user->id) }}">{{ $user->name }}</a>
        </li>
        <li class="breadcrumb-item active">
            Cargos
        </li>
    </ol>

    <h1>Cargos do Perfil: <strong>{{ $user->name }}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.users.roles.available', $user->id) }}" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-plus-circle"></i>
                    <span class="ml-1 d-none d-md-inline-block text-uppercase">Adicionar Cargos</span>
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
                    @forelse ($user->roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>
                                <form action="{{ route('admin.users.roles.detach', [$user->id, $role->id]) }}" method="post" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="left" title="Remover">
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
