@extends('layouts.app')

@section('title', 'mydump.xyz - Página Inicial')

@section('description', 'Últimos posts do nosso blog')

@section('content')
@forelse($groupedPosts as $group)
    <div class="month-section" id="{{ strtolower($group['anchor']) }}">
        <h2 class="month-title">
            {{ $group['year'] }} - {{ $group['month'] }}
            @if(request()->has('month'))
                <span class="text-gray-400 text-lg font-normal">#</span>
            @endif
        </h2>
        
        <ul class="post-list">
            @foreach($group['posts'] as $post)
                <li class="post-item">
                    <a href="{{ route('blog.show', $post) }}" class="post-link">
                        {{ $post->title }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@empty
    <div class="text-center py-12">
        <h2 class="text-xl text-gray-600">Nenhum post encontrado</h2>
        <p class="text-gray-500 mt-2">Seja o primeiro a publicar um post!</p>
    </div>
@endforelse
@endsection

@section('sidebar')
<div class="sidebar">
    <h3 class="sidebar-title">On this page</h3>
    
    @foreach($sidebarDates as $date)
        <a href="#{{ $date['anchor'] }}" class="sidebar-link">
            {{ $date['label'] }}
        </a>
    @endforeach
    
    @auth
        <div class="mt-6 pt-4 border-t border-gray-200">
            <h4 class="sidebar-title text-sm">Admin</h4>
            <a href="{{ route('admin.posts.index') }}" class="sidebar-link">Gerenciar Posts</a>
            <a href="{{ route('admin.categories.index') }}" class="sidebar-link">Gerenciar Categorias</a>
        </div>
    @endauth
</div>
@endsection
