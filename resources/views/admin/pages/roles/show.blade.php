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
        <li class="breadcrumb-item active">
            {{ $role->name }}
        </li>
    </ol>

    <h1>Detalhes do Cargo</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @include('admin.includes.alerts')
            <ul>
                <li>
                    <strong>Nome:</strong> {{ $role->name }}
                </li>
                <li>
                    <strong>Descrição:</strong> {{ $role->description }}
                </li>
            </ul>

            <a href="{{ route('admin.roles.permissions.index', $role->id) }}" class="btn btn-outline-primary btn-sm">
                <i class="fas fa-lock"></i>
                <span class="ml-1 d-none d-md-inline-block text-uppercase">Permissões</span>
            </a>

            <form action="{{ route('admin.roles.destroy', $role->id) }}" method="post" class="d-inline-block">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Deseja realmente remover?')">
                    <i class="fas fa-trash"></i>
                    <span class="ml-1 d-none d-md-inline-block text-uppercase">Deletar Cargo</span>
                </button>
            </form>
        </div>
    </div>
@stop
