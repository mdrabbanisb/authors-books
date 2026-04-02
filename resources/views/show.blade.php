@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-book me-2"></i>Book Details</h5>
                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>Back
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center mb-4">
                            @if($book->cover_image)
                                <img src="{{ asset($book->cover_image) }}" 
                                     alt="Cover of {{ $book->title }}" 
                                     class="img-fluid rounded shadow-sm" 
                                     style="max-height: 300px;">
                            @else
                                <div class="p-4 bg-light rounded">
                                    <i class="fas fa-book fa-4x text-muted"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h3 class="mb-3">{{ $book->title }}</h3>
                            
                            <div class="mb-4">
                                <h5 class="text-muted mb-3">Book Information</h5>
                                <p class="mb-2">
                                    <i class="fas fa-building me-2"></i>
                                    <strong>Publisher:</strong> {{ $book->publisher }}
                                </p>
                                <p class="mb-2">
                                    <i class="fas fa-calendar me-2"></i>
                                    <strong>Published Date:</strong> {{ $book->published_at->format('F d, Y') }}
                                </p>
                            </div>

                            <div class="mb-4">
                                <h5 class="text-muted mb-3">Author Information</h5>
                                <p>
                                    <i class="fas fa-user me-2"></i>
                                    <a href="{{ route('authors.show', $book->author->id) }}" 
                                       class="text-decoration-none">
                                        {{ $book->author->name }}
                                    </a>
                                </p>
                            </div>

                            <div class="mt-4">
                                @if(Auth::check())
                                <a href="#" class="btn btn-primary me-2">
                                    <i class="fas fa-shopping-cart me-1"></i>checkout
                                </a>
                                    <a href="" 
                                       class="btn btn-primary me-2">
                                        <i class="fas  me-1"></i>Buy
                                    </a>
                                        
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection