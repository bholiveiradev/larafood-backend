@extends('adminlte::page')

@section('title', 'Cadastrar Mesa')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('admin.tables.index') }}">Mesas</a>
        </li>
        <li class="breadcrumb-item active">
            Cadastrar Mesa
        </li>
    </ol>

    <h1>Cadastrar Mesa</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.tables.store') }}" method="post" class="form">
                @csrf
                @include('admin.pages.tables._partials.form')
            </form>
        </div>
    </div>
@stop
