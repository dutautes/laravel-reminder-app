<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RemindMe</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/9.1.0/mdb.min.css" rel="stylesheet" />
    {{-- css --}}
    <style>
        :root {
            --primary-blue: #2563eb;
            --light-blue: #dbeafe;
            --text-gray: #6b7280;
            --dark-gray: #1f2937;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            color: var(--dark-gray);
        }

        .navbar {
            padding: 1.2rem 0;
            background: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-blue) !important;
        }

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

        .nav-link.active {
            color: var(--primary-blue) !important;
        }
    </style>
    @stack('style')
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm py-3" style="background: #f8f9fa;">
        <!-- Container wrapper -->
        <div class="container d-flex justify-content-center align-items-center">
            <!-- Navbar brand -->
            <a class="navbar-brand d-flex align-items-center gap-2 me-5" href="#">
                <svg width="40" height="40" viewBox="0 0 316 316" xmlns="http://www.w3.org/2000/svg">
                    <!-- Abstract Check Shape - Laravel Style -->

                    <!-- Left Side -->
                    <path d="M 80 158 L 120 120 L 120 80 L 158 50 L 158 100 L 130 120 L 130 195 L 80 220 Z"
                        stroke="#2563eb" stroke-width="8" fill="none" stroke-linejoin="round" />

                    <!-- Middle -->
                    <path d="M 158 100 L 195 120 L 195 195 L 158 220 L 158 170 L 180 158 L 180 132 L 158 145 Z"
                        stroke="#2563eb" stroke-width="8" fill="none" stroke-linejoin="round" />

                    <!-- Right Side -->
                    <path
                        d="M 195 120 L 235 100 L 235 50 L 270 80 L 270 220 L 235 240 L 235 132 L 220 140 L 220 210 L 195 195 Z"
                        stroke="#2563eb" stroke-width="8" fill="none" stroke-linejoin="round" />
                </svg>
                <span>RemindMe</span>
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
                            <a class="nav-link fw-semibold {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                                href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}"
                                class="nav-link fw-semibold {{ request()->routeIs('admin.users.index') ? 'active' : '' }}">Data
                                User</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link fw-semibold custom-hover-underline {{ request()->routeIs('home') ? 'active' : '' }}"
                                href="{{ route('dashboard') }}">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link fw-semibold custom-hover-underline">Projects</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('reminder.index') }}"
                                class="nav-link fw-semibold custom-hover-underline {{ request()->routeIs('reminder.index') ? 'active' : '' }}">Reminder</a>
                        </li>
                    @endif
                </ul>
                <!-- Left links -->

                <div class="d-flex align-items-center gap-2">
                    @if (Auth::check())
                        <a href="{{ route('logout') }}" data-mdb-ripple-init type="button"
                            class="btn btn-danger px-4 shadow-sm">
                            Logout
                        </a>
                    @else
                        <a href="{{ route('login') }}" data-mdb-ripple-init type="button"
                            class="btn btn-link px-3 me-2 fw-semibold text-primary">
                            Login
                        </a>
                        <a href="{{ route('signup') }}" data-mdb-ripple-init type="button"
                            class="btn btn-primary me-3 px-4 shadow-sm">
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


    {{-- mdb bootstrap --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/9.1.0/mdb.umd.min.js"></script>
    {{-- bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
        integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous">
    </script>
</body>

</html>
