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

    {{-- CDN jquery releases.jquery.com (minifed) --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.min.css">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Bootstrap Icons (buat logo lonceng) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

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
    <nav class="bg-white shadow-sm sticky top-0 z-[1000] py-3">
        <div class="container mx-auto flex justify-between items-center px-4">
            <!-- Brand -->
            <a href="#" class="flex items-center space-x-2">
                <svg width="40" height="40" viewBox="0 0 316 316" xmlns="http://www.w3.org/2000/svg">
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
                <span class="font-semibold text-xl text-[#2563eb]">RemindMe</span>
            </a>

            <!-- Links -->
            <div class="hidden md:flex items-center space-x-6">
                <ul class="flex space-x-5 items-center">
                    @if (Auth::check() && Auth::user()->role == 'admin')
                        <li><a href="{{ route('admin.dashboard') }}"
                                class="font-medium hover:text-[#2563eb] {{ request()->routeIs('admin.dashboard') ? 'text-[#2563eb]' : 'text-gray-700' }}">Dashboard</a>
                        </li>
                        <li><a href="{{ route('admin.users.index') }}"
                                class="font-medium hover:text-[#2563eb] {{ request()->routeIs('admin.users.index') ? 'text-[#2563eb]' : 'text-gray-700' }}">Data
                                User</a></li>
                    @else
                        @if (Auth::check() && Auth::user()->role == 'user')
                            <li><a href="{{ route('dashboard') }}"
                                    class="font-medium hover:text-[#2563eb] {{ request()->routeIs('dashboard') ? 'text-[#2563eb]' : 'text-gray-700' }}">Dashboard</a>
                            </li>
                        @else
                            <li><a href="{{ route('home') }}"
                                    class="font-medium hover:text-[#2563eb] {{ request()->routeIs('home') ? 'text-[#2563eb]' : 'text-gray-700' }}">Beranda</a>
                            </li>
                        @endif
                        <li><a href="#" class="font-medium hover:text-[#2563eb] text-gray-700">Projects</a></li>
                        <li><a href="{{ route('reminder.index') }}"
                                class="font-medium hover:text-[#2563eb] {{ request()->routeIs('reminder.index') ? 'text-[#2563eb]' : 'text-gray-700' }}">Reminder</a>
                        </li>
                    @endif
                </ul>
            </div>

            <!-- Right side -->
            <div class="flex items-center space-x-3">
                @if (Auth::check())
                    <!-- Profile Dropdown -->
                    <!-- Profile Dropdown -->
                    <div class="relative">
                        <button id="profileDropdownBtn" class="flex items-center space-x-2 focus:outline-none">
                            <img src="{{ Auth::user()->profilePhotoUrl() }}" alt="Profile"
                                class="w-12 h-12 rounded-full object-cover border border-gray-300" />
                            <!-- Arrow icon -->
                            <svg id="dropdownArrow" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                class="w-4 h-4 text-gray-600 transition-transform duration-200">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div id="profileDropdownMenu"
                            class="hidden absolute right-0 mt-3 w-52 px-1 bg-white rounded-lg shadow-lg border border-gray-100 transition-all duration-200">
                            <div class="text-center py-3 border-b">
                                <img src="{{ Auth::user()->profilePhotoUrl() }}"
                                    class="w-14 h-14 rounded-full mx-auto object-cover mb-1">
                                <div class="font-medium text-gray-800">{{ Auth::user()->name }}</div>
                                @if (Auth::user()->username)
                                    <small class="text-gray-500">{{ '@' . Auth::user()->username }}</small>
                                @endif
                            </div>
                            <a href="{{ route('user.profile') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil Saya</a>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Pengaturan</a>
                            <hr>
                            <a href="{{ route('logout') }}"
                                class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Logout</a>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-[#2563eb] font-medium hover:underline">Login</a>
                    <a href="{{ route('signup') }}"
                        class="bg-[#2563eb] hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg shadow-sm transition">Sign
                        Up</a>
                @endif
            </div>
        </div>
    </nav>
    <!-- Navbar End -->
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

    @stack('script')
    {{-- datatable CDN (cdn.datatables.net) --}}
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>
    {{-- mdb bootstrap --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/9.1.0/mdb.umd.min.js"></script>
    {{-- bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
        integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous">
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const btn = document.getElementById("profileDropdownBtn");
            const menu = document.getElementById("profileDropdownMenu");
            const arrow = document.getElementById("dropdownArrow");

            btn.addEventListener("click", (e) => {
                e.stopPropagation();
                menu.classList.toggle("hidden");
                arrow.classList.toggle("rotate-180"); // animasi panah naik turun
            });

            // Tutup dropdown kalau klik di luar
            document.addEventListener("click", (e) => {
                if (!menu.contains(e.target) && !btn.contains(e.target)) {
                    menu.classList.add("hidden");
                    arrow.classList.remove("rotate-180");
                }
            });
        });
    </script>
</body>

</html>
