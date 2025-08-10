@extends('layouts.admin')

@section('title', 'Editar Categoria: ' . $category->name)

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Editar Categoria</h1>
</div>

<form action="{{ route('admin.categories.update', $category) }}" method="POST" class="max-w-2xl">
    @csrf
    @method('PUT')
    
    <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6 space-y-6">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                Nome da Categoria
            </label>
            <input type="text" 
                   name="name" 
                   id="name" 
                   required
                   class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                   value="{{ old('name', $category->name) }}"
                   placeholder="Ex: Laravel, JavaScript, PHP...">
            @error('name')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                Descrição
            </label>
            <textarea name="description" 
                      id="description" 
                      rows="3"
                      class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
                      placeholder="Descrição opcional da categoria...">{{ old('description', $category->description) }}</textarea>
            @error('description')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="color" class="block text-sm font-medium text-gray-700 mb-2">
                Cor da Categoria
            </label>
            <div class="flex items-center space-x-3">
                <input type="color" 
                       name="color" 
                       id="color" 
                       value="{{ old('color', $category->color) }}"
                       class="h-10 w-20 border border-gray-300 rounded-md">
                <span class="text-sm text-gray-500">
                    Escolha uma cor para identificar esta categoria
                </span>
            </div>
            @error('color')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Preview -->
        <div class="border-t pt-6">
            <h3 class="text-sm font-medium text-gray-700 mb-3">Preview:</h3>
            <div class="flex items-center">
                <span id="preview-badge" 
                      class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium text-white"
                      style="background-color: {{ $category->color }};">
                    <span id="preview-text">{{ $category->name }}</span>
                </span>
            </div>
        </div>

        <!-- Informações adicionais -->
        <div class="border-t pt-6">
            <div class="grid grid-cols-2 gap-4 text-sm text-gray-600">
                <div>
                    <strong>Posts nesta categoria:</strong> {{ $category->posts()->count() }}
                </div>
                <div>
                    <strong>Criada em:</strong> {{ $category->created_at->format('d/m/Y H:i') }}
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6 flex justify-end space-x-3">
        <a href="{{ route('admin.categories.index') }}" 
           class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
            Cancelar
        </a>
        <button type="submit" 
                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
            Atualizar Categoria
        </button>
    </div>
</form>

<script>
// Preview em tempo real
document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.getElementById('name');
    const colorInput = document.getElementById('color');
    const previewBadge = document.getElementById('preview-badge');
    const previewText = document.getElementById('preview-text');
    
    function updatePreview() {
        const name = nameInput.value || 'Nome da Categoria';
        const color = colorInput.value;
        
        previewText.textContent = name;
        previewBadge.style.backgroundColor = color;
    }
    
    nameInput.addEventListener('input', updatePreview);
    colorInput.addEventListener('input', updatePreview);
});
</script>
@endsection
