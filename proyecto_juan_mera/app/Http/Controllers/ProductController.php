<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::with('category')->where('stock', '>', 0)->get();
        $categories = Category::all();

        return view('products.indexvue', compact('products', 'categories'));
    }

    public function store(ProductRequest $request)
    {
        $imageName = null;
        if ($request->hasFile('file')) {
            $imageName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('images'), $imageName);
        }

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'image' => $imageName
        ]);

        return response()->json(['message', 'created']);
    }

    public function show(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if (!$request->ajax()) return view('products.show', compact('product'));
        return response()->json(['product' => $product]);
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    public function update(ProductUpdateRequest $request, $id)
    {

        $product = Product::findOrFail($id);

        $imageName = $product->image;
        if ($request->hasFile('file')) {
            $imageName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('images'), $imageName);
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'image' => $imageName
        ]);

        return redirect()->route('products.index')->with('success', 'El producto se actualizo correctamente.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image && file_exists(public_path('images/' . $product->image))) {
            unlink(public_path('images/' . $product->image));
        }

        $product->delete();

        return response()->json(['message', 'deleted']);
    }
}
