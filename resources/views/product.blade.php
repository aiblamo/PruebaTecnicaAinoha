@extends('template')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h1 class="display-4 mb-4">{{ $product->name }}</h1>
            <p class="lead">{{ $product->description }}</p>
        </div>
    </div>
</div>

@endsection
