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
        <li class="breadcrumb-item">
            <a href="{{ route('admin.users.roles.index', $user->id) }}">Cargos</a>
        </li>
        <li class="breadcrumb-item active">
            Cargos Disponíveis
        </li>
    </ol>

    <h1>Cargos Disponíves</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-end">
                <form action="{{ route('admin.users.roles.search', $user->id) }}" method="post" class="form form-inline">
                    @csrf
                    <div class="input-group input-group-sm">
                        <input type="text" name="text" class="form-control" value="{{ request('text') }}" placeholder="Procurar cargo...">
                        <div class="input-group-append">
                            <button class="btn btn-outline-light">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                      </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            @include('admin.includes.alerts')
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th width="50"></th>
                        <th>Cargo</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="{{ route('admin.users.roles.attach', $user->id) }}" method="post">
                        @csrf
                        @forelse ($roles as $role)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" name="roles[]" value="{{ $role->id }}" class="form-check-input">
                                    </div>
                                </td>
                                <td>{{ $role->name }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center font-italic">
                                    Nenhum registro encontrado
                                </td>
                            </tr>
                        @endforelse
                        @if ($roles->count())
                            <tr>
                                <td colspan="2">
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fas fa-save"></i>
                                        <span class="ml-1 d-none d-md-inline-block text-uppercase">Vincular Cargos</span>
                                    </button>
                                </td>
                            </tr>
                        @endif
                    </form>
                </tbody>
            </table>
        </div>
    </div>
@stop
