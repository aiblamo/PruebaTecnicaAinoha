{{-- <div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>Listado de Productos</h2>
            <ul class="list-group">
                @foreach ($products as $product)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $product->name }}
                        <span>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-primary">Editar</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Borrar</button>
                            </form>
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="col-md-6">
            <h2>Listado de Categorías</h2>
            <ul class="list-group">
                @foreach ($categories as $category)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $category->name }}
                        <span>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-primary">Editar</a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Borrar</button>
                            </form>
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div> --}}
