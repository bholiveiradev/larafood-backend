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

    <h1>Detalhes da Empresa</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @include('admin.includes.alerts')
            <div class="row">
                <div class="col-md-8">
                    <ul>
                        <li>
                            <strong>Nome:</strong> {{ $company->name }}
                        </li>
                        <li>
                            <strong>CNPJ:</strong> {{ $company->cnpj }}
                        </li>
                        <li>
                            <strong>E-mail:</strong> {{ $company->email }}
                        </li>
                        <li>
                            <strong>Ativa?</strong> {{ $company->is_active === 'Y' ? 'SIM' : 'NÃO' }}
                        </li>
                    </ul>

                    <h4 class="mt-5">Assinatura</h4>
                    <hr>

                    <ul>
                        <li>
                            <strong>Plano: </strong> {{ $company->plan->name }}
                        </li>
                        <li>
                            <strong>Identificador:</strong> {{ $company->subscription_id }}
                        </li>
                        <li>
                            <strong>Data Assinatura:</strong> {{ $company->subscription }}
                        </li>
                        <li>
                            <strong>Expira em:</strong> {{ $company->expires_at }}
                        </li>
                        <li>
                            <strong>Ativa?</strong> {{ $company->subscription_active ? 'SIM' : 'NÃO' }}
                        </li>
                        <li>
                            <strong>Cancelou?</strong> {{ $company->subscription_suspended ? 'SIM' : 'NÃO' }}
                        </li>
                        <li>
                            <strong>Cancelou em:</strong> {{ $company->subscription_suspended_at }}
                        </li>
                    </ul>
                </div>
                <div class="col-md-4 mb-2 text-right">
                    @if (!$company->logo)
                        <img src="https://via.placeholder.com/768" width="150" alt="" style="width: 100%; max-width: 768px;">
                    @else
                        <img src="{{ asset("storage/{$company->logo}") }}" width="150" alt=""
                            style="width: 100%; max-width: 768px;">
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
