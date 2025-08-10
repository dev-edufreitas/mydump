@extends('layouts.app')

@section('title', 'mydump.xyz - Página Inicial')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    @forelse($groupedPosts as $group)
        @php
            $anchorId = strtolower($group['anchor'] ?? ($group['month'].'-'.$group['year']));
        @endphp

        <section id="{{ $anchorId }}" class="mb-10 scroll-mt-24">
            <div class="flex items-center justify-between mb-5">
                <h2 class="text-base sm:text-lg font-semibold text-gray-900">
                    {{ $group['year'] }} · {{ $group['month'] }}
                </h2>
                <a href="#{{ $anchorId }}"
                   class="text-gray-400 hover:text-gray-600 text-sm"
                   aria-label="Link desta seção">#</a>
            </div>

            <!-- Grid de cards quadrados -->
            <ul class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4">
                @foreach($group['posts'] as $post)
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
                                    <!-- Título topo/esquerda -->
                                    <h3 class="text-left text-lg md:text-xl lg:text-2xl font-semibold tracking-tight leading-snug
                                               text-gray-900 group-hover:text-gray-700 line-clamp-3">
                                        {{ $post->title }}
                                    </h3>

                                    <!-- Excerpt cinza e borrado -->
                                    <p class="mt-2 text-xs sm:text-sm text-gray-500 line-clamp-4 blur-[1.5px]">
                                        {{ $post->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($post->content ?? ''), 140) }}
                                    </p>
                                </div>

                                <!-- Categoria no canto inferior direito -->
                                <span
                                    class="absolute bottom-3 right-3 inline-flex items-center rounded-full
                                           border border-black/20 bg-white/80 px-2.5 py-1 text-[11px] sm:text-xs
                                           font-medium text-gray-700 shadow-sm ">
                                    {{ $post->category->name }}
                                </span>
                            </article>
                        </a>
                    </li>
                @endforeach
            </ul>
        </section>
    @empty
        <div class="text-center py-20">
            <h2 class="text-xl font-medium text-gray-600">Nenhum post encontrado</h2>
        </div>
    @endforelse
</div>
@endsection
