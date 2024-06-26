@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Categorías') }}</div>

                    <div class="card-body">

                        @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                        <form action="{{ route('categories.update', $category) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            
                            @include('categories._form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
