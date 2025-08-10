@extends('layouts.app')

@section('title', 'mydump.xyz - Página Inicial')

@section('description', 'Últimos posts do nosso blog')

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-semibold text-gray-900">Posts</h1>
        <p class="mt-1 text-sm text-gray-600">Últimos posts publicados</p>
    </div>

    @php
        $posts = $groupedPosts->flatMap(fn($group) => $group['posts']);
    @endphp

    @if($posts->isEmpty())
        <div class="p-12 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <h3 class="mt-4 text-lg font-medium text-gray-900">Nenhum post encontrado</h3>
            <p class="mt-2 text-sm text-gray-600">Seja o primeiro a publicar um post!</p>
        </div>
    @else
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($posts as $post)
                <a href="{{ route('blog.show', $post) }}" class="block p-6 bg-white border border-gray-100 rounded-lg hover:shadow-sm transition">
                    <h2 class="text-lg font-medium text-gray-900">{{ $post->title }}</h2>
                    <p class="mt-4 text-xs text-gray-500 text-right">{{ $post->published_at->format('d/m/Y') }}</p>
                </a>
            @endforeach
        </div>
    @endif
@endsection

@section('sidebar')
    @auth
        <div class="space-y-2">
            <h3 class="text-sm font-medium text-gray-900">Admin</h3>
            <a href="{{ route('admin.posts.index') }}" class="block text-gray-600 hover:text-gray-900 text-sm">Gerenciar Posts</a>
            <a href="{{ route('admin.categories.index') }}" class="block text-gray-600 hover:text-gray-900 text-sm">Gerenciar Categorias</a>
        </div>
    @endauth
@endsection
