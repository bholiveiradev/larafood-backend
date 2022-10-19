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
        <li class="breadcrumb-item active">
            {{ $user->name }}
        </li>
    </ol>

    <h1>Detalhes do Perfil</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @include('admin.includes.alerts')
            <ul>
                <li>
                    <strong>Nome:</strong> {{ $user->name }}
                </li>
                <li>
                    <strong>Email:</strong> {{ $user->email }}
                </li>
                <li>
                    <strong>Empresa:</strong> {{ $user->company->name }}
                </li>
            </ul>

            <form action="{{ route('admin.users.destroy', $user->id) }}" method="post" class="d-inline-block">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Deseja realmente remover?')">
                    <i class="fas fa-trash"></i>
                    <span class="ml-1 d-none d-md-inline-block text-uppercase">Deletar Usuário</span>
                </button>
            </form>
        </div>
    </div>
@stop
