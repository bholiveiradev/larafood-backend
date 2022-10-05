@extends('adminlte::page')

@section('title', 'Cadastrar Categoria')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('admin.categories.index') }}">Categorias</a>
        </li>
        <li class="breadcrumb-item active">
            Cadastrar Categoria
        </li>
    </ol>

    <h1>Cadastrar Categoria</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.categories.store') }}" method="post" class="form">
                @csrf
                @include('admin.pages.categories._partials.form')
            </form>
        </div>
    </div>
@stop
