<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
   public function index(Request $request)
{
    $sort = $request->get('sort', 'created_at_asc');

    $query = Categories::query();

    switch ($sort) {
        case 'created_at_asc':
            $query->orderBy('created_at', 'asc');
            break;
        case 'created_at_desc':
            $query->orderBy('created_at', 'desc');
            break;
        case 'name_asc':
            $query->orderBy('name', 'asc');
            break;
        case 'name_desc':
            $query->orderBy('name', 'desc');
            break;
        default:
            $query->orderBy('created_at', 'desc');
            break;
    }

    $categories = $query->get();

    return view('categories.index', compact('categories', 'sort'));
}


    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Categories::create($request->only('name'));

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(Categories $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Categories $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        $category->update($request->only('name'));

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Categories $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
