<x-app-layout>
    <x-slot name="header">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Products') }}</h2>
                </div>
                <div class="col-auto text-end">
                    <a href="{{ route('products.create') }}" class="text-xs bg-gray-800 text-white rounded px-2 py-1">Crear</a>
                </div>
                
            </div>
        </div>
    </x-slot>

    <div class="col-auto text-end py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <a href="{{ route('export.products') }}" class="text-xs bg-gray-800 text-white rounded px-2 py-1">Exportar xslx</a>
    </div>

    <div class="py-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table-auto w-full">
                        <tbody>
                            @foreach ($products as $product)
                            <tr class="border-b border-gray-200 text-sm">
                                <td class="px-6 py-4">{{ $product->name }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('products.edit', $product) }}" class="text-indigo-600">Editar</a>
                                </td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('products.destroy', $product) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-gray-800 text-white rounded px-4 py-2" onclick="return confirm('¿Desea eliminar?')">Eliminar</button>
                                    </form>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('products.pdf', $product) }}" class="text-indigo-600">PDF</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
