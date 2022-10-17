@extends('adminlte::page')

@section('title', 'Empresas')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">
            Empresas
        </li>
    </ol>

    <h1>Empresas</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-end">
                <form action="{{ route('admin.companies.search') }}" method="post" class="form form-inline">
                    @csrf
                    <div class="input-group input-group-sm">
                        <input type="text" name="text" class="form-control" value="{{ request('text') }}" placeholder="Procurar categoria...">
                        <div class="input-group-append">
                            <button class="btn btn-secondary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                      </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Empresa</th>
                        <th>CNPJ</th>
                        <th>Ativa</th>
                        <th width="150">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($companies as $company)
                        <tr>
                            <td>
                                <img src="{{  !$company->logo ? 'https://via.placeholder.com/90' : asset("storage/{$company->logo}") }}" width="90" height="52" alt="" style="width: 90px; height: 52px; object-fit: cover">
                                <span class="ml-2">{{ $company->name }}</span>
                            </td>
                            <td>{{ $company->cnpj }}</td>
                            <td>{{ $company->is_active === 'Y' ? 'SIM' : 'NÃO' }}</td>
                            <td>
                                <a href="{{ route('admin.companies.show', $company->uuid) }}" class="btn btn-light btn-sm" data-toggle="tooltip" data-placement="left" title="Ver mais">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.companies.edit', $company->uuid) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="left" title="Editar">
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
            @if (null !== request('text'))
                {!! $companies->appends(['text' => request('text')])->links() !!}
            @else
                {!! $companies->links() !!}
            @endif
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
