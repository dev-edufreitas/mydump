@extends('layouts.admin')

@section('title', 'Categorias')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-semibold text-gray-900">Categorias</h1>
        <p class="mt-1 text-sm text-gray-600">Gerencie todas as categorias do blog</p>
    </div>
    <a href="{{ route('admin.categories.create') }}"
       class="bg-gray-900 text-white px-4 py-2 rounded-lg hover:bg-gray-800 text-sm font-medium transition-colors">
        Nova Categoria
    </a>
</div>

<div class="bg-white rounded-lg border border-gray-100">
    @forelse($categories as $category)
        <div class="p-6 border-b border-gray-100 last:border-b-0">
            <div class="flex items-start justify-between">
                <div class="flex-1 min-w-0 flex items-start space-x-3">
                    <span class="w-2 h-2 rounded-full flex-shrink-0 mt-2" style="background-color: {{ $category->color }}"></span>
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">{{ $category->name }}</h3>
                        @if($category->description)
                            <p class="text-sm text-gray-600 mt-1 line-clamp-2">{{ $category->description }}</p>
                        @endif
                        <div class="flex items-center space-x-6 mt-3 text-xs text-gray-500">
                            <span>{{ $category->posts_count }} post(s)</span>
                            <span>{{ $category->created_at->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>

                <div class="ml-6 flex items-center space-x-3">
                    <a href="{{ route('blog.category', $category) }}" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </a>
                    <a href="{{ route('admin.categories.edit', $category) }}" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </a>
                    @if($category->posts_count == 0)
                        <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="inline" onsubmit="return confirm('Tem certeza que deseja deletar esta categoria?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="p-12 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <h3 class="mt-4 text-lg font-medium text-gray-900">Nenhuma categoria encontrada</h3>
            <p class="mt-2 text-sm text-gray-600">Crie sua primeira categoria para organizar seus posts.</p>
            <a href="{{ route('admin.categories.create') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-gray-900 text-white text-sm font-medium rounded-lg hover:bg-gray-800 transition-colors">
                Criar primeira categoria
            </a>
        </div>
    @endforelse
</div>

@if($categories->hasPages())
    <div class="mt-6">
        {{ $categories->links() }}
    </div>
@endif
@endsection
