<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - @yield('title')</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('/build/assets/css/style.css') }}" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    @yield('styles')
    <style>
        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
        }

        .sidebar {
            min-width: 250px;
            max-width: 250px;
            min-height: 100vh;
            background: #343a40;
            color: #fff;
            transition: all 0.3s;
        }

        .sidebar.collapsed {
            margin-left: -250px;
        }

        .content {
            width: 100%;
            min-height: 100vh;
            position: relative;
        }

        #sidebarToggle {
            display: none;
        }

        @media (max-width: 768px) {
            .sidebar {
                margin-left: -250px;
            }
            .sidebar.active {
                margin-left: 0;
            }
            #sidebarToggle {
                display: block;
            }
        }

        .sidebar.collapsed + .content #sidebarToggle {
            display: block;
        }

        .sidebar .list-unstyled li a {
            position: relative;
            display: block;
            padding: 10px 15px;
            color: #fff;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .sidebar .list-unstyled li a:hover {
            background: rgba(255,255,255,0.1);
        }

        .sidebar .collapse {
            transition: all 0.3s ease;
        }

        .sidebar .collapse:not(.show) {
            display: none;
        }

        .sidebar .collapse.show {
            display: block;
            background: rgba(0,0,0,0.1);
        }

        .sidebar .collapse li a {
            padding-left: 2.5rem;
            background: rgba(0,0,0,0.1);
        }

        .sidebar .dropdown-toggle {
            position: relative;
        }

        .dropdown-toggle::after {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
        }
        .navbar-dark{
            background-color: #343a40 !important;
            height: 75px;
        }

        .navbar-dark .btn-link {
            color: rgba(255,255,255,.85);
            text-decoration: none;
        }

        .navbar-dark .btn-link:hover {
            color: #fff;
        }

        .dropdown-item-form {
            padding: 0;
        }

        .dropdown-item-form button {
            background: none;
            border: none;
            padding: .25rem 1rem;
        }

        .dropdown-item-form button:hover {
            background-color: #f8f9fa;
        }

        .dropdown-menu {
            min-width: 200px;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <nav class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <a href="{{ route('dashboard') }}" class="text-decoration-none text-light">
                    <h3 class="text-center pt-4">Authors Books</h3>
                </a>
            </div>
            <ul class="list-unstyled components">
                <li>
                    <a href="{{ route('dashboard') }}">
                       <h5> <i class="fas fa-home"></i> Dashboard</h5>
                    </a>
                </li>
                <li>
                    <a href="#authorsSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-users"></i> Manage Authors
                    </a>
                    <ul class="collapse list-unstyled" id="authorsSubmenu">
                        <li><a href="{{ route('authors.index') }}"><i class="fas fa-list"></i> All Authors</a></li>
                        <li><a href="{{ route('authors.create') }}"><i class="fas fa-user-plus"></i> Add New Author</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#booksSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-book"></i> Manage Books
                    </a>
                    <ul class="collapse list-unstyled" id="booksSubmenu">
                        <li><a href="{{ route('books.index') }}"><i class="fas fa-list"></i> All Books</a></li>
                        <li><a href="{{ route('books.create') }}"><i class="fas fa-plus-circle"></i> Add New Book</a></li>
                    </ul>
                </li>

                
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- Page Content -->
        <div class="content" id="content">

            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom">
                <div class="container-fluid">
                    <button class="btn btn-link text-light d-none" id="sidebarToggle" type="button" aria-label="Toggle Sidebar">
                        <i class="fas fa-bars"></i>
                    </button>

                    <div class="dropdown ms-auto">
                        <button class="btn btn-link dropdown-toggle text-light text-decoration-none" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-shield me-2"></i>
                            <span class="d-none d-lg-inline me-4">{{ Auth::user()->name }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="fas fa-user-cog me-2"></i>Profile
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="dropdown-item-form">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger w-100 text-start">
                                        <i class="fas fa-sign-out-alt me-2"></i>{{ __('Log Out') }}
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="container-fluid py-4">
                    
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

   
</body>
</html>