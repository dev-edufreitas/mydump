@props(['published' => false])

@if($published)
    <span class="status-badge published">
        Publicado
    </span>
@else
    <span class="status-badge draft">
        Rascunho
    </span>
@endif
