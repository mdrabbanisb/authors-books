<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Authors & Books</title>
    <style>
        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 450px;
            background: #f8f9fa;
            padding: 1rem;
        }

        .main-content {
            flex: 1;
            padding: 1rem;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(139, 139, 139, 0.2);
            transition: all 0.3s ease;
        }

        .sidebar-nav .list-group-item {
            border: none;
            border-radius: 0;
            padding: 0.75rem 1rem;
        }

        .sidebar-nav .list-group-item:hover {
            background-color: #e9ecef;
        }

        .content-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1rem;
        }

        .chat-message {
            padding: 8px;
            border-radius: 8px;
            margin-bottom: 8px;
        }

        .chat-message.user {
            background-color: #f8f9fa;
        }

        .chat-message.bot {
            background-color: #e9ecef;
        }

        .chat-message .message {
            word-break: break-word;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <div class="container">
            <a class="navbar-brand text-white" href="{{ url('/') }}">
                <i class="fas fa-book-reader me-2"></i>Authors & Books
            </a>
            @if (Route::has('login'))
                <div class="navbar-nav ms-auto">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="nav-link text-white">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="nav-link text-white">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="nav-link text-white">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </nav>
<div class="container">
    <div class="wrapper">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="fas fa-bars me-2"></i>Navigation</h5>
                </div>
                <div class="card-body p-0">
                    <nav class="sidebar-nav">
                        <div class="list-group list-group-flush">
                            <a href="{{ url('/') }}" class="list-group-item list-group-item-action">
                                <i class="fas fa-home me-2"></i>Home
                            </a>
                            <a href="" class="list-group-item list-group-item-action">
                                <i class="fas fa-users me-2"></i>Authors
                            </a>
                            <a href="" class="list-group-item list-group-item-action">
                                <i class="fas fa-book me-2"></i>Books
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <i class="fas fa-star me-2"></i>Featured
                            </a>
                        </div>
                    </nav>
                </div>
            </div>

            <!-- Chat Box -->
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-robot me-2"></i>Chat Assistant</h5>
                    <small class="text-muted">Ask me about authors & books!</small>
                </div>
                <div class="card-body">
                    <div class="chat-messages mb-3" style="height: 200px; overflow-y: auto;">
                        <div id="chat-content">
                            <div class="chat-message bot mb-2">
                                <small class="text-muted">Bot:</small>
                                <div class="message">
                                    Hello! I can answer these questions:
                                    - How many authors are there?
                                    - How many books are available?
                                    - List top 5 authors.
                                </div>
                            </div>
                        </div>
                    </div>
                    <form id="chat-form" class="chat-input">
                        <div class="input-group">
                            <input 
                                type="text" 
                                id="chat-query" 
                                class="form-control" 
                                placeholder="Ask a question..."
                                required
                            >
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            @yield('content')
            
            @hasSection('content')
            @else
                <!-- Authors Section -->
                <section class="mb-5">
                    <h2 class="mb-4"><i class="fas fa-users me-2"></i>Featured Authors</h2>
                    <div class="content-grid">
                        @foreach($authors as $author)
                            <div class="card card-hover h-100">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <i class="fas fa-user me-2"></i>{{ $author->name }}
                                    </h5>
                                    <p class="card-text text-muted">
                                        <small>Books: {{ $author->books->count() }}</small>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>

                <!-- Books Section -->
                <section>
                    <h2 class="mb-4"><i class="fas fa-book me-2"></i>Latest Books</h2>
                    <div class="content-grid">
                        @foreach($books as $book)
                            <div class="card card-hover h-100">
                                <div class="card-body">
                                    <a href="{{ route('books.show', $book->id) }}" class="text-decoration-none">
                                        <div class="mb-3">
                                            @if($book->cover_image)
                                                <img src="{{ asset($book->cover_image) }}" 
                                                     alt="Cover of {{ $book->title }}" 
                                                     class="img-fluid rounded" 
                                                     style="max-height: 150px; width: auto;">
                                            @else
                                                <div class="text-center text-muted">
                                                    <i class="fas fa-book fa-4x"></i>
                                                </div>
                                            @endif
                                        </div>

                                        <h5 class="card-title text-dark">
                                            <i class="fas fa-book me-2"></i>{{ $book->title }}
                                        </h5>

                                        <div class="text-muted small mb-2">
                                            <p class="mb-1">
                                                <i class="fas fa-building me-1"></i>
                                                Publisher: {{ $book->publisher }}
                                            </p>
                                            <p class="mb-1">
                                                <i class="fas fa-calendar me-1"></i>
                                                Published: {{ $book->published_at->format('M d, Y') }}
                                            </p>
                                            <p class="mb-1">
                                                <i class="fas fa-user me-1"></i>
                                                By: {{ $book->author->name }}
                                            </p>
                                        </div>

                                        <div class="mt-2">
                                            <span class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-info-circle me-1"></i>View Details
                                            </span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif
        </main>
    </div>
</div>

    <!-- Footer -->
    <footer class="bg-secondary text-white text-center py-4">
        <p class="mb-0">&copy; {{ date('Y') }} Authors & Books. All rights reserved.</p>
        <p class="mb-0">Created with <i class="fas fa-heart text-danger"></i> by Your Name</p>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
    <script>
    document.getElementById('chat-form').addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const query = document.getElementById('chat-query').value;
        if (!query.trim()) return;

        try {
            const response = await fetch('/chatbot/query', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ query })
            });

            const data = await response.json();
            
            // Add messages to chat
            const chatContent = document.getElementById('chat-content');
            chatContent.innerHTML += `
                <div class="chat-message user mb-2">
                    <small class="text-muted">You:</small>
                    <div class="message">${query}</div>
                </div>
                <div class="chat-message bot mb-2">
                    <small class="text-muted">Bot:</small>
                    <div class="message">${data.response}</div>
                </div>
            `;

            // Clear input
            document.getElementById('chat-query').value = '';
            
            // Scroll to bottom
            chatContent.scrollTop = chatContent.scrollHeight;

        } catch (error) {
            console.error('Error:', error);
        }
    });
    </script>
</body>

</html>