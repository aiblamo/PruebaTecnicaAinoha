@extends('layouts.app')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <a href="{{ route('products.index') }}" class="btn btn-primary btn-block mb-auto">Productos</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <a href="{{ route('categories.index') }}" class="btn btn-primary btn-block mb-auto">Categorías</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <a href="{{ route('appointments.index') }}" class="btn btn-primary btn-block mb-auto">Citas</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
