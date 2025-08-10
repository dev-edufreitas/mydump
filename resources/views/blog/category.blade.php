@extends('layouts.app')

@section('title', 'Categoria: ' . $category->name)
@section('description', $category->description ?: 'Posts da categoria ' . $category->name)

@section('content')
<div class="mb-8">
    <div class="mb-6">
        <a href="{{ route('blog.index') }}" class="text-sm text-gray-500 hover:text-gray-900">← Voltar ao blog</a>
    </div>

    <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $category->name }}</h1>

    @if($category->description)
        <p class="text-gray-600 mb-4">{{ $category->description }}</p>
    @endif

    <p class="text-gray-500 text-sm mb-6">{{ $posts->total() }} post(s) nesta categoria</p>
</div>

@if($posts->isEmpty())
    <div class="p-12 text-center">
        <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
        </svg>
        <h3 class="mt-4 text-lg font-medium text-gray-900">Nenhum post encontrado</h3>
        <p class="mt-2 text-sm text-gray-600">Nenhum post encontrado nesta categoria</p>
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

@if($posts->hasPages())
    <div class="mt-8">
        {{ $posts->links() }}
    </div>
@endif
@endsection

@section('sidebar')
<div class="space-y-2">
    <a href="{{ route('blog.index') }}" class="block text-gray-600 hover:text-gray-900 text-sm">← Voltar ao blog</a>

    <div class="pt-4 border-t border-gray-200">
        <h4 class="text-sm font-medium text-gray-900">Sobre esta categoria</h4>
        <div class="mt-2 text-sm text-gray-600">
            <p class="mb-2"><strong>Nome:</strong> {{ $category->name }}</p>
            @if($category->description)
                <p class="mb-2"><strong>Descrição:</strong> {{ $category->description }}</p>
            @endif
            <p><strong>Posts:</strong> {{ $posts->total() }}</p>
        </div>
    </div>

    @auth
        <div class="pt-4 border-t border-gray-200">
            <h4 class="text-sm font-medium text-gray-900">Admin</h4>
            <a href="{{ route('admin.categories.edit', $category) }}" class="block text-gray-600 hover:text-gray-900 text-sm">Editar categoria</a>
            <a href="{{ route('admin.categories.index') }}" class="block text-gray-600 hover:text-gray-900 text-sm">Todas as categorias</a>
        </div>
    @endauth
</div>
@endsection
