@extends('layouts.app')

@section('content')
    <x-slot name="header">
        <div class="container">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Products') }}</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body ml-6"> <!-- Agregamos la clase ml-3 para el margen izquierdo -->

                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                
                                @include('products._form')

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
