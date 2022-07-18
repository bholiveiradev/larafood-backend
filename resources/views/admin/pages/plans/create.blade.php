@extends('adminlte::page')

@section('title', 'Cadastrar Plano')

@section('content_header')
    <h1>Cadastrar Plano</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.plans.store') }}" method="post" class="form">
                @csrf
                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input type="name" class="form-control" placeholder="Nome:">
                </div>
                <div class="form-group">
                    <label for="price">Preço:</label>
                    <input type="price" class="form-control" placeholder="Preço:">
                </div>
                <div class="form-group">
                    <label for="description">Descrição:</label>
                    <input type="description" class="form-control" placeholder="Descrição:">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>
@stop
