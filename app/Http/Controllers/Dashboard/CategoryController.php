<?php

namespace App\Http\Controllers\Dashboard;

use App\Modeles\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\Categories\CreateRequest;
use App\Http\Requests\Dashboard\Categories\UpdateRequest;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:read_categories')->only('index');
        $this->middleware('permission:create_categories')->only('create');
        $this->middleware('permission:update_categories')->only('edit');
        $this->middleware('permission:delete_categories')->only('destroy');
    }

    public function index(Request $request)
    {
        $categories = Category::search($request)->latest()->paginate(10);

        return view('dashboard.categories.index', compact('categories'));
    }

    public function create()
    {
        $category = new category();
        return view('dashboard.categories.create', compact('category'));
    }

    public function store(CreateRequest $request)
    {
        Category::create($request->all());
        return redirect()->route('dashboard.categories.index')->with('message', __('dashboard.dded_successfullu'));
    }

    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));
    }

    public function update(UpdateRequest $request, Category $category)
    {

        $category->update($request->all());
        return redirect()->route('dashboard.categories.index')->with('message', __('dashboard.updated_successfullu'));
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('message', __('dashboard.deleted_successfullu'));
    }
}
