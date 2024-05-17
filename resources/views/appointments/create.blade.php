@extends('layouts.app')

@section('content')
   
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Citas') }}</div>

                <div class="card-body">
                    <form action="{{ route('appointments.store') }}" method="POST" enctype="multipart/form-data">
                      
                        @include('appointments._form')
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
