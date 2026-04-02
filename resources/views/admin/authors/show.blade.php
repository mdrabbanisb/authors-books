<h2>{{ $author->name }}</h2>
<ul>
    @foreach ($author->books as $book)
        <li>{{ $book->title }}</li>
    @endforeach
</ul>
