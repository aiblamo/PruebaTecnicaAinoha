@extends('layouts.app')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body bg-white border border-gray-200">
                            <a href="{{ route('products.index') }}" class="btn btn-primary btn-block mb-2">Productos</a>
                            <a href="{{ route('categories.index') }}" class="btn btn-primary btn-block mb-2">Categorías</a>
                            <a href="{{ route('appointments.index') }}" class="btn btn-primary btn-block mb-2">Citas</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection