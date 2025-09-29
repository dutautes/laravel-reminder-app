<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reminder App</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/9.1.0/mdb.min.css" rel="stylesheet" />
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm py-2" style="background: #f8f9fa;">
        <!-- Container wrapper -->
        <div class="container d-flex justify-content-center align-items-center">
            <!-- Navbar brand -->
            <a class="navbar-brand me-4 fw-bold text-primary" href="#" style="font-size: 1.5rem;">
                <i class="fa-regular fa-note-sticky me-2"></i>NotePro
            </a>

            <!-- Toggle button -->
            <button data-mdb-collapse-init class="navbar-toggler" type="button" data-mdb-target="#navbarButtonsExample"
                aria-controls="navbarButtonsExample" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarButtonsExample">
                <!-- Left links -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @if (Auth::check() && Auth::user()->role == 'admin')
                        <li class="nav-item">
                            <a class="nav-link active fw-semibold" href="#" style="color: #0d6efd;">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold" href="#" style="color: #0d6efd;">Data User</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link active fw-semibold custom-hover-underline" href="{{ route('home') }}"
                                style="color: #0d6efd;">Beranda</a>
                        </li>
                        <style>
                            .custom-hover-underline {
                                position: relative;
                                transition: color 0.2s;
                            }

                            .custom-hover-underline::after {
                                content: '';
                                position: absolute;
                                left: 0;
                                bottom: 0;
                                width: 0;
                                height: 1.5px;
                                background: #0d6efd;
                                transition: width 0.3s;
                            }

                            .custom-hover-underline:hover::after {
                                width: 100%;
                            }
                        </style>
                        <li class="nav-item">
                            <a href="#" class="nav-link fw-semibold custom-hover-underline">Projects</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link fw-semibold custom-hover-underline">Reminder</a>
                        </li>
                    @endif
                </ul>
                <!-- Left links -->

                <div class="d-flex align-items-center gap-2">
                    @if (Auth::check())
                        <a href="{{ route('logout') }}" data-mdb-ripple-init type="button"
                            class="btn btn-danger px-4 rounded-pill shadow-sm">
                            Logout
                        </a>
                    @else
                        <a href="{{ route('login') }}" data-mdb-ripple-init type="button"
                            class="btn btn-link px-3 me-2 fw-semibold text-primary">
                            Login
                        </a>
                        <a href="{{ route('signup') }}" data-mdb-ripple-init type="button"
                            class="btn btn-primary me-3 px-4 rounded-pill shadow-sm">
                            Sign up
                        </a>
                    @endif
                </div>
            </div>
            <!-- Collapsible wrapper -->
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
    @yield('content');
    {{-- Footer --}}
    <footer class="bg-body-tertiary text-center text-lg-start" style="margin-top: 10rem">
        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2025 Copyright:
            <a class="text-body" href="#">dutasuksesif@gmail.com</a>
        </div>
        <!-- Copyright -->
    </footer>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/9.1.0/mdb.umd.min.js"></script>
</body>

</html>
