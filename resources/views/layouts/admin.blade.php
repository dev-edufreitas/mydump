<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin - mydump.xyz')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('admin.posts.index') }}" class="text-xl font-bold text-gray-900">
                        Admin - mydump.xyz
                    </a>
                    <div class="ml-8 flex space-x-4">
                        <a href="{{ route('admin.posts.index') }}" 
                           class="text-gray-700 hover:text-gray-900 px-3 py-2 {{ request()->routeIs('admin.posts.*') ? 'border-b-2 border-blue-500' : '' }}">
                            Posts
                        </a>
                        <a href="{{ route('admin.categories.index') }}" 
                           class="text-gray-700 hover:text-gray-900 px-3 py-2 {{ request()->routeIs('admin.categories.*') ? 'border-b-2 border-blue-500' : '' }}">
                            Categorias
                        </a>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <a href="{{ route('blog.index') }}" class="text-gray-700 hover:text-gray-900">
                        Ver Blog
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-700 hover:text-gray-900">
                            Sair
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
