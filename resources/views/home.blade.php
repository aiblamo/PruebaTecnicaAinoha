@extends('template')

@section('content')

<h1 class="display-4 mt-4 mb-4">Listado de productos</h1>

@foreach($products as $product)
<div class="card mb-4">
    <div class="card-body d-flex align-items-center"> 
        <div style="position: relative; width: 100px;">
            <p style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: none; padding: 5px; text-transform: uppercase; font-weight: bold !important; max-width: 100px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" >{{ $product->name }}</p>

            <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}" class="img-fluid rounded-lg mb-4 mt-4">
        </div>
        <p class="ml-4 flex-grow-1 text-center">{{ $product->description }}</p> 
    </div>
</div>
@endforeach

@endsection
