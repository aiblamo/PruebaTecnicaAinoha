<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>ID de Categoría</th>
        <th>Creado en</th>
        <th>Actualizado en</th>
    </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->categories->pluck('id')->implode(', ') }}</td>
            <td>{{ $product->created_at }}</td>
            <td>{{ $product->updated_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
