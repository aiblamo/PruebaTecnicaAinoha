@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Citas') }}</div>

                    <div class="card-body">
                        <form action="{{ route('appointments.update', $appointment) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            @include('appointments._form')

                           
                        </form>

                        <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" class="mt-3">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Desea eliminar?')">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection