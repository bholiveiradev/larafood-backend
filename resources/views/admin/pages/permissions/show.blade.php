@extends('adminlte::page')

@section('title', $permission->name)

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('admin.permissions.index') }}">Permissões</a>
        </li>
        <li class="breadcrumb-item active">
            {{ $permission->name }}
        </li>
    </ol>

    <h1>Detalhes da Permissão</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @include('admin.includes.alerts')
            <ul>
                <li>
                    <strong>Permissão:</strong> {{ $permission->name }}
                </li>
                <li>
                    <strong>Descrição:</strong> {{ $permission->description }}
                </li>
            </ul>

            <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="post" class="d-inline-block">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Deseja realmente remover?')">
                    <i class="fas fa-trash"></i>
                    <span class="ml-1 d-none d-md-inline-block text-uppercase">Deletar Permissão</span>
                </button>
            </form>
        </div>
    </div>
@stop
