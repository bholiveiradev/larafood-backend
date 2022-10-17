@extends('adminlte::page')

@section('title', $company->name)

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('admin.companies.index') }}">Empresas</a>
        </li>
        <li class="breadcrumb-item active">
            {{ $company->name }}
        </li>
    </ol>

    <h1>Editar Empresa</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.companies.update', $company->uuid) }}" method="post" class="form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.pages.companies._partials.form')
            </form>
        </div>
    </div>
@stop
