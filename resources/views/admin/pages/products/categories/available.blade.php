@extends('adminlte::page')

@section('title', $product->title)

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('admin.products.index') }}">Produtos</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('admin.products.show', $product->id) }}">{{ $product->title }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('admin.products.categories.index', $product->id) }}">Categorias</a>
        </li>
        <li class="breadcrumb-item active">
            Categorias Disponíveis
        </li>
    </ol>

    <h1>Categorias Disponíves</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-end">
                <form action="{{ route('admin.products.categories.search', $product->id) }}" method="post" class="form form-inline">
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
            @include('admin.includes.alerts')
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th width="50"></th>
                        <th>Categoria</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="{{ route('admin.products.categories.attach', $product->id) }}" method="post">
                        @csrf
                        @forelse ($categories as $category)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="form-check-input">
                                    </div>
                                </td>
                                <td>{{ $category->name }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center font-italic">
                                    Nenhum registro encontrado
                                </td>
                            </tr>
                        @endforelse
                        @if ($categories->count())
                            <tr>
                                <td colspan="2">
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fas fa-save"></i>
                                        <span class="ml-1 d-none d-md-inline-block text-uppercase">Vincular Categorias</span>
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
