@extends('adminlte::page')

@section('title', 'Cadastrar Usuário')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('admin.users.index') }}">Usuários</a>
        </li>
        <li class="breadcrumb-item active">
            Cadastrar Usuário
        </li>
    </ol>

    <h1>Cadastrar Usuário</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="post" class="form">
                @csrf
                @include('admin.pages.users._partials.form')
            </form>
        </div>
    </div>
@stop
