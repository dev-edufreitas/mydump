<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('posts')->paginate(15);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|max:500',
            'color' => 'nullable|regex:/^#[a-fA-F0-9]{6}$/',
        ]);

        $category = new Category($request->all());
        $category->slug = Str::slug($request->name);
        $category->save();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Categoria criada com sucesso!');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|max:500',
            'color' => 'nullable|regex:/^#[a-fA-F0-9]{6}$/',
        ]);

        $category->update($request->all());

        return redirect()->route('admin.categories.index')
            ->with('success', 'Categoria atualizada com sucesso!');
    }

    public function destroy(Category $category)
    {
        if ($category->posts()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Não é possível deletar uma categoria que possui posts.');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Categoria deletada com sucesso!');
    }
}
