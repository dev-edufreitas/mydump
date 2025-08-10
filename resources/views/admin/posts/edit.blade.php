@extends('layouts.admin')

@section('title', 'Editar Post')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-semibold text-gray-900">Editar Post</h1>
    <p class="mt-1 text-sm text-gray-600">{{ $post->title }}</p>
</div>

<form id="postForm" action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
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
                <input
                    type="text"
                    name="title"
                    id="title"
                    required
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-transparent text-sm"
                    placeholder="Digite o título do post"
                    value="{{ old('title', $post->title) }}"
                >
                @error('title')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-900 mb-2">Categoria</label>
                    <select
                        name="category_id"
                        id="category_id"
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-transparent text-sm"
                    >
                        <option value="">Selecione uma categoria</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
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
                            <img
                                src="{{ Storage::url($post->featured_image) }}"
                                alt="Imagem atual"
                                class="h-20 w-auto rounded-lg border border-gray-200"
                            >
                            <p class="text-xs text-gray-500 mt-1">Imagem atual</p>
                        </div>
                    @endif
                    <input
                        type="file"
                        name="featured_image"
                        id="featured_image"
                        accept="image/*"
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-transparent text-sm file:mr-3 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-sm file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100"
                    >
                    <p class="text-xs text-gray-500 mt-1">Deixe em branco para manter a imagem atual</p>
                    @error('featured_image')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="excerpt" class="block text-sm font-medium text-gray-900 mb-2">Resumo</label>
                <textarea
                    name="excerpt"
                    id="excerpt"
                    rows="3"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-transparent text-sm"
                    placeholder="Resumo opcional do post (será gerado automaticamente se deixado em branco)"
                >{{ old('excerpt', $post->excerpt) }}</textarea>
                @error('excerpt')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <!-- Conteúdo (TinyMCE) -->
    <div class="bg-white rounded-lg border border-gray-100 p-6">
        <h2 class="text-lg font-medium text-gray-900 mb-4">Conteúdo</h2>

        <label for="content" class="block text-sm font-medium text-gray-900 mb-2">
            Conteúdo do Post <span class="text-red-500">*</span>
        </label>

        <textarea id="content" name="content">{!! old('content', $post->content) !!}</textarea>

        @error('content')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Configurações de Publicação -->
    <div class="bg-white rounded-lg border border-gray-100 p-6">
        <h2 class="text-lg font-medium text-gray-900 mb-6">Publicação</h2>

        {{-- garante 0 quando desmarcado --}}
        <input type="hidden" name="is_published" value="0">

        <div class="flex items-center">
            <input
                id="is_published"
                name="is_published"
                type="checkbox"
                value="1"
                @checked(old('is_published', $post->is_published) == 1)
                class="h-4 w-4 text-gray-900 focus:ring-gray-900 border-gray-300 rounded"
            >
            <label for="is_published" class="ml-3 block text-sm text-gray-900">
                Publicado
            </label>
        </div>

        @if($post->published_at)
            <p class="text-xs text-gray-500">Publicado em: {{ $post->published_at->format('d/m/Y H:i') }}</p>
        @else
            <p class="text-xs text-gray-500">Post não publicado (rascunho)</p>
        @endif

        @error('is_published')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Ações -->
    <div class="flex justify-end gap-3">
        <a href="{{ route('admin.posts.index') }}" class="px-4 py-2 border border-gray-200 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
            Cancelar
        </a>
        <button type="submit" class="px-4 py-2 bg-gray-900 text-white rounded-lg text-sm font-medium hover:bg-gray-800 transition-colors">
            Atualizar Post
        </button>
    </div>
</form>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.3/tinymce.min.js" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
tinymce.init({
  selector: 'textarea#content',
  menubar: 'file edit view insert format tools table',
  plugins: 'lists link table code autoresize',
  toolbar: 'undo redo | blocks | bold italic underline | align | bullist numlist outdent indent | link table | removeformat | code',
  height: 420,
  branding: false,
  statusbar: true,
  forced_root_block: 'p',
  content_style: `
    body{font-family:system-ui,-apple-system,Segoe UI,Roboto,sans-serif;font-size:14px;line-height:1.7}
    p{margin:0 0 1em}
    p + p
    table{border-collapse:collapse;width:100%}
    th,td{border:1px solid #e5e7eb;padding:.5rem}
  `,
  setup(editor){
    const form = document.getElementById('postForm');
    if(form){
      form.addEventListener('submit', function(e){
        const plain = editor.getContent({ format: 'text' }).trim();
        if(!plain){
          e.preventDefault();
          alert('Por favor, adicione conteúdo ao post.');
          editor.focus();
          return;
        }
        tinymce.triggerSave();
      });
    }
  }
});
</script>
@endpush
