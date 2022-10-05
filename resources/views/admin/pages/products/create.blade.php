@extends('adminlte::page')

@section('title', 'Cadastrar Produto')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('admin.products.index') }}">Produtos</a>
        </li>
        <li class="breadcrumb-item active">
            Cadastrar Produto
        </li>
    </ol>

    <h1>Cadastrar Produto</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.products.store') }}" method="post" class="form" enctype="multipart/form-data">
                @csrf
                @include('admin.pages.products._partials.form')
            </form>
        </div>
    </div>
@stop
