@csrf

<div class="mb-3">
    <label for="name" class="form-label text-uppercase text-gray-700 fs-6">Nombre</label>
    <span class="text-danger">@error('name'){{ $message }} @enderror</span>
    <input type="text" name="name" id="name" class="form-control rounded border border-gray-200" value="{{ old('name', $category->name) }}">
</div>

<div class="mb-3">
    <label for="description" class="form-label text-uppercase text-gray-700 fs-6">Descripción</label>
    <span class="text-danger">@error('description'){{ $message }} @enderror</span>
    <textarea name="description" id="description" rows="5" class="form-control rounded border border-gray-200">{{ old('description', $category->description) }}</textarea>
</div>

<div class="mb-3">
    <label for="parent_id" class="form-label text-uppercase text-gray-700 fs-6">Categoría Padre</label>
    <span class="text-danger">@error('parent_id'){{ $message }} @enderror</span>
    <select name="parent_id" id="parent_id" class="form-select rounded border border-gray-200">
        <option value="">Seleccionar Categoría Padre</option>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ old('parent_id', $category->parent_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
        @endforeach
    </select>
</div>

<div class="d-flex justify-content-between align-items-center">
    <a href="{{ route('categories.index') }}" class="text-indigo-600">Volver</a>
    <button type="submit" class="btn btn-primary">Enviar</button>
</div>
