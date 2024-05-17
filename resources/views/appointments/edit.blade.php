@extends('layouts.app')

@section('content')
   
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Citas') }}</div>

                <div class="card-body">
                    <form action="{{ route('appointments.update', $appointment) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')

                        @include('appointments._form')
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Desea eliminar?')">Eliminar</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
