@extends('adminlte::page')

@section('title', $profile->name)

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('admin.profiles.index') }}">Perfis</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('admin.profiles.show', $profile->id) }}">{{ $profile->name }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('admin.profiles.permissions.index', $profile->id) }}">Permissões</a>
        </li>
        <li class="breadcrumb-item active">
            Permissões Disponíveis
        </li>
    </ol>

    <h1>Permissões Disponíves</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-end">
                <form action="{{ route('admin.profiles.permissions.search', $profile->id) }}" method="post" class="form form-inline">
                    @csrf
                    <div class="input-group input-group-sm">
                        <input type="text" name="text" class="form-control" value="{{ request('text') }}" placeholder="Procurar permissão...">
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
                        <th>Permissão</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="{{ route('admin.profiles.permissions.attach', $profile->id) }}" method="post">
                        @csrf
                        @forelse ($permissions as $permission)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="form-check-input">
                                    </div>
                                </td>
                                <td>{{ $permission->name }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center font-italic">
                                    Nenhum registro encontrado
                                </td>
                            </tr>
                        @endforelse
                        @if ($permissions->count())
                            <tr>
                                <td colspan="2">
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fas fa-save"></i>
                                        <span class="ml-1 d-none d-md-inline-block text-uppercase">Vincular Permissões</span>
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
