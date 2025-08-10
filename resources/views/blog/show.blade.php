@extends('layouts.app')

@section('title', $post->title)

@section('description', $post->excerpt)

@section('content')
<div class="max-w-none">
    <article class="mb-8">
        <div class="mb-6">
            <a href="{{ route('blog.index') }}" class="text-sm text-gray-500 hover:text-gray-900">← Voltar ao blog</a>
        </div>

        <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $post->title }}</h1>

        <div class="mb-6 text-gray-600 text-sm">
            <span>{{ $post->published_at->format('d/m/Y') }}</span>
            @if($post->category)
                <span class="mx-2">•</span>
                <a href="{{ route('blog.category', $post->category) }}" class="text-gray-500 hover:text-gray-900">
                    {{ $post->category->name }}
                </a>
            @endif
            <span class="mx-2">•</span>
            <span>Por {{ $post->user->name }}</span>
        </div>

        <div class="prose max-w-none">
            {!! nl2br(e($post->content)) !!}
        </div>
    </article>

    @if($relatedPosts->count() > 0)
        <div class="mt-12 pt-6 border-t border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Posts Relacionados</h3>
            <div class="space-y-3">
                @foreach($relatedPosts as $relatedPost)
                    <a href="{{ route('blog.show', $relatedPost) }}" class="block text-gray-600 hover:text-gray-900">
                        {{ $relatedPost->title }}
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection

@section('sidebar')
<div class="space-y-2">
    <a href="{{ route('blog.index') }}" class="block text-gray-600 hover:text-gray-900 text-sm">← Voltar ao blog</a>

    @if($post->category)
        <a href="{{ route('blog.category', $post->category) }}" class="block text-gray-600 hover:text-gray-900 text-sm">
            Mais posts em {{ $post->category->name }}
        </a>
    @endif

    @if($relatedPosts->count() > 0)
        <div class="pt-4 border-t border-gray-200">
            <h4 class="text-sm font-medium text-gray-900">Posts Relacionados</h4>
            <div class="mt-2 space-y-1">
                @foreach($relatedPosts->take(5) as $relatedPost)
                    <a href="{{ route('blog.show', $relatedPost) }}" class="block text-gray-600 hover:text-gray-900 text-sm">
                        {{ Str::limit($relatedPost->title, 40) }}
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    @auth
        <div class="pt-4 border-t border-gray-200">
            <h4 class="text-sm font-medium text-gray-900">Admin</h4>
            <a href="{{ route('admin.posts.edit', $post) }}" class="block text-gray-600 hover:text-gray-900 text-sm">Editar este post</a>
            <a href="{{ route('admin.posts.index') }}" class="block text-gray-600 hover:text-gray-900 text-sm">Todos os posts</a>
        </div>
    @endauth
</div>
@endsection
