@extends('adminlte::page')

@section('title', 'Cadastrar Permissão')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('admin.permissions.index') }}">Permissões</a>
        </li>
        <li class="breadcrumb-item active">
            Cadastrar Permissão
        </li>
    </ol>

    <h1>Cadastrar Permissão</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.permissions.store') }}" method="post" class="form">
                @csrf
                @include('admin.pages.permissions._partials.form')
            </form>
        </div>
    </div>
@stop
