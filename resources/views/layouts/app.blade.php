<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'mydump.xyz')</title>
    <meta name="description" content="@yield('description', 'Apenas um dump')">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=system-ui:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white">
    <!-- Titulo -->
    <div class="title-bar mb-10">
        <a href="{{ route('blog.index') }}" class="text-lg font-semibold text-gray-900">
            @yield('blog-title', 'mydump.xyz')
        </a>
    </div>

    <!-- Main Container -->
    <div class="max-w-6xl mx-auto px-4">
        <!-- Messages -->
        <x-alert type="success" :message="session('success')" />
        <x-alert type="error" :message="session('error')" />

        <!-- Main Layout -->
        <div class="flex flex-col lg:flex-row gap-8">
            <main class="flex-1 lg:flex-none lg:w-3/3">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
