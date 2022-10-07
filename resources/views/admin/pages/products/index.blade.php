@extends('adminlte::page')

@section('title', 'Produtos')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">
            Produtos
        </li>
    </ol>

    <h1>Produtos</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.products.create') }}" class="btn btn-info btn-sm">
                    <i class="fas fa-plus-circle"></i>
                    <span class="ml-1 d-none d-md-inline-block text-uppercase">Cadastrar Produto</span>
                </a>
                <form action="{{ route('admin.products.search') }}" method="post" class="form form-inline">
                    @csrf
                    <div class="input-group input-group-sm">
                        <input type="text" name="text" class="form-control" value="{{ request('text') }}"
                            placeholder="Procurar produto...">
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
                        <th>Produto</th>
                        <th>Preço</th>
                        <th width="150">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td>
                                <img src="{{  !$product->image ? 'https://via.placeholder.com/60' : asset("storage/{$product->image}") }}" width="90" height="52" alt="" style="width: 90px; height: 52px; object-fit: cover">
                                <span class="ml-2">{{ $product->title }}</span>
                            </td>
                            <td>{{ number_format($product->price, 2, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('admin.products.categories.index', $product->id) }}" class="btn btn-info btn-sm"
                                    data-toggle="tooltip" data-placement="left" title="Categorias">
                                    <i class="fas fa-tags"></i>
                                </a>
                                <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-light btn-sm"
                                    data-toggle="tooltip" data-placement="left" title="Ver mais">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning btn-sm"
                                    data-toggle="tooltip" data-placement="left" title="Editar">
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
                {!! $products->appends(['text' => request('text')])->links() !!}
            @else
                {!! $products->links() !!}
            @endif
        </div>
    </div>
@stop

@section('adminlte_js')
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection
