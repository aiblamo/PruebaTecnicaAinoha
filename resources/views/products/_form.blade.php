@csrf

<div class="mb-3">
    <label for="name" class="form-label text-uppercase text-gray-700 fs-6">Nombre</label>
    <span class="text-danger">@error('name'){{ $message }} @enderror</span>
    <input type="text" name="name" id="name" class="form-control rounded border border-gray-200" value="{{ old('name', $product->name) }}">
</div>

<div class="mb-3">
    <label for="description" class="form-label text-uppercase text-gray-700 fs-6">Descripción</label>
    <span class="text-danger">@error('description'){{ $message }} @enderror</span>
    <textarea name="description" id="description" rows="5" class="form-control rounded border border-gray-200">{{ old('description', $product->description) }}</textarea>
</div>

<div class="mb-3">
    <label for="price" class="form-label text-uppercase text-gray-700 fs-6">Precio</label>
    <span class="text-danger">@error('price'){{ $message }} @enderror</span>
    <input type="number" step="any" name="price" id="price" class="form-control rounded border border-gray-200" value="{{ old('price', $product->prices->sortByDesc('start_date')->first()->price ?? '') }}">
</div>

<div class="mb-3">
    <label for="start_date" class="form-label text-uppercase text-gray-700 fs-6">Fecha de inicio</label>
    <span class="text-danger">@error('start_date'){{ $message }} @enderror</span>
    <input type="date" name="start_date" id="start_date" class="form-control rounded border border-gray-200" value="{{ old('start_date', $product->prices->sortByDesc('start_date')->first()->start_date ?? '') }}">
</div>

<div class="mb-3">
    <label for="end_date" class="form-label text-uppercase text-gray-700 fs-6">Fecha de finalización</label>
    <span class="text-danger">@error('end_date'){{ $message }} @enderror</span>
    <input type="date" name="end_date" id="end_date" class="form-control rounded border border-gray-200" value="{{ old('end_date', $product->prices->sortByDesc('start_date')->first()->end_date ?? '') }}">
</div>

<div class="mb-3">
    <label for="category_id" class="form-label text-uppercase text-gray-700 fs-6">Categoría</label>
    <span class="text-danger">@error('category_id'){{ $message }} @enderror</span>
    <select name="category_id" id="category_id" class="form-select rounded border border-gray-200">
        <option value="">Seleccionar Categoría</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id', $product->categories->pluck('id')->first()) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="photo" class="form-label text-uppercase text-gray-700 fs-6">Foto</label>
    <span class="text-danger">@error('photo'){{ $message }} @enderror</span>
    <input type="file" name="photo" id="photo" class="form-control rounded border border-gray-200" value="{{ old('photo', $product->photo) }}">
</div>

<div class="d-flex justify-content-between align-items-center">
    <a href="{{ route('products.index') }}" class="text-indigo-600">Volver</a>
    <button type="submit" class="btn btn-primary">Enviar</button>
</div>
