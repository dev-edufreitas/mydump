<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::published()
            ->with(['user', 'category'])
            ->recent()
            ->get();

        // Nomes dos meses em português
        $monthNames = [
            1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março', 4 => 'Abril',
            5 => 'Maio', 6 => 'Junho', 7 => 'Julho', 8 => 'Agosto',
            9 => 'Setembro', 10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro'
        ];

        // Agrupar posts por ano e mês
        $groupedPosts = $posts->groupBy(function($post) {
            return $post->published_at->format('Y-n'); // Ex: 2025-6 para Junho 2025
        })->map(function($monthPosts, $key) use ($monthNames) {
            $date = \Carbon\Carbon::createFromFormat('Y-n', $key);
            return [
                'year' => $date->year,
                'month' => $monthNames[$date->month],
                'month_num' => $date->month,
                'posts' => $monthPosts,
                'anchor' => $date->format('Y') . '-' . strtolower($monthNames[$date->month])
            ];
        });

        // Criar sidebar com navegação por datas
        $sidebarDates = $groupedPosts->map(function($group) {
            return [
                'label' => $group['year'] . ' - ' . $group['month'],
                'anchor' => strtolower($group['anchor']),
                'year' => $group['year'],
                'month' => $group['month']
            ];
        });

        return view('blog.index', compact('groupedPosts', 'sidebarDates'));
    }

    public function show(Post $post)
    {
        // Verificar se o post está publicado
        if (!$post->is_published || $post->published_at > now()) {
            abort(404);
        }

        $post->load(['user', 'category', 'comments' => function($query) {
            $query->approved()->latest();
        }]);

        $relatedPosts = Post::published()
            ->where('id', '!=', $post->id)
            ->where('category_id', $post->category_id)
            ->limit(3)
            ->get();

        return view('blog.show', compact('post', 'relatedPosts'));
    }

    public function category(Category $category)
    {
        $posts = $category->posts()
            ->published()
            ->with(['user', 'category'])
            ->recent()
            ->paginate(10);

        return view('blog.category', compact('category', 'posts'));
    }

    public function storeComment(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|min:10|max:1000',
            'author_name' => 'required_without:user_id|max:100',
            'author_email' => 'required_without:user_id|email|max:100',
        ]);

        $comment = new Comment($request->only(['content', 'author_name', 'author_email']));
        $comment->post_id = $post->id;
        
        if (auth()->check()) {
            $comment->user_id = auth()->id();
            $comment->author_name = auth()->user()->name;
            $comment->author_email = auth()->user()->email;
        }

        $comment->save();

        return redirect()->back()->with('success', 'Comentário enviado! Será revisado antes da publicação.');
    }
}
