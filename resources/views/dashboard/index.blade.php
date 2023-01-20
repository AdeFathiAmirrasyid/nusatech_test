@extends('index')

@section('container')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="mt-4 p-3 card">
                <p>Name : {{ auth()->user()->name }}</p>
                <p>Email : {{ auth()->user()->email }}</p>
                <p>Status : {{ auth()->user()->status }}</p>
            </div>
        </div>
    </div>
@endsection
