@extends('layouts.admin')

@section('title', 'Criar Novo Post')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Criar Novo Post</h1>
</div>

<form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    
    <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Informações Básicas</h3>
                <p class="mt-1 text-sm text-gray-500">Informações principais do post.</p>
            </div>
            
            <div class="mt-5 space-y-6 md:mt-0 md:col-span-2">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                    <input type="text" name="title" id="title" required
                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                           value="{{ old('title') }}">
                    @error('title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Categoria</label>
                    <select name="category_id" id="category_id"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Selecione uma categoria</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="excerpt" class="block text-sm font-medium text-gray-700">Resumo</label>
                    <textarea name="excerpt" id="excerpt" rows="3"
                              class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
                              placeholder="Resumo opcional do post...">{{ old('excerpt') }}</textarea>
                    @error('excerpt')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="featured_image" class="block text-sm font-medium text-gray-700">Imagem Destacada</label>
                    <input type="file" name="featured_image" id="featured_image" accept="image/*"
                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @error('featured_image')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Conteúdo</h3>
                <p class="mt-1 text-sm text-gray-500">Escreva o conteúdo do seu post.</p>
            </div>
            
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700">Conteúdo</label>

                    {{-- Editor Quill --}}
                    <div id="editor" class="shadow-sm mt-1 border border-gray-300 rounded-md"></div>

                    {{-- Campo hidden que vai com o HTML para o backend --}}
                    <input type="hidden" name="content" id="content">

                    @error('content')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Publicação</h3>
                <p class="mt-1 text-sm text-gray-500">Configure as opções de publicação.</p>
            </div>
            
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="flex items-center">
                    <input id="is_published" name="is_published" type="checkbox" value="1" 
                           {{ old('is_published') ? 'checked' : '' }}
                           class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                    <label for="is_published" class="ml-2 block text-sm text-gray-900">
                        Publicar imediatamente
                    </label>
                </div>
                @error('is_published')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <div class="flex justify-end space-x-3">
        <a href="{{ route('admin.posts.index') }}" 
           class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Cancelar
        </a>
        <button type="submit" 
                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Criar Post
        </button>
    </div>
</form>
@endsection

@push('styles')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
    /* altura mínima confortável pro editor */
    #editor .ql-editor { min-height: 320px; }
</style>
@endpush

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const quill = new Quill('#editor', {
        theme: 'snow',
        placeholder: 'Escreva o conteúdo do post...',
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'header': 1 }, { 'header': 2 }],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                [{ 'align': [] }],
                ['link', 'image'],
                ['clean']
            ]
        }
    });

    // Restaura conteúdo após validação falhar
    @if(old('content'))
        quill.root.innerHTML = @json(old('content'));
    @endif

    // Copia o HTML do Quill pro hidden antes de enviar
    const form = document.querySelector('form');
    form.addEventListener('submit', function () {
        document.getElementById('content').value = quill.root.innerHTML;
    });
});
</script>
@endpush
