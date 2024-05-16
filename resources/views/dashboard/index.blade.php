<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('products.index') }}" class="text-m bg-gray-800 text-white rounded px-2 py-1">Productos</a>
                    <a href="{{ route('categories.index') }}" class="text-m bg-gray-800 text-white rounded px-2 py-1">Categorías</a>
                    <a href="{{ route('appointments.index') }}" class="text-m bg-gray-800 text-white rounded px-2 py-1">Citas</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>