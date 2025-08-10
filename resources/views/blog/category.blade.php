@extends('layouts.app')

@section('title', 'Categoria: ' . $category->name)
@section('description', $category->description ?: 'Posts da categoria ' . $category->name)

@section('content')
<div class="mb-8">
    <!-- Voltar ao blog -->
    <div class="mb-6">
              <a href="{{ route('blog.index') }}"
         class="inline-flex items-center gap-2 text-sm text-zinc-700 hover:text-zinc-900 transition">
        <span aria-hidden="true">←</span> Voltar ao mydump.xyz
      </a>
    </div>

    <!-- Título da categoria -->
    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $category->name }}</h1>

    @if($category->description)
        <p class="text-gray-600 mb-2">{{ $category->description }}</p>
    @endif

    <p class="text-gray-500 text-sm">{{ $posts->total() }} post(s) nesta categoria</p>
</div>

<!-- Grid de cards (mesmo estilo da home) -->
<ul class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4">
    @forelse($posts as $post)
        <li>
            <a href="{{ route('blog.show', $post) }}"
               aria-label="Abrir post: {{ $post->title }}"
               class="group block focus:outline-none focus-visible:ring-2 focus-visible:ring-black focus-visible:ring-offset-2 focus-visible:ring-offset-white">
                <article
                    class="relative aspect-square rounded-2xl bg-white border border-black/10
                           shadow-sm ring-1 ring-black/5
                           transition-all duration-200 ease-out will-change-transform
                           hover:-translate-y-0.5 hover:shadow-md hover:border-black">
                    <div class="h-full w-full p-5 pb-12 flex flex-col">
                        <!-- Título -->
                        <h3 class="text-left text-lg md:text-xl lg:text-2xl font-semibold tracking-tight leading-snug
                                   text-gray-900 group-hover:text-gray-700 line-clamp-3">
                            {{ $post->title }}
                        </h3>

                        <!-- Excerpt cinza e borrado -->
                        <p class="mt-2 text-xs sm:text-sm text-gray-500 line-clamp-2 blur-[2px] group-hover:blur-0 transition">
                            {{ $post->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($post->content ?? ''), 140) }}
                        </p>
                    </div>

                    <!-- Categoria no canto inferior direito -->
                    <span
                        class="absolute bottom-3 right-3 inline-flex items-center rounded-full
                               border border-black/20 bg-white/80 px-2.5 py-1 text-[11px] sm:text-xs
                               font-medium text-gray-700 shadow-sm">
                        {{ $post->category->name }}
                    </span>
                </article>
            </a>
        </li>
    @empty
        <li class="col-span-full text-center py-12">
            <p class="text-gray-600">Nenhum post encontrado nesta categoria</p>
        </li>
    @endforelse
</ul>

<!-- Paginação -->
@if($posts->hasPages())
    <div class="mt-8">
        {{ $posts->links() }}
    </div>
@endif
@endsection
