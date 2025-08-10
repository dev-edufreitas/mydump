@extends('layouts.app')

@section('title', $post->title)

@section('description', $post->excerpt)

@section('content')
<div class="max-w-none">
    <article class="mb-8">
        <!-- Voltar ao blog -->
        <div class="mb-6">
            <a href="{{ route('blog.index') }}" class="post-link">← Voltar ao blog</a>
        </div>
        
        <!-- Título do post -->
        <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $post->title }}</h1>
        
        <!-- Meta informações -->
        <div class="mb-6 text-gray-600 text-sm">
            <span>{{ $post->published_at->format('d/m/Y') }}</span>
            @if($post->category)
                <span class="mx-2">•</span>
                <a href="{{ route('blog.category', $post->category) }}" class="post-link">
                    {{ $post->category->name }}
                </a>
            @endif
            <span class="mx-2">•</span>
            <span>Por {{ $post->user->name }}</span>
        </div>
        
        <!-- Conteúdo -->
        <div class="prose max-w-none">
            {!! nl2br(e($post->content)) !!}
        </div>
    </article>

    <!-- Posts relacionados -->
    @if($relatedPosts->count() > 0)
        <div class="mt-12 pt-6 border-t border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Posts Relacionados</h3>
            <ul class="post-list">
                @foreach($relatedPosts as $relatedPost)
                    <li class="post-item">
                        <a href="{{ route('blog.show', $relatedPost) }}" class="post-link">
                            {{ $relatedPost->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

</div>
@endsection

@section('sidebar')
<div class="sidebar">
    <h3 class="sidebar-title">Navegação</h3>
    
    <a href="{{ route('blog.index') }}" class="sidebar-link">← Voltar ao blog</a>
    
    @if($post->category)
        <a href="{{ route('blog.category', $post->category) }}" class="sidebar-link">
            Mais posts em {{ $post->category->name }}
        </a>
    @endif
    
    @if($relatedPosts->count() > 0)
        <div class="mt-4">
            <h4 class="sidebar-title text-sm">Posts Relacionados</h4>
            @foreach($relatedPosts->take(5) as $relatedPost)
                <a href="{{ route('blog.show', $relatedPost) }}" class="sidebar-link">
                    {{ Str::limit($relatedPost->title, 40) }}
                </a>
            @endforeach
        </div>
    @endif
    
    @auth
        <div class="mt-6 pt-4 border-t border-gray-200">
            <h4 class="sidebar-title text-sm">Admin</h4>
            <a href="{{ route('admin.posts.edit', $post) }}" class="sidebar-link">Editar este post</a>
            <a href="{{ route('admin.posts.index') }}" class="sidebar-link">Todos os posts</a>
        </div>
    @endauth
</div>
@endsection
