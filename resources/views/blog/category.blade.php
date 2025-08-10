@extends('layouts.app')

@section('title', 'Categoria: ' . $category->name)
@section('description', $category->description ?: 'Posts da categoria ' . $category->name)

@section('content')
<div class="mb-8">
    <!-- Voltar ao blog -->
    <div class="mb-6">
        <a href="{{ route('blog.index') }}" class="post-link">← Voltar ao blog</a>
    </div>
    
    <!-- Título da categoria -->
    <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $category->name }}</h1>
    
    @if($category->description)
        <p class="text-gray-600 mb-4">{{ $category->description }}</p>
    @endif
    
    <p class="text-gray-500 text-sm mb-6">{{ $posts->total() }} post(s) nesta categoria</p>
</div>

<!-- Lista de posts -->
<div class="month-section">
    <ul class="post-list">
        @forelse($posts as $post)
            <li class="post-item">
                <a href="{{ route('blog.show', $post) }}" class="post-link">
                    {{ $post->title }}
                </a>
                <span class="text-gray-500 text-sm ml-2">
                    • {{ $post->published_at->format('d/m/Y') }}
                </span>
            </li>
        @empty
            <li class="text-center py-12">
                <p class="text-gray-600">Nenhum post encontrado nesta categoria</p>
            </li>
        @endforelse
    </ul>
</div>

<!-- Paginação -->
@if($posts->hasPages())
    <div class="mt-8">
        {{ $posts->links() }}
    </div>
@endif
@endsection

@section('sidebar')
<div class="sidebar">
    <h3 class="sidebar-title">Navegação</h3>
    
    <a href="{{ route('blog.index') }}" class="sidebar-link">← Voltar ao blog</a>
    
    <div class="mt-6 pt-4 border-t border-gray-200">
        <h4 class="sidebar-title text-sm">Sobre esta categoria</h4>
        <div class="text-sm text-gray-600">
            <p class="mb-2"><strong>Nome:</strong> {{ $category->name }}</p>
            @if($category->description)
                <p class="mb-2"><strong>Descrição:</strong> {{ $category->description }}</p>
            @endif
            <p><strong>Posts:</strong> {{ $posts->total() }}</p>
        </div>
    </div>
    
    @auth
        <div class="mt-6 pt-4 border-t border-gray-200">
            <h4 class="sidebar-title text-sm">Admin</h4>
            <a href="{{ route('admin.categories.edit', $category) }}" class="sidebar-link">Editar categoria</a>
            <a href="{{ route('admin.categories.index') }}" class="sidebar-link">Todas as categorias</a>
        </div>
    @endauth
</div>
@endsection
