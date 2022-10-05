@include('admin.includes.alerts')

<div class="form-group">
    <label for="image">Imagem:</label>
    <input type="file" name="image" value="{{ $product->image ?? old('image') }}" class="form-control-file @error('image') is-invalid @enderror">

    @error('image')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group">
    <label for="title">Título:</label>
    <input type="text" name="title" value="{{ $product->title ?? old('title') }}" class="form-control @error('title') is-invalid @enderror" placeholder="Título:">

    @error('title')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <label for="price">Preço:</label>
    <input type="text" name="price" value="{{ $product->price ?? old('price') }}" class="form-control @error('price') is-invalid @enderror" placeholder="Preço:">

    @error('price')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <label for="description">Descrição:</label>
    <textarea name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Preço:">{{ $product->description ?? old('description') }}</textarea>

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
