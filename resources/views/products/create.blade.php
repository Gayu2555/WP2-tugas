<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk Baru</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white flex flex-col">
            <div class="p-4 text-center text-2xl font-bold border-b border-gray-700">
                Dashboard
            </div>
            <nav class="flex-grow">
                <a href="{{ route('products.index') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('products.index') ? 'bg-blue-600' : '' }}">
                    Daftar Produk
                </a>
                <a href="{{ route('products.create') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('products.create') ? 'bg-blue-600' : '' }}">
                    Tambah Produk
                </a>
                <!-- Tambahkan menu lainnya di sini -->
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-grow p-6">
            <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow">
                <h2 class="text-2xl font-semibold mb-6">Tambah Produk Baru</h2>
                <noscript>
                    <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                        Anda harus berada dalam SuperAdmin untuk melakukan ini.
                    </div>
                </noscript>
                
                <!-- Pesan sukses -->
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Validasi Error -->
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Kolom Formulir Dashboard -->
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="productName" class="block text-gray-700 font-medium">Nama Produk</label>
                        <input type="text" name="name" id="productName" class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-600" value="{{ old('name') }}" required>
                    </div>
                    <div class="mb-4">
                        <label for="productPrice" class="block text-gray-700 font-medium">Harga Produk</label>
                        <input type="number" name="price" id="productPrice" class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-600" value="{{ old('price') }}" required>
                    </div>
                    <div class="mb-4">
                        <label for="productDescription" class="block text-gray-700 font-medium">Deskripsi Produk</label>
                        <textarea name="description" id="productDescription" class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-600" required>{{ old('description') }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label for="category" class="block text-gray-700 font-medium">Kategori Produk</label>
                        <select name="category_id" id="category" class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-600" required>
                            <option value="" disabled selected>Pilih kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="productImage" class="block text-gray-700 font-medium">Foto Produk</label>
                        <input type="file" name="image" id="productImage" class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-600" accept="image/*">
                    </div>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 focus:ring-4 focus:ring-blue-400">
                        Simpan Produk
                    </button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
