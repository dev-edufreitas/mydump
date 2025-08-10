@extends('layouts.admin')

@section('title', 'Posts')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-semibold text-gray-900">Posts</h1>
        <p class="mt-1 text-sm text-gray-600">Gerencie todos os seus posts do blog</p>
    </div>
    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
        Novo Post
    </a>
</div>

<div class="admin-card">
    @forelse($posts as $post)
        <div class="p-6 border-b border-gray-100 last:border-b-0">
            <div class="flex items-start justify-between">
                <div class="flex-1 min-w-0">
                    <div class="flex items-center space-x-3 mb-2">
                        <h3 class="text-lg font-medium text-gray-900 truncate">
                            {{ $post->title }}
                        </h3>
                        <x-status-badge :published="$post->is_published" />
                    </div>

                    @if($post->excerpt)
                        <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ $post->excerpt }}</p>
                    @endif

                    <div class="flex items-center space-x-6 text-xs text-gray-500">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            {{ $post->user?->name ?? '—' }}
                        </span>

                        @if($post->category)
                            <span class="flex items-center">
                                <span class="w-2 h-2 rounded-full mr-1.5" style="background-color: {{ $post->category->color ?? '#e5e7eb' }}"></span>
                                {{ $post->category->name }}
                            </span>
                        @endif

                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ optional($post->created_at)->format('d/m/Y') }}
                        </span>
                    </div>
                </div>

                <div class="ml-6 flex items-center space-x-3">
                    @if($post->is_published)
                        <x-action-button 
                            :href="route('blog.show', $post)" 
                            title="Ver no blog"
                            :icon="'<svg class=\'w-5 h-5\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\' aria-hidden=\'true\'>
                                <path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M15 12a3 3 0 11-6 0 3 3 0 016 0z\' />
                                <path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z\' />
                            </svg>'" />
                    @endif

                    <x-action-button 
                        :href="route('admin.posts.edit', $post)" 
                        title="Editar"
                        :icon="'<svg class=\'w-5 h-5\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\' aria-hidden=\'true\'>
                            <path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z\' />
                        </svg>'" />

                    <form method="POST" action="{{ route('admin.posts.destroy', $post) }}"
                          class="inline"
                          onsubmit="return confirm('Tem certeza que deseja deletar este post?')">
                        @csrf
                        @method('DELETE')
                        <x-action-button 
                            :danger="true"
                            title="Excluir"
                            :icon="'<svg class=\'w-5 h-5\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\' aria-hidden=\'true\'>
                                <path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16\' />
                            </svg>'" />
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="empty-state">
            <svg class="empty-state-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <h3 class="empty-state-title">Nenhum post encontrado</h3>
            <p class="empty-state-description">Comece criando seu primeiro post para o blog.</p>
            <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
                Criar primeiro post
            </a>
        </div>
    @endforelse
</div>

@if(method_exists($posts, 'hasPages') && $posts->hasPages())
    <div class="mt-6">
        {{ $posts->links() }}
    </div>
@endif
@endsection