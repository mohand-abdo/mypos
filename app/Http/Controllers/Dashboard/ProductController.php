<?php

namespace App\Http\Controllers\Dashboard;


use App\Modeles\Product;
use App\Modeles\Category;
use App\Traits\UploadImages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Dashboard\Products\CreateRequest;
use App\Http\Requests\Dashboard\Products\UpdateRequest;

class ProductController extends Controller
{
    use UploadImages;

    public function __construct()
    {
        $this->middleware('permission:read_products')->only('index');
        $this->middleware('permission:create_products')->only('create');
        $this->middleware('permission:update_products')->only('edit');
        $this->middleware('permission:delete_products')->only('destroy');
    }

    public function index(Request $request)
    {
        $categories = Category::all();
        $products = Product::search($request)->latest()->paginate(10);

        return view('dashboard.products.index', compact('categories', 'products'));
    }

    public function create()
    {
        $categories = Category::all();
        $product    = new Product();
        return view('dashboard.products.create', compact('categories', 'product'));
    }

    public function store(CreateRequest $request)
    {
        $data = $request->except(['image']);
        if ($request->image != '') {
            $data['image'] = $this->uploadImage($request->image, 'product_images');
        }
        Product::create($data);
        return redirect()->route('dashboard.products.index')->with('message', __('dashboard.added_successfullu'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('dashboard.products.edit', compact('product', 'categories'));
    }

    public function update(UpdateRequest $request, Product $product)
    {
        $data = $request->except(['image']);
        if ($request->image != '') {
            if ($product->image != 'default.png') {
                Storage::disk('public_upload')->delete('/product_images/' . $product->image);
            }
            $data['image'] = $this->uploadImage($request->image, 'product_images');
        }
        $product->update($data);
        return redirect()->route('dashboard.products.index')->with('message', __('dashboard.updated_successfullu'));
    }

    public function destroy(Product $product)
    {
        if ($product->image != 'default.png') {
            Storage::disc('public_upload')->delete('/product_images/' . $product->image);
        }
        $product->delete();
        return redirect()->back()->with('message', __('dashboard.deleted_successfullu'));
    }
}
