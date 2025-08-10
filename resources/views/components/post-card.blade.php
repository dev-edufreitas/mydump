@props(['post'])

<li>
    <a href="{{ route('blog.show', $post) }}"
       aria-label="Abrir post: {{ $post->title }}"
       class="group block focus:outline-none focus-visible:ring-2 focus-visible:ring-black focus-visible:ring-offset-2 focus-visible:ring-offset-white">
        <article
            class="post-card relative aspect-square rounded-2xl bg-white border border-black/10
                   shadow-sm ring-1 ring-black/5
                   transition-all duration-200 ease-out will-change-transform
                   hover:-translate-y-0.5 hover:shadow-md hover:border-black">
            <div class="h-full w-full p-5 pb-12 flex flex-col">
                <!-- Título -->
                <h3 class="text-left text-lg md:text-xl lg:text-2xl font-semibold tracking-tight leading-snug
                           text-gray-900 group-hover:text-gray-700 line-clamp-3">
                    {{ $post->title }}
                </h3>

                <!-- Excerpt com efeito simples -->
                <p class="post-excerpt mt-2 text-xs sm:text-sm text-gray-500 line-clamp-4 blur-[1.5px] 
                          transition-all duration-300 ease-out">
                    {{ $post->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($post->content ?? ''), 140) }}
                </p>
            </div>

            <!-- Categoria -->
            <span
                class="absolute bottom-3 right-3 inline-flex items-center rounded-full
                       border border-black/20 bg-white/80 px-2.5 py-1 text-[11px] sm:text-xs
                       font-medium text-gray-700 shadow-sm">
                {{ $post->category->name }}
            </span>
        </article>
    </a>
</li>
