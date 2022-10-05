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

    <h1>Editar Produto</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.products.update', $product->id) }}" method="post" class="form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.pages.products._partials.form')
            </form>
        </div>
    </div>
@stop
