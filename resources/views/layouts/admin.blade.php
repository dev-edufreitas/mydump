<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin - mydump.xyz')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-white font-sans antialiased">
    <nav class="admin-nav">
        <div class="max-w-6xl mx-auto px-6">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('admin.posts.index') }}" class="text-lg font-semibold text-gray-900">
                        mydump.xyz
                    </a>
                    <div class="ml-12 flex space-x-8">
                        <a href="{{ route('admin.posts.index') }}" 
                           class="admin-nav-link {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
                            Posts
                        </a>
                        <a href="{{ route('admin.categories.index') }}" 
                           class="admin-nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                            Categorias
                        </a>
                    </div>
                </div>
                
                <div class="flex items-center space-x-6">
                    <a href="{{ route('blog.index') }}" class="text-sm font-medium text-gray-500 hover:text-gray-900">
                        Ver Blog
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm font-medium text-gray-500 hover:text-gray-900">
                            Sair
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto py-8 px-6">
        <x-alert type="success" :message="session('success')" />
        <x-alert type="error" :message="session('error')" />

        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
