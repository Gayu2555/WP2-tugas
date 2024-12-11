<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all(); // Mengambil semua produk dari database
        return view('products.index', compact('products'));
    }
    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        // Validasi dan proses data produk
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product-images', 'public'); // <-- Menyimpan data foto yang akan terupload ke path storage/public/product-images
        }

        //Menyimpan data ke Database
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        //Mengembalikan Status dengan pesan Sukses\


        // Kembali ke halaman produk atau arahkan ke tempat lain
        return redirect()->route('products.create')->with('success', 'Product created successfully!');
    }

    //Function Callback Mengembalikan Response dengan Format JSON ke Server (Supaya dapat dibaca oleh AJAX)
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
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }
}
