@extends('adminlte::page')

@section('title', $category->name)

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('admin.categories.index') }}">Categorias</a>
        </li>
        <li class="breadcrumb-item active">
            {{ $category->name }}
        </li>
    </ol>

    <h1>Detalhes da Categoria</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @include('admin.includes.alerts')
            <ul>
                <li>
                    <strong>Nome:</strong> {{ $category->name }}
                </li>
                <li>
                    <strong>URL:</strong> {{ $category->url }}
                </li>
                <li>
                    <strong>Descrição:</strong> {{ $category->description }}
                </li>
            </ul>

            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="post" class="d-inline-block">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Deseja realmente remover?')">
                    <i class="fas fa-trash"></i>
                    <span class="ml-1 d-none d-md-inline-block text-uppercase">Deletar Categoria</span>
                </button>
            </form>
        </div>
    </div>
@stop
