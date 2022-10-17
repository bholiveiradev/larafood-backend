@include('admin.includes.alerts')

<div class="form-group">
    <label for="name">Permissão:</label>
    <input type="text" name="name" value="{{ $profile->name ?? old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Nome:">

    @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <label for="description">Descrição:</label>
    <input type="text" name="description" value="{{ $profile->description ?? old('description') }}" class="form-control @error('description') is-invalid @enderror"
        placeholder="Descrição:">

    @error('description')
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
