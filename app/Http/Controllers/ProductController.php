<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category; // Tambahkan model Category
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get(); // Eager loading relasi category
        $categories = Category::all();

        return view('products.index', [
            'products' => $products,
            'categories' => $categories
        ]);
    }


    public function create()
    {
        // Kirim data kategori untuk ditampilkan di form
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validasi input termasuk kategori
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id', // Validasi kategori
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product-images', 'public');
        }

        // Simpan data ke database termasuk kategori
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imagePath,
            'category_id' => $request->category_id, // Simpan kategori
        ]);

        return redirect()->route('products.create')->with('success', 'Produk berhasil dibuat!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        try {
            $product->delete();

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus produk.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit(Product $product)
    {
        // Kirim data kategori untuk diedit bersama produk
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id', // Validasi kategori
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product-images', 'public');
            $data['image'] = $imagePath;
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }
}
