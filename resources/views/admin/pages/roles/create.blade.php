@extends('adminlte::page')

@section('title', 'Cadastrar Cargo')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('admin.roles.index') }}">Cargos</a>
        </li>
        <li class="breadcrumb-item active">
            Cadastrar Cargo
        </li>
    </ol>

    <h1>Cadastrar Cargo</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.roles.store') }}" method="post" class="form">
                @csrf
                @include('admin.pages.roles._partials.form')
            </form>
        </div>
    </div>
@stop
