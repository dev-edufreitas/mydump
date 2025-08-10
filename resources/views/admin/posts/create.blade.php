@extends('layouts.admin')

@section('title', 'Novo Post')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-semibold text-gray-900">Criar Novo Post</h1>
    <p class="mt-1 text-sm text-gray-600">Adicione um novo post ao seu blog</p>
</div>

<form id="postForm" action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
    @csrf
    
    <!-- Informações Básicas -->
    <div class="admin-card admin-card-body">
        <h2 class="text-lg font-medium text-gray-900 mb-6">Informações Básicas</h2>
        
        <div class="space-y-6">
            <x-form-field 
                label="Título" 
                name="title" 
                :required="true"
                placeholder="Digite o título do post" 
                :value="old('title')" />

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="form-group">
                    <label for="category_id" class="form-label">Categoria</label>
                    <select name="category_id" id="category_id" class="form-input">
                        <option value="">Selecione uma categoria</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <x-form-field 
                    label="Imagem Destacada" 
                    name="featured_image" 
                    type="file"
                    accept="image/*" />
            </div>

            <x-form-field 
                label="Resumo" 
                name="excerpt" 
                type="textarea"
                :rows="3"
                placeholder="Resumo opcional do post (será gerado automaticamente se deixado em branco)"
                :value="old('excerpt')" />
        </div>
    </div>

    <!-- Conteúdo -->
    <div class="admin-card admin-card-body">
        <h2 class="text-lg font-medium text-gray-900 mb-4">Conteúdo</h2>

        <x-form-field 
            label="Conteúdo do Post" 
            name="content" 
            type="textarea"
            :required="true"
            id="content"
            :value="old('content')" />
    </div>

    <!-- Publicação -->
    <div class="admin-card admin-card-body">
        <h2 class="text-lg font-medium text-gray-900 mb-6">Publicação</h2>
        <input type="hidden" name="is_published" value="0">
        
        <div class="flex items-center">
            <input
                id="is_published"
                name="is_published"
                type="checkbox"
                value="1"
                {{ old('is_published') ? 'checked' : '' }}
                class="h-4 w-4 text-gray-900 focus:ring-gray-900 border-gray-300 rounded"
            >
            <label for="is_published" class="ml-3 block text-sm text-gray-900">
                Publicar imediatamente
            </label>
        </div>
        <p class="mt-2 text-xs text-gray-500">Se desmarcado, o post será salvo como rascunho</p>
        @error('is_published')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Ações -->
    <div class="flex justify-end gap-3">
        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">
            Cancelar
        </a>
        <button type="submit" class="btn btn-primary">
            Criar Post
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
    p + p{text-indent:2em}
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
