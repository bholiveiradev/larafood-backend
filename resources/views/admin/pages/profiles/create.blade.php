@extends('adminlte::page')

@section('title', 'Cadastrar Perfil')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('admin.profiles.index') }}">Perfis</a>
        </li>
        <li class="breadcrumb-item active">
            Cadastrar Perfil
        </li>
    </ol>

    <h1>Cadastrar Perfil</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.profiles.store') }}" method="post" class="form">
                @csrf
                @include('admin.pages.profiles._partials.form')
            </form>
        </div>
    </div>
@stop
