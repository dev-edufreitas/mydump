<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'category'])
            ->latest()
            ->paginate(15);

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'          => ['required', 'string', 'max:255'],
            'content'        => ['required', 'string'], // HTML do Tiny
            'excerpt'        => ['nullable', 'string', 'max:500'],
            'category_id'    => ['nullable', 'exists:categories,id'],
            'featured_image' => ['nullable', 'image', 'max:5120'], // até 5MB (ajuste se quiser)
            'is_published'   => ['boolean'],
        ]);

        // normaliza e completa dados
        $validated['user_id']      = auth()->id();
        $validated['slug']         = $this->makeUniqueSlug($validated['title']);
        $validated['is_published'] = (int) $request->boolean('is_published');

        // excerpt: se não veio, derive do content (limpo)
        $validated['excerpt'] = $request->filled('excerpt')
            ? trim($validated['excerpt'])
            : $this->makeExcerpt($validated['content']);

        // published_at
        if ($validated['is_published']) {
            $validated['published_at'] = now();
        }

        // imagem
        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('posts', 'public');
        }

        $post = Post::create($validated);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post criado com sucesso!');
    }

    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title'          => ['required', 'string', 'max:255'],
            'content'        => ['required', 'string'],
            'excerpt'        => ['nullable', 'string', 'max:500'],
            'category_id'    => ['nullable', 'exists:categories,id'],
            'featured_image' => ['nullable', 'image', 'max:5120'],
            'is_published'   => ['boolean'],
        ]);

        // slug só muda se o título mudar (opcional)
        if ($post->title !== $validated['title']) {
            $validated['slug'] = $this->makeUniqueSlug($validated['title'], $post->id);
        }

        // boolean certinho
        $validated['is_published'] = (int) $request->boolean('is_published');

        // excerpt limpo se vier vazio
        $validated['excerpt'] = $request->filled('excerpt')
            ? trim($validated['excerpt'])
            : $this->makeExcerpt($validated['content']);

        // published_at (se marcou e ainda não tinha, seta; se desmarcou, zera)
        if ($validated['is_published'] && !$post->published_at) {
            $validated['published_at'] = now();
        } elseif (!$validated['is_published']) {
            $validated['published_at'] = null; // se preferir manter a data antiga, remova esta linha
        }

        // imagem
        if ($request->hasFile('featured_image')) {
            // deleta a antiga (opcional)
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('posts', 'public');
        }

        $post->update($validated);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post atualizado com sucesso!');
    }

    public function destroy(Post $post)
    {
        // (opcional) remover imagem junto
        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }

        $post->delete();

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post deletado com sucesso!');
    }

    /**
     * Gera um excerpt de texto limpo a partir do HTML.
     */
    private function makeExcerpt(string $html, int $limit = 180): string
    {
        // remove tags e decodifica entidades (&eacute; -> é, &nbsp; -> espaço)
        $text = html_entity_decode(strip_tags($html), ENT_QUOTES | ENT_HTML5, 'UTF-8');

        // normaliza NBSP e espaços duplicados
        $text = str_replace(["\u{00A0}", "\xC2\xA0", '&nbsp;', '&#160;'], ' ', $text);
        $text = preg_replace('/\s+/u', ' ', $text);

        return Str::limit(trim($text), $limit);
    }

    /**
     * Gera slug único (evita colisão).
     */
    private function makeUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $i = 2;

        while (
            Post::where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = "{$base}-{$i}";
            $i++;
        }

        return $slug;
    }
}
