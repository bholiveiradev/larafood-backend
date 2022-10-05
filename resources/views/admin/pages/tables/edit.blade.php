@extends('adminlte::page')

@section('title', $table->identifier)

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('admin.tables.index') }}">Mesas</a>
        </li>
        <li class="breadcrumb-item active">
            {{ $table->identifier }}
        </li>
    </ol>

    <h1>Editar Mesa</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.tables.update', $table->id) }}" method="post" class="form">
                @csrf
                @method('PUT')
                @include('admin.pages.tables._partials.form')
            </form>
        </div>
    </div>
@stop
