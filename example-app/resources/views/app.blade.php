<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Clínica Médica</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .navbar-brand {
            font-weight: 600;
            font-size: 1.5rem;
        }
        .dropdown-menu {
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            border-radius: 0.5rem;
        }
        .dropdown-item-text small {
            color: #6c757d;
            font-size: 0.875rem;
        }
        .dropdown-divider {
            margin: 0.5rem 0;
        }
        .nav-link.dropdown-toggle {
            font-weight: 500;
        }
        .bg-primary {
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%) !important;
        }
    </style>
</head>
<body class="bg-light">
    <!-- Header/Navbar -->
    @auth
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
                    Clínica Médica
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center"
                               href="#" role="button" data-bs-toggle="dropdown"
                               aria-expanded="false">
                                <span class="me-2 fw-semibold">{{ Auth::user()->name }}</span>
                                <i class="bi bi-person-circle"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg">
                                <li>
                                    <span class="dropdown-item-text text-muted">
                                        <small>{{ Auth::user()->especialidade ?? 'Médico' }}</small>
                                    </span>
                                </li>
                                <li><hr class="dropdown-divider my-2"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                        @csrf
                                        <button class="dropdown-item d-flex align-items-center text-danger"
                                                type="submit">
                                            <i class="bi bi-box-arrow-right me-2"></i>
                                            Sair do Sistema
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    @endauth

    <!-- Conteúdo Principal -->
    <main class="container-fluid py-4">
        @yield('content')
    </main>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('js/oauth-client.js') }}"></script>

    <!-- Scripts específicos da página -->
    @stack('scripts')

    <style>
        .dropdown-item:hover {
            background-color: #f8f9fa;
        }
        .dropdown-item:active {
            background-color: #e9ecef;
        }
        .navbar-brand {
            background: linear-gradient(45deg, #ffffff, #e3f2fd);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .nav-link.dropdown-toggle:hover {
            opacity: 0.9;
        }
    </style>
</body>
</html>
