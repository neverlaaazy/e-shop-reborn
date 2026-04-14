<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all(); //выбираем все строки из таблицы products
        
        $categories = Category::where('id','>=',1)
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
            'category_id' => 'exists:categories,id|required'
        ]); //валидация
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
            'category_id' => 'exists:categories,id|required'
        ]); //валидация
        $product->update($data); //создаем новую запись в БД
        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back();
    }

}
