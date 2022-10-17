@extends('adminlte::page')

@section('title', $role->name)

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('admin.roles.index') }}">Cargos</a>
        </li>
        <li class="breadcrumb-item active">
            {{ $role->name }}
        </li>
    </ol>

    <h1>Editar Perfil</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.roles.update', $role->id) }}" method="post" class="form">
                @csrf
                @method('PUT')
                @include('admin.pages.roles._partials.form')
            </form>
        </div>
    </div>
@stop
