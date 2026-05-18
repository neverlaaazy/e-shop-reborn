<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        
        $categories = Category::with('products')
                        ->where('id','>=',1)
                        ->orderBy('title','DESC')
                        ->get();
        
        return view('products.index', compact('products','categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }
    public function store(Request $request, Product $product)
    {
        $data = $request->validate([
            'title' => 'string|required',
            'price' => 'decimal:0,2|max:100000|min:0|required',
            'description' => 'string|required',
            'category_id' => 'exists:categories,id|required',
            'path_img' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]); //валидация

        if ($request->hasFile('path_img')) {
            $path = $request->file('path_img')->store('products', 'public');
            $data['path_img'] = 'storage/' . $path;
        }

        $product->create($data); //создаем новую запись в БД
        return redirect()->back();
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product','categories'));
    }
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'title' => 'string|required',
            'price' => 'decimal:0,2|max:100000|min:0|required',
            'description' => 'string|required',
            'category_id' => 'exists:categories,id|required',
            'path_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]); //валидация

        if ($request->hasFile('path_img')) {
            if ($product->path_img && !preg_match('/^https?:\/\//', $product->path_img)) {
                Storage::disk('public')->delete(str_replace('storage/', '', $product->path_img));
            }

            $path = $request->file('path_img')->store('products', 'public');
            $data['path_img'] = 'storage/' . $path;
        }

        $product->update($data); //обновляем запись в БД
        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back();
    }

}
