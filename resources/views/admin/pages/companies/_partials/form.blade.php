@include('admin.includes.alerts')

<div class="form-group">
    <label for="image">Logo:</label>
    <input type="file" name="logo" value="{{ $product->logo ?? old('logo') }}" class="form-control-file @error('logo') is-invalid @enderror">

    @error('logo')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <label for="name">Nome:</label>
    <input type="text" name="name" value="{{ $company->name ?? old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Nome:">

    @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <label for="cnpj">CNPJ:</label>
    <input type="text" name="cnpj" value="{{ $company->cnpj ?? old('cnpj') }}" class="form-control @error('cnpj') is-invalid @enderror" placeholder="CNPJ:">

    @error('cnpj')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <label for="email">E-mail:</label>
    <input type="email" name="email" value="{{ $company->email ?? old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="E-mail:">

    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <label for="is_active">Ativa?</label>
    <select name="is_active" class="form-control @error('is_active') is-invalid @enderror">
        <option value="Y" {{ $company->is_active === 'Y' || old('is_active') === 'Y' ? 'selected' : '' }}>SIM</option>
        <option value="N" {{ $company->is_active === 'N' || old('is_active') === 'N' ? 'selected' : '' }}>NÃO</option>
    </select>

    @error('is_active')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<h4 class="mt-5">Assinatura</h4>
<hr>

<div class="form-group">
    <label for="plan_id">Plano:</label>
    <select name="plan_id" class="form-control @error('plan_id') is-invalid @enderror">
        @foreach ($plans as $plan)
        <option value="{{ $plan->id }}" {{ $company->plan_id === $plan->id || old('plan_id') === $plan->id ? 'selected' : '' }}>{{ $plan->name }}</option>
        @endforeach
    </select>

    @error('plan_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <label for="subscription_id">Identificador:</label>
    <input type="text" name="subscription_id" value="{{ $company->subscription_id ?? old('subscription_id') }}" class="form-control @error('subscription_id') is-invalid @enderror" placeholder="Identificador:">

    @error('subscription_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <label for="subscription">Data Assinatura (Início):</label>
    <input type="date" name="subscription" value="{{ $company->subscription ?? old('subscription') }}" class="form-control @error('subscription') is-invalid @enderror" placeholder="Data Assinatura (Início):">

    @error('subscription')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <label for="expires_at">Data Expiração (Final):</label>
    <input type="date" name="expires_at" value="{{ $company->expires_at ?? old('expires_at') }}" class="form-control @error('expires_at') is-invalid @enderror" placeholder="Data Expiração (Final):">

    @error('expires_at')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <label for="subscription_active">Ativa?</label>
    <select name="subscription_active" class="form-control @error('subscription_active') is-invalid @enderror">
        <option value="1" {{ $company->subscription_active === 1 ? 'selected' : '' }}>SIM</option>
        <option value="0" {{ $company->subscription_active === 0 ? 'selected' : '' }}>NÃO</option>
    </select>

    @error('subscription_active')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <label for="subscription_suspended">Cancelou?</label>
    <select name="subscription_suspended" class="form-control @error('subscription_suspended') is-invalid @enderror">
        <option value="1" {{ $company->subscription_suspended === 1 ? 'selected' : '' }}>SIM</option>
        <option value="0" {{ $company->subscription_suspended === 0 ? 'selected' : '' }}>NÃO</option>
    </select>

    @error('subscription_suspended')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group">
    <strong>Cancelado em:</strong>
    <p>{{ $company->subscription_suspended_at }}</p>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-success btn-sm">
        <i class="fas fa-save"></i>
        <span class="ml-1 d-none d-md-inline-block text-uppercase">Salvar</span>
    </button>
</div>
