@extends('adminlte::page')

@section('title', $profile->name)

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('admin.profiles.index') }}">Perfis</a>
        </li>
        <li class="breadcrumb-item active">
            {{ $profile->name }}
        </li>
    </ol>

    <h1>Editar Perfil</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.profiles.update', $profile->id) }}" method="post" class="form">
                @csrf
                @method('PUT')
                @include('admin.pages.profiles._partials.form')
            </form>
        </div>
    </div>
@stop
