@extends('adminlte::page')

@section('title', $plan->name)

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('admin.plans.index') }}">Planos</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('admin.plans.details.index', $plan->url) }}">{{ $plan->name }}</a>
        </li>
        <li class="breadcrumb-item active">
            Cadastrar Detalhe
        </li>
    </ol>

    <h1>Cadastrar Detalhe</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.plans.details.store', $plan->url) }}" method="post" class="form">
                @include('admin.includes.alerts')
                @csrf
                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input type="text" name="name" class="form-control" placeholder="Nome:">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-sm">
                        <i class="fas fa-save"></i>
                        <span class="ml-1 d-none d-md-inline-block text-uppercase">Salvar</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@stop
