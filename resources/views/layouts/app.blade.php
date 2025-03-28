<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <!-- Navbar -->
        @include('layouts.navigation')

        <!-- Page Content -->
        <main class="flex-1 p-6">
            @yield('content') {{-- Gunakan @yield agar konten halaman bisa diisi --}}
        </main>
    </div>
</body>

</html>
