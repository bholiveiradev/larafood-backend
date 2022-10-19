@extends('adminlte::page')

@section('title', 'Cargos')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">
            Cargos
        </li>
    </ol>

    <h1>Cargos</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.roles.create') }}" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-plus-circle"></i>
                    <span class="ml-1 d-none d-md-inline-block text-uppercase">Cadastrar Cargo</span>
                </a>
                <form action="{{ route('admin.roles.search') }}" method="post" class="form form-inline">
                    @csrf
                    <div class="input-group input-group-sm">
                        <input type="text" name="text" class="form-control" value="{{ request('text') }}" placeholder="Procurar Cargo...">
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
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th width="150">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>
                                <a href="{{ route('admin.roles.permissions.index', $role->id) }}" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="left" title="Permissões">
                                    <i class="fas fa-lock"></i>
                                </a>
                                <a href="{{ route('admin.roles.show', $role->id) }}" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="left" title="Ver mais">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="left" title="Editar">
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
                {!! $roles->appends(['text' => request('text')])->links() !!}
            @else
                {!! $roles->links() !!}
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
