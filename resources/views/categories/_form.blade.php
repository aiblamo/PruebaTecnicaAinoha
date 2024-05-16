@csrf

<div class="mb-4">
    <label for="name" class="uppercase text-gray-700 text-xs">Nombre</label>
    <span class="text-xs text-red-600">@error('name'){{ $message }} @enderror</span>
    <input type="text" name="name" id="name" class="form-input rounded border-gray-200 w-full" value="{{ old('name', $category->name) }}">
</div>

<div class="mb-4">
    <label for="description" class="uppercase text-gray-700 text-xs">Descripción</label>
    <span class="text-xs text-red-600">@error('description'){{ $message }} @enderror</span>
    <textarea name="description" id="description" rows="5" class="form-textarea rounded border-gray-200 w-full">{{ old('description', $category->description) }}</textarea>
</div>

<div class="mb-4">
    <label for="parent_id" class="uppercase text-gray-700 text-xs">Categoría Padre</label>
    <span class="text-xs text-red-600">@error('parent_id'){{ $message }} @enderror</span>
    <select name="parent_id" id="parent_id" class="form-select rounded border-gray-200 w-full">
        <option value="">Seleccionar Categoría Padre</option>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ old('parent_id', $category->parent_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
        @endforeach
    </select>
</div>

<div class="flex justify-between items-center">
    <a href="{{ route('categories.index') }}" class="text-indigo-600">Volver</a>
    <input type="submit" value="Enviar" class="bg-gray-800 text-white rounded px-4 py-2">
</div>
