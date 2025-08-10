@extends('layouts.admin')

@section('title', 'Criar Nova Categoria')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-semibold text-gray-900">Criar Nova Categoria</h1>
    <p class="mt-1 text-sm text-gray-600">Adicione uma nova categoria para organizar seus posts</p>
</div>

<form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-8 max-w-2xl">
    @csrf

    <div class="bg-white rounded-lg border border-gray-100 p-6 space-y-6">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-900 mb-2">
                Nome da Categoria <span class="text-red-500">*</span>
            </label>
            <input type="text"
                   name="name"
                   id="name"
                   required
                   class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-transparent text-sm"
                   value="{{ old('name') }}"
                   placeholder="Ex: Laravel, JavaScript, PHP...">
            @error('name')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-900 mb-2">Descrição</label>
            <textarea name="description"
                      id="description"
                      rows="3"
                      class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-transparent text-sm"
                      placeholder="Descrição opcional da categoria...">{{ old('description') }}</textarea>
            @error('description')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="color" class="block text-sm font-medium text-gray-900 mb-2">Cor da Categoria</label>
            <div class="flex items-center space-x-3">
                <input type="color"
                       name="color"
                       id="color"
                       value="{{ old('color', '#3B82F6') }}"
                       class="h-10 w-20 border border-gray-200 rounded-lg">
                <span class="text-sm text-gray-500">
                    Escolha uma cor para identificar esta categoria
                </span>
            </div>
            @error('color')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="border-t border-gray-100 pt-6">
            <h3 class="text-sm font-medium text-gray-900 mb-3">Preview:</h3>
            <div class="flex items-center">
                <span id="preview-badge"
                      class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium text-white"
                      style="background-color: #3B82F6;">
                    <span id="preview-text">Nome da Categoria</span>
                </span>
            </div>
        </div>
    </div>

    <div class="flex justify-end space-x-3">
        <a href="{{ route('admin.categories.index') }}"
           class="px-4 py-2 border border-gray-200 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
            Cancelar
        </a>
        <button type="submit"
                class="px-4 py-2 bg-gray-900 text-white rounded-lg text-sm font-medium hover:bg-gray-800 transition-colors">
            Criar Categoria
        </button>
    </div>
</form>
@endsection

@push('scripts')
<script>
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
@endpush
