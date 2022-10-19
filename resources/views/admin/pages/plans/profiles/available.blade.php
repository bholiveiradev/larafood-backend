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
            <a href="{{ route('admin.plans.show', $plan->url) }}">{{ $plan->name }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('admin.plans.profiles.index', $plan->url) }}">Perfis</a>
        </li>
        <li class="breadcrumb-item active">
            Perfis Disponíveis
        </li>
    </ol>

    <h1>Perfis Disponíves</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-end">
                <form action="{{ route('admin.plans.profiles.search', $plan->url) }}" method="post" class="form form-inline">
                    @csrf
                    <div class="input-group input-group-sm">
                        <input type="text" name="text" class="form-control" value="{{ request('text') }}" placeholder="Procurar perfil...">
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
                        <th>Nome</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="{{ route('admin.plans.profiles.attach', $plan->url) }}" method="post">
                        @csrf
                        @forelse ($profiles as $profile)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" name="profiles[]" value="{{ $profile->id }}" class="form-check-input">
                                    </div>
                                </td>
                                <td>{{ $profile->name }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center font-italic">
                                    Nenhum registro encontrado
                                </td>
                            </tr>
                        @endforelse
                        @if ($profiles->count())
                            <tr>
                                <td colspan="2">
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fas fa-save"></i>
                                        <span class="ml-1 d-none d-md-inline-block text-uppercase">Vincular Perfis</span>
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
