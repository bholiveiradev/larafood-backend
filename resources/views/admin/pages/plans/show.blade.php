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
        <li class="breadcrumb-item active">
            {{ $plan->name }}
        </li>
    </ol>

    <h1>Detalhes do Plano</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @include('admin.includes.alerts')
            <ul>
                <li>
                    <strong>Nome:</strong> {{ $plan->name }}
                </li>
                <li>
                    <strong>URL:</strong> {{ $plan->url }}
                </li>
                <li>
                    <strong>Preço:</strong> {{ number_format($plan->price, 2, ',', '.') }}
                </li>
                <li>
                    <strong>Descrição:</strong> {{ $plan->description }}
                </li>
            </ul>

            <a href="{{ route('admin.plans.profiles.index', $plan->url) }}" class="btn btn-outline-primary btn-sm">
                <i class="fas fa-address-book"></i>
                <span class="ml-1 d-none d-md-inline-block text-uppercase">Perfis do Plano</span>
            </a>

            <a href="{{ route('admin.plans.details.index', $plan->url) }}" class="btn btn-outline-primary btn-sm">
                <i class="fas fa-tasks"></i>
                <span class="ml-1 d-none d-md-inline-block text-uppercase">Detalhes do Plano</span>
            </a>

            <form action="{{ route('admin.plans.destroy', $plan->url) }}" method="post" class="d-inline-block">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Deseja realmente remover?')">
                    <i class="fas fa-trash"></i>
                    <span class="ml-1 d-none d-md-inline-block text-uppercase">Deletar Plano</span>
                </button>
            </form>
        </div>
    </div>
@stop
