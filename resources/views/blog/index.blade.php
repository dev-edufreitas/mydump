@extends('layouts.app')

@section('title', 'mydump.xyz - Página Inicial')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    @forelse($groupedPosts as $group)
        @php
            $anchorId = strtolower($group['anchor'] ?? ($group['month'].'-'.$group['year']));
        @endphp

        <section id="{{ $anchorId }}" class="month-section scroll-mt-24">
            <div class="flex items-center justify-between mb-5">
                <h2 class="month-title">
                    {{ $group['year'] }} · {{ $group['month'] }}
                </h2>
                <a href="#{{ $anchorId }}"
                   class="text-gray-400 hover:text-gray-600 text-sm"
                   aria-label="Link desta seção">#</a>
            </div>

            <!-- Grid de cards -->
            <ul class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4">
                @foreach($group['posts'] as $post)
                    <x-post-card :post="$post" />
                @endforeach
            </ul>
        </section>
    @empty
        <div class="empty-state">
            <h2 class="empty-state-title">Nenhum post encontrado</h2>
        </div>
    @endforelse
</div>
@endsection
