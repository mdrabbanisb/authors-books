@extends('layouts.dashboard')
@section('title', 'Books')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">Books List</h3>
                <div>
                    <a href="{{ route('books.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Add Book
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table id="booksTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cover</th>
                            <th>Title</th>
                            <th>Publisher</th>
                            <th>Publication Date</th>
                            <th>Author</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $book)
                            <tr>
                                <td>{{ $book->id }}</td>
                                <td>
                                    @if($book->cover_image)
                                        <img src="{{ asset($book->cover_image) }}" 
                                             alt="Cover of {{ $book->title }}" 
                                             class="img-thumbnail" 
                                             style="max-height: 50px;">
                                    @else
                                        <i class="fas fa-book text-muted"></i>
                                    @endif
                                </td>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->publisher }}</td>
                                <td>{{ $book->published_at->format('Y-m-d') }}</td>
                                <td>
                                    <a href="{{ route('authors.show', $book->author->id) }}" 
                                       class="text-decoration-none">
                                        <i class="fas fa-user me-1"></i>
                                        {{ $book->author->name }}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('books.show', $book->id) }}" 
                                           class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('books.edit', $book->id) }}" 
                                           class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('books.destroy', $book->id) }}" 
                                              method="POST" 
                                              style="display:inline;" 
                                              onsubmit="return confirm('Are you sure you want to delete this book?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        .btn-group {
            display: flex;
            gap: 5px;
        }
        .table td {
            vertical-align: middle;
        }
    </style>
    @endpush
@endsection