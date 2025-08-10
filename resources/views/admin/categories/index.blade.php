@extends('layouts.admin')

@section('title', 'Gerenciar Categorias')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-900">Categorias</h1>
    <a href="{{ route('admin.categories.create') }}" 
       class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
        Nova Categoria
    </a>
</div>

<div class="bg-white shadow overflow-hidden sm:rounded-md">
    <ul class="divide-y divide-gray-200">
        @forelse($categories as $category)
            <li class="px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center">
                            <span class="w-4 h-4 rounded-full mr-3" 
                                  style="background-color: {{ $category->color }}"></span>
                            <div>
                                <p class="text-sm font-medium text-gray-900">
                                    {{ $category->name }}
                                </p>
                                @if($category->description)
                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ $category->description }}
                                    </p>
                                @endif
                                <div class="flex items-center mt-2 text-sm text-gray-500 space-x-4">
                                    <span>{{ $category->posts_count }} post(s)</span>
                                    <span>{{ $category->created_at->format('d/m/Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-2 ml-4">
                        <a href="{{ route('blog.category', $category) }}" 
                           class="text-blue-600 hover:text-blue-900 text-sm">
                            Ver
                        </a>
                        <a href="{{ route('admin.categories.edit', $category) }}" 
                           class="text-indigo-600 hover:text-indigo-900 text-sm">
                            Editar
                        </a>
                        @if($category->posts_count == 0)
                            <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" 
                                  class="inline" onsubmit="return confirm('Tem certeza que deseja deletar esta categoria?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 text-sm">
                                    Deletar
                                </button>
                            </form>
                        @else
                            <span class="text-gray-400 text-sm">Não pode deletar</span>
                        @endif
                    </div>
                </div>
            </li>
        @empty
            <li class="px-6 py-12 text-center">
                <p class="text-gray-500">Nenhuma categoria encontrada.</p>
                <a href="{{ route('admin.categories.create') }}" 
                   class="text-blue-600 hover:text-blue-800 mt-2 inline-block">
                    Criar sua primeira categoria
                </a>
            </li>
        @endforelse
    </ul>
</div>

@if($categories->hasPages())
    <div class="mt-6">
        {{ $categories->links() }}
    </div>
@endif
@endsection
