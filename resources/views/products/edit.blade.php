<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Barang.php</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="max-w-lg mx-auto mt-10 bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-semibold mb-6">Edit Produk</h2>
    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="productName" class="block text-gray-700">Nama Produk</label>
            <input type="text" name="name" id="productName" class="w-full p-2 border rounded" value="{{ old('name', $product->name) }}">
        </div>
        <div class="mb-4">
            <label for="productPrice" class="block text-gray-700">Harga Produk</label>
            <input type="number" name="price" id="productPrice" class="w-full p-2 border rounded" value="{{ old('price', $product->price) }}">
        </div>
        <div class="mb-4">
            <label for="productDescription" class="block text-gray-700">Deskripsi Produk</label>
            <textarea name="description" id="productDescription" class="w-full p-2 border rounded">{{ old('description', $product->description) }}</textarea>
        </div>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Perbarui Produk</button>
    </form>
</div>

</body>
</html>