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
        <li class="breadcrumb-item active">
            {{ $product->title }}
        </li>
    </ol>

    <h1>Detalhes do Produto</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @include('admin.includes.alerts')
            <div class="row">
                <div class="col-md-8 mb-2">
                    <ul>
                        <li>
                            <strong>Título:</strong> {{ $product->title }}
                        </li>
                        <li>
                            <strong>URL:</strong> {{ $product->url }}
                        </li>
                        <li>
                            <strong>Preço:</strong> {{ number_format($product->price, 2, ',', '.') }}
                        </li>
                        <li>
                            <strong>Descrição:</strong> {{ $product->description }}
                        </li>
                    </ul>

                    <a href="{{ route('admin.products.categories.index', $product->id) }}" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-tags"></i>
                        <span class="ml-1 d-none d-md-inline-block text-uppercase">Categorias</span>
                    </a>

                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="post"
                        class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger btn-sm">
                            <i class="fas fa-trash"></i>
                            <span class="ml-1 d-none d-md-inline-block text-uppercase">Deletar Produto</span>
                        </button>
                    </form>
                </div>
                <div class="col-md-4 mb-2 text-right">
                    @if (!$product->image)
                        <img src="https://via.placeholder.com/768" width="150" alt="" style="width: 100%; max-width: 768px;">
                    @else
                        <img src="{{ asset("storage/{$product->image}") }}" width="150" alt=""
                            style="width: 100%; max-width: 768px;">
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
