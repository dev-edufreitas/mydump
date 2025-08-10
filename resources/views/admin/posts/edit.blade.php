@extends('layouts.admin')

@section('title', 'Editar Post')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-semibold text-gray-900">Editar Post</h1>
    <p class="mt-1 text-sm text-gray-600">{{ $post->title }}</p>
</div>

<form id="post-form" action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
    @csrf
    @method('PUT')
    
    <!-- Informações Básicas -->
    <div class="bg-white rounded-lg border border-gray-100 p-6">
        <h2 class="text-lg font-medium text-gray-900 mb-6">Informações Básicas</h2>
        
        <div class="space-y-6">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-900 mb-2">
                    Título <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       name="title" 
                       id="title" 
                       required
                       class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-transparent text-sm"
                       placeholder="Digite o título do post"
                       value="{{ old('title', $post->title) }}">
                @error('title')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-900 mb-2">Categoria</label>
                    <select name="category_id" 
                            id="category_id"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-transparent text-sm">
                        <option value="">Selecione uma categoria</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" 
                                {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="featured_image" class="block text-sm font-medium text-gray-900 mb-2">Imagem Destacada</label>
                    @if($post->featured_image)
                        <div class="mb-3">
                            <img src="{{ Storage::url($post->featured_image) }}" 
                                 alt="Imagem atual" 
                                 class="h-20 w-auto rounded-lg border border-gray-200">
                            <p class="text-xs text-gray-500 mt-1">Imagem atual</p>
                        </div>
                    @endif
                    <input type="file" 
                           name="featured_image" 
                           id="featured_image" 
                           accept="image/*"
                           class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-transparent text-sm file:mr-3 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-sm file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100">
                    <p class="text-xs text-gray-500 mt-1">Deixe em branco para manter a imagem atual</p>
                    @error('featured_image')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="excerpt" class="block text-sm font-medium text-gray-900 mb-2">Resumo</label>
                <textarea name="excerpt" 
                          id="excerpt" 
                          rows="3"
                          class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-transparent text-sm"
                          placeholder="Resumo opcional do post (será gerado automaticamente se deixado em branco)">{{ old('excerpt', $post->excerpt) }}</textarea>
                @error('excerpt')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <!-- Conteúdo -->
    <div class="bg-white rounded-lg border border-gray-100 p-6">
        <h2 class="text-lg font-medium text-gray-900 mb-6">Conteúdo</h2>
        
        <div>
            <label for="content" class="block text-sm font-medium text-gray-900 mb-2">
                Conteúdo do Post <span class="text-red-500">*</span>
            </label>
            <div id="editor" class="border border-gray-200 rounded-lg"></div>
            <input type="hidden" name="content" id="content">
            @error('content')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <!-- Configurações de Publicação -->
    <div class="bg-white rounded-lg border border-gray-100 p-6">
        <h2 class="text-lg font-medium text-gray-900 mb-6">Publicação</h2>
        
        <div class="space-y-3">
            <div class="flex items-center">
                <input id="is_published" 
                       name="is_published" 
                       type="checkbox" 
                       value="1" 
                       {{ old('is_published', $post->is_published) ? 'checked' : '' }}
                       class="h-4 w-4 text-gray-900 focus:ring-gray-900 border-gray-300 rounded">
                <label for="is_published" class="ml-3 block text-sm text-gray-900">
                    Publicado
                </label>
            </div>
            
            @if($post->published_at)
                <p class="text-xs text-gray-500">
                    Publicado em: {{ $post->published_at->format('d/m/Y H:i') }}
                </p>
            @else
                <p class="text-xs text-gray-500">
                    Post não publicado (rascunho)
                </p>
            @endif
        </div>
        
        @error('is_published')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Ações -->
    <div class="flex justify-end space-x-3">
        <a href="{{ route('admin.posts.index') }}" 
           class="px-4 py-2 border border-gray-200 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
            Cancelar
        </a>
        <button type="submit" 
                class="px-4 py-2 bg-gray-900 text-white rounded-lg text-sm font-medium hover:bg-gray-800 transition-colors">
            Atualizar Post
        </button>
    </div>
</form>
@endsection

@push('styles')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
    .ql-toolbar {
        border-top: 1px solid #e5e7eb;
        border-left: 1px solid #e5e7eb;
        border-right: 1px solid #e5e7eb;
        border-top-left-radius: 0.5rem;
        border-top-right-radius: 0.5rem;
        background: #fafafa;
    }
    
    .ql-container {
        border-bottom: 1px solid #e5e7eb;
        border-left: 1px solid #e5e7eb;
        border-right: 1px solid #e5e7eb;
        border-bottom-left-radius: 0.5rem;
        border-bottom-right-radius: 0.5rem;
        font-size: 14px;
    }
    
    .ql-editor {
        min-height: 300px;
        font-family: inherit;
    }
    
    .ql-editor.ql-blank::before {
        color: #9ca3af;
        font-style: normal;
    }
</style>
@endpush


@push('scripts')
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
const quill = new Quill('#editor', {
        theme: 'snow',
        placeholder: 'Comece a escrever seu post...',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'align': [] }],
                ['link', 'image'],
                ['clean']
            ]
        }
    });

// Carrega o conteúdo existente do post
const existingContent = @json(old('content', $post->content));
if (existingContent) {
    quill.root.innerHTML = existingContent;
}

// Copia o HTML do Quill para o campo hidden antes de enviar
const form = document.getElementById('post-form');
form.addEventListener('submit', function (e) {
    const content = quill.root.innerHTML;
    if (content.trim() === '<p><br></p>' || content.trim() === '') {
        e.preventDefault();
        alert('Por favor, adicione conteúdo ao post.');
        return false;
    }
    document.getElementById('content').value = content;
});
</script>
@endpush
