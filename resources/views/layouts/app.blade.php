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
    
    <style>
        html {
            scroll-behavior: smooth;
        }
        
        body {
            font-family: system-ui, -apple-system, sans-serif;
            line-height: 1.6;
            color: #333;
            background: #fff;
        }
        
        .blog-title {
            font-size: 2.5rem;
            font-weight: 600;
            text-align: center;
            margin: 2rem 0;
            color: #1a1a1a;
        }
        
        .month-section {
            margin-bottom: 2.5rem;
        }
        
        .month-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: #1a1a1a;
        }
        
        .post-list {
            list-style: none;
            padding: 0;
        }
        
        .post-item {
            margin-bottom: 0.5rem;
            padding-left: 1rem;
            position: relative;
        }
        
        .post-item::before {
            content: '•';
            position: absolute;
            left: 0;
            color: #666;
        }
        
        .post-link {
            color: #0066cc;
            text-decoration: none;
            font-size: 1rem;
        }
        
        .post-link:hover {
            text-decoration: underline;
        }
        
        .sidebar {
            background: #f8f9fa;
            padding: 1.5rem;
            border-left: 1px solid #e9ecef;
        }
        
        .sidebar-title {
            font-weight: 600;
            margin-bottom: 1rem;
            color: #1a1a1a;
        }
        
        .sidebar-link {
            display: block;
            color: #666;
            text-decoration: none;
            padding: 0.25rem 0;
            font-size: 0.9rem;
        }
        
        .sidebar-link:hover {
            color: #0066cc;
        }
        
        .title-bar {
            background: #fff;
            border-bottom: 1px solid #e9ecef;
            padding: 0.5rem 0;
            text-align: center;
            font-size: 1.25rem;
        }
        
        .admin-link {
            color: #666;
            text-decoration: none;
            margin: 0 1rem;
        }
        
        .admin-link:hover {
            color: #0066cc;
        }
        
        /* Responsividade */
        @media (max-width: 1024px) {
            .sidebar {
                margin-top: 2rem;
                border-left: none;
                border-top: 1px solid #e9ecef;
                padding-top: 1.5rem;
            }
        }
        
        @media (max-width: 768px) {
            .blog-title {
                font-size: 2rem;
            }
            
            .month-title {
                font-size: 1.25rem;
            }
        }
        
        /* Melhorar links de post */
        .post-link {
            transition: color 0.2s ease;
        }
        
        /* Estilo do prose para conteúdo de posts */
        .prose {
            line-height: 1.7;
            font-size: 1rem;
        }
        
        .prose p {
            margin-bottom: 1rem;
        }
        
        .prose h1, .prose h2, .prose h3 {
            margin-top: 1.5rem;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }
        
        .prose ul, .prose ol {
            margin: 1rem 0;
            padding-left: 1.5rem;
        }
        
        .prose blockquote {
            border-left: 4px solid #0066cc;
            padding-left: 1rem;
            margin: 1rem 0;
            font-style: italic;
            color: #666;
        }
    </style>
</head>
<body class="bg-white">
    <!-- Titulo -->
        <div class="title-bar mb-10">
            <a href="{{ route('blog.index') }}" >
                @yield('blog-title', 'mydump.xyz')
            </a>
        </div>
    <!-- Main Container -->
    <div class="max-w-6xl mx-auto px-4">
        <!-- Blog Title -->

        <!-- Messages -->
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded">
                {{ session('error') }}
            </div>
        @endif

        <!-- Main Layout -->
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Main Content -->
            <main class="flex-1 lg:flex-none lg:w-2/3">
                @yield('content')
            </main>

            <!-- Sidebar -->
            <aside class="lg:w-1/3">
                @yield('sidebar')
            </aside>
        </div>
    </div>
</body>
</html>
