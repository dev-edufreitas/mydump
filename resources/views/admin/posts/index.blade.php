@extends('layouts.admin')

@section('title', 'Gerenciar Posts')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-900">Posts</h1>
    <a href="{{ route('admin.posts.create') }}" 
       class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
        Novo Post
    </a>
</div>

<div class="bg-white shadow overflow-hidden sm:rounded-md">
    <ul class="divide-y divide-gray-200">
        @forelse($posts as $post)
            <li class="px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-900 truncate">
                                    {{ $post->title }}
                                </p>
                                <div class="flex items-center mt-2 text-sm text-gray-500 space-x-4">
                                    <span>Por {{ $post->user->name }}</span>
                                    @if($post->category)
                                        <span class="flex items-center">
                                            <span class="w-2 h-2 rounded-full mr-1" 
                                                  style="background-color: {{ $post->category->color }}"></span>
                                            {{ $post->category->name }}
                                        </span>
                                    @endif
                                    <span>{{ $post->created_at->format('d/m/Y H:i') }}</span>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                @if($post->is_published)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Publicado
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Rascunho
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-2 ml-4">
                        @if($post->is_published)
                            <a href="{{ route('blog.show', $post) }}" 
                               class="text-blue-600 hover:text-blue-900 text-sm">
                                Ver
                            </a>
                        @endif
                        <a href="{{ route('admin.posts.edit', $post) }}" 
                           class="text-indigo-600 hover:text-indigo-900 text-sm">
                            Editar
                        </a>
                        <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" 
                              class="inline" onsubmit="return confirm('Tem certeza que deseja deletar este post?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 text-sm">
                                Deletar
                            </button>
                        </form>
                    </div>
                </div>
            </li>
        @empty
            <li class="px-6 py-12 text-center">
                <p class="text-gray-500">Nenhum post encontrado.</p>
                <a href="{{ route('admin.posts.create') }}" 
                   class="text-blue-600 hover:text-blue-800 mt-2 inline-block">
                    Criar seu primeiro post
                </a>
            </li>
        @endforelse
    </ul>
</div>

@if($posts->hasPages())
    <div class="mt-6">
        {{ $posts->links() }}
    </div>
@endif
@endsection
