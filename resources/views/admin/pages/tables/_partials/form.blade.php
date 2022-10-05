@include('admin.includes.alerts')

<div class="form-group">
    <label for="identifier">Identificador:</label>
    <input type="text" name="identifier" value="{{ $table->identifier ?? old('identifier') }}" class="form-control @error('identifier') is-invalid @enderror" placeholder="Identificador:">

    @error('identifier')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <label for="description">Descrição:</label>
    <textarea name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Descrição:">{{ $table->description ?? old('description') }}</textarea>

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
