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
        <li class="breadcrumb-item active">
            Detalhes
        </li>
    </ol>

    <h1>Detalhes do Plano: {{ $plan->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.plans.details.create', $plan->url) }}" class="btn btn-outline-primary btn-sm">
                <i class="fas fa-plus-circle"></i>
                <span class="ml-1 d-none d-md-inline-block text-uppercase">Cadastrar Detalhe</span>
            </a>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th width="150">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($plan->details as $detail)
                        <tr>
                            <td>{{ $detail->name }}</td>
                            <td>
                                <form action="{{ route('admin.plans.details.destroy', [$plan->url, $detail->id]) }}" method="post" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="left" title="Remover">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                <a href="{{ route('admin.plans.details.edit', [$plan->url, $detail->id]) }}" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="left" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center font-italic">
                                Nenhum registro encontrado
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
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
