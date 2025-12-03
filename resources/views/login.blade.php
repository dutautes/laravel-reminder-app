@extends('templates.app')

@section('content')
    <div class="min-h-screen flex flex-col items-center justify-center bg-gray-50">
        <!-- Logo + Tagline -->
        <div class="text-center mb-4">
            <div class="w-14 h-14 mx-auto flex items-center justify-center rounded-2xl bg-blue-600 text-white text-2xl">
                <i class="bi bi-bell"></i>
            </div>
            <h1 class="text-lg font-semibold mt-3">RemindMe</h1>
            <p class="text-gray-500 text-sm">Stay Organized, Stay Productive</p>
        </div>

        <!-- Card -->
        <div class="bg-white shadow-md rounded-2xl p-8 w-[90%] max-w-md">
            <h2 class="text-gray-700 text-sm mb-3">Welcome Back<br><span class="text-gray-400">Sign in to your account or
                    create a new one</span></h2>

            <!-- Tabs -->
            <div class="flex mb-3 bg-gray-100 rounded-xl">
                <a href="{{ route('login') }}"
                    class="flex-1 text-center py-2 text-white bg-blue-600 rounded-xl font-medium">Login</a>
                <a href="{{ route('signup') }}"
                    class="flex-1 text-center py-2 text-gray-500 hover:text-blue-600 font-medium">Register</a>
            </div>

            <!-- Alert -->
            @if (Session::get('success'))
                <div class="bg-green-100 text-green-800 text-sm p-2 mb-3 rounded">{{ Session::get('success') }}</div>
            @endif
            @if (Session::get('error'))
                <div class="bg-red-100 text-red-800 text-sm p-2 mb-3 rounded">{{ Session::get('error') }}</div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('login.auth') }}" class="space-y-3">
                @csrf

                <div>
                    <label class="text-sm text-gray-600">Email</label>
                    <input type="email" name="email"
                        class="mt-1 w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                    @error('email')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-sm text-gray-600">Password</label>
                    <input type="password" name="password"
                        class="mt-1 w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                    @error('password')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">Login</button>

                <div class="text-center mt-2">
                    <p class="text-sm text-gray-500">Belum punya akun?
                        <a href="{{ route('signup') }}" class="text-blue-600 font-medium hover:underline">Register!</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
@endsection
