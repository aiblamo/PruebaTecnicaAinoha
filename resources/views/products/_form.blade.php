@csrf

<div class="mb-4">
    <label for="name" class="uppercase text-gray-700 text-xs">Nombre</label>
    <span class="text-xs text-red-600">@error('name'){{ $message }} @enderror</span>
    <input type="text" name="name" id="name" class="rounded border-gray-200 w-full" value="{{ old('name', $product->name) }}">
</div>

<div class="mb-4">
    <label for="description" class="uppercase text-gray-700 text-xs">Descripción</label>
    <span class="text-xs text-red-600">@error('description'){{ $message }} @enderror</span>
    <textarea name="description" id="description" rows="5" class="rounded border-gray-200 w-full">{{ old('description', $product->description) }}</textarea>
</div>

<div class="mb-4">
    <label for="price" class="uppercase text-gray-700 text-xs">Precio</label>
    <span class="text-xs text-red-600">@error('price'){{ $message }} @enderror</span>
    <input type="number" step="any" name="price" id="price" class="rounded border-gray-200 w-full" value="{{ old('price', $product->prices->sortByDesc('start_date')->first()->price ?? '') }}">


</div>

<div class="mb-4">
    <label for="start_date" class="uppercase text-gray-700 text-xs">Fecha de inicio</label>
    <span class="text-xs text-red-600">@error('start_date'){{ $message }} @enderror</span>
   
    <input type="date" name="start_date" id="start_date" class="rounded border-gray-200 w-full" value="{{ old('start_date', $product->prices->sortByDesc('start_date')->first()->start_date ?? '') }}">
</div>

<div class="mb-4">
    <label for="end_date" class="uppercase text-gray-700 text-xs">Fecha de finalización</label>
    <span class="text-xs text-red-600">@error('end_date'){{ $message }} @enderror</span>
    <input type="date" name="end_date" id="end_date" class="rounded border-gray-200 w-full" value="{{ old('end_date', $product->prices->sortByDesc('start_date')->first()->end_date ?? '') }}">
</div>

<div class="mb-4">
    <label for="category_id" class="uppercase text-gray-700 text-xs">Categoría</label>
    <span class="text-xs text-red-600">@error('category_id'){{ $message }} @enderror</span>
    <select name="category_id" id="category_id" class="rounded border-gray-200 w-full">
        <option value="">Seleccionar Categoría</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id', $product->categories->pluck('id')->first()) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
        @endforeach
    </select>
</div>

<div class="mb-4">
    <label for="photo" class="uppercase text-gray-700 text-xs">Foto</label>
    <span class="text-xs text-red-600">@error('photo'){{ $message }} @enderror</span>
    <input type="file" name="photo" id="photo" class="rounded border-gray-200 w-full" enctype="multipart/form-data" value="{{ old('photo', $product->photo) }}">
</div>

<div class="flex justify-between items-center">
    <a href="{{ route('products.index') }}" class="text-indigo-600">Volver</a>
    <input type="submit" value="Enviar" class="bg-gray-800 text-white rounded px-4 py-2">
</div>
