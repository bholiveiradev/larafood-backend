@extends('adminlte::page')

@section('title', $table->identifier)

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('admin.tables.index') }}">Mesas</a>
        </li>
        <li class="breadcrumb-item active">
            {{ $table->identifier }}
        </li>
    </ol>

    <h1>Detalhes da Mesa</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @include('admin.includes.alerts')
            <ul>
                <li>
                    <strong>Identificador:</strong> {{ $table->identifier }}
                </li>
                <li>
                    <strong>Descrição:</strong> {{ $table->description }}
                </li>
            </ul>

            <form action="{{ route('admin.tables.destroy', $table->id) }}" method="post" class="d-inline-block">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">
                    <i class="fas fa-trash"></i>
                    <span class="ml-1 d-none d-md-inline-block text-uppercase">Deletar Mesa</span>
                </button>
            </form>
        </div>
    </div>
@stop
