<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::noAdmin()->orderBy('created_at', 'desc')->paginate(10);
        return view('categories.index')->with('categories', $categories);
    }

    public function edit(Category $category)
    {
        return view('categories.edit')->with('category', $category);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|unique:categories,title'
        ]);

        $category = new Category();
        $category->title = $request->get('title');
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category saved');
    }

    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'title' => 'required|string|unique:categories,title'
        ]);

        $category->title = $request->get('title');
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category updated');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted');
    }
}
