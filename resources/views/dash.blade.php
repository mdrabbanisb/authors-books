@extends('layouts.dashboard')
@section('content')
<div class="row mb-4">
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card text-center bg-primary text-white">
            <div class="card-body">
                <h5 class="card-title">Total Authors</h5>
                <p class="card-text">{{ $totalAuthors }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card text-center bg-success text-white">
            <div class="card-body">
                <h5 class="card-title">Total Books</h5>
                <p class="card-text">{{ $totalBooks }}</p>
            </div>
        </div>
    </div>
</div>
@endsection