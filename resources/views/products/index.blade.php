@extends('layouts.app')



@section ('content')

        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col">
                    <h2 class="font-weight-bold text-dark">{{ __('Productos') }}</h2>
                </div>
                <div class="col-auto text-end">
                    <a href="{{ route('products.create') }}" class="btn btn-dark btn-sm">Crear</a>
                </div>
            </div>
        </div>
   

    <div class="container my-4">
        <div class="text-end mb-3">
            <a href="{{ route('export.products') }}" class="btn btn-dark btn-sm">Exportar xslx</a>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>
                                <a href="{{ route('products.edit', $product) }}" class="btn btn-link text-primary p-0">Editar</a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger p-0" onclick="return confirm('¿Desea eliminar?')">Eliminar</button>
                                </form>
                                <a href="{{ route('products.pdf', $product) }}" class="btn btn-link text-info p-0">PDF</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
