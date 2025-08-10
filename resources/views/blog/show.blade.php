@extends('layouts.app')

@section('title', ' mydump.xyz - '.  $post->title)
@section('description', $post->excerpt)

@section('content')
<div class="w-full bg-white">
  <article class="mx-auto max-w-3xl px-4 sm:px-6 py-10">
    <!-- Voltar ao blog -->
    <div class="mb-6">
      <a href="{{ route('blog.index') }}"
         class="inline-flex items-center gap-2 text-sm text-zinc-700 hover:text-zinc-900 transition">
        <span aria-hidden="true">←</span> Voltar ao mydump.xyz
      </a>
    </div>

    <!-- Título -->
    <h1 class="text-4xl font-bold tracking-tight text-zinc-900 leading-tight mb-3">
      {{ $post->title }}
    </h1>

    <!-- Meta -->
    <div class="flex flex-wrap items-center gap-3 text-sm text-zinc-600 mb-8">
      <time datetime="{{ $post->published_at->toDateString() }}">
        {{ $post->published_at->format('d/m/Y') }}
      </time>

      @if($post->category)
        <span class="text-zinc-400">•</span>
      <a href="{{ route('blog.category', $post->category) }}"
           class="inline-flex items-center rounded-full border border-zinc-900 px-2.5 py-1 text-xs font-medium">
          {{ $post->category->name }}
        </a>
      @endif
    </div>

    <!-- Conteúdo -->
    <div
      class="prose prose-zinc max-w-none
             prose-headings:font-semibold
             prose-a:underline underline-offset-4 hover:prose-a:decoration-2
             prose-img:rounded-xl prose-pre:rounded-xl prose-pre:ring-1 prose-pre:ring-zinc-200">
      {!! Str::markdown($post->content) !!}
    </div>
  </article>
</div>
@endsection
