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
            <a href="{{ route('admin.plans.show', $plan->id) }}">{{ $plan->name }}</a>
        </li>
        <li class="breadcrumb-item active">
            Perfis
        </li>
    </ol>

    <h1>Perfis do Plano: <strong>{{ $plan->name }}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.plans.profiles.available', $plan->url) }}" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-plus-circle"></i>
                    <span class="ml-1 d-none d-md-inline-block text-uppercase">Adicionar Perfis</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            @include('admin.includes.alerts')
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th width="50">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($plan->profiles as $profile)
                        <tr>
                            <td>{{ $profile->name }}</td>
                            <td>
                                <form action="{{ route('admin.plans.profiles.detach', [$plan->url, $profile->id]) }}" method="post" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="left" title="Remover">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center font-italic">
                                Nenhum registro encontrado
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('adminlte_js')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection
