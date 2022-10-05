@include('admin.includes.alerts')

<div class="form-group">
    <label for="name">Nome:</label>
    <input type="text" name="name" value="{{ $user->name ?? old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Nome:">

    @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <label for="email">Email:</label>
    <input type="text" name="email" value="{{ $user->email ?? old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Email:">

    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <label for="password">Senha:</label>
    <input type="text" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Senha:">

    @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <button type="submit" class="btn btn-success btn-sm">
        <i class="fas fa-save"></i>
        <span class="ml-1 d-none d-md-inline-block text-uppercase">Salvar</span>
    </button>
</div>
