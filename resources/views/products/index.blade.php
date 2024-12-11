<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white flex flex-col">
            <div class="p-4 border-b border-gray-700">
                <h1 class="text-lg font-semibold">Menu</h1>
            </div>
            <nav class="flex-grow p-4">
                <ul class="space-y-2">
                    <li><a href="{{ route('dashboard') }}" class="block p-4 hover:bg-gray-700">Dashboard</a></li>
                    <li><a href="#" class="block p-4 hover:bg-gray-700">eCommerce</a></li>
                    <li><a href="#" class="block p-4 hover:bg-gray-700">Analytics</a></li>
                    <li><a href="{{ route('products.create') }}" class="block p-4 hover:bg-gray-700">Tambah Produk</a></li>
                    <li><a href="{{ route('products.index') }}" class="block p-4 hover:bg-gray-700">Lihat Produk</a></li>
                    <li><a href="{{ route('users.create') }}" class="block p-4 hover:bg-gray-700">Tambah User</a></li>
                    <li><a href="{{ route('users.index') }}" class="block p-4 hover:bg-gray-700">Lihat User</a></li>
                </ul>
            </nav>
            <div class="p-4 border-t border-gray-700">
                <a href="{{ route('logout') }}" class="block p-2 rounded bg-red-500 hover:bg-red-600 text-center">Logout</a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-grow p-6">
            <h2 class="text-2xl font-semibold mb-6">Daftar Produk</h2>

            @if (session('success'))
                <div class="p-4 mb-4 text-green-700 bg-green-100 border border-green-300 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tabel Produk -->
            <table class="w-full border-collapse border border-gray-200 bg-white shadow">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-2 border">#</th>
                        <th class="p-2 border">Nama Produk</th>
                        <th class="p-2 border">Harga</th>
                        <th class="p-2 border">Deskripsi</th>
                        <th class="p-2 border">Dibuat pada</th>
                        <th class="p-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $index => $product)
                        <tr id="product-row-{{ $product->id }}" class="hover:bg-gray-100">
                            <td class="p-2 border">{{ $index + 1 }}</td>
                            <td class="p-2 border">{{ $product->name }}</td>
                            <td class="p-2 border">{{ number_format($product->price, 2) }}</td>
                            <td class="p-2 border">{{ $product->description }}</td>
                            <td class="p-2 border">{{ $product->created_at->format('d M Y, H:i') }}</td>
                            <td class="p-2 border text-center">
                                <!-- Tombol Edit -->
                                <button onclick="openEditModal({{ $product }})" class="text-blue-500 hover:text-blue-700">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <!-- Tombol Hapus -->
                                <button
                                    class="delete-product text-red-500 hover:text-red-700"
                                    data-id="{{ $product->id }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-4 text-center">Belum ada produk yang ditambahkan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </main>
    </div>

    <!-- Modal Edit Produk -->
    <div id="editModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded-lg shadow w-96">
            <h2 class="text-xl font-semibold mb-4">Edit Produk</h2>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="productId">
                <div class="mb-4">
                    <label for="editProductName" class="block text-gray-700">Nama Produk</label>
                    <input type="text" id="editProductName" name="name" class="w-full p-2 border rounded">
                </div>
                <div class="mb-4">
                    <label for="editProductPrice" class="block text-gray-700">Harga Produk</label>
                    <input type="number" id="editProductPrice" name="price" class="w-full p-2 border rounded">
                </div>
                <div class="mb-4">
                    <label for="editProductDescription" class="block text-gray-700">Deskripsi Produk</label>
                    <textarea id="editProductDescription" name="description" class="w-full p-2 border rounded"></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-400 text-white rounded mr-2">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Buka Modal Edit
        function openEditModal(product) {
            document.getElementById('editModal').classList.remove('hidden');
            document.getElementById('editForm').action = `/products/${product.id}`;
            document.getElementById('productId').value = product.id;
            document.getElementById('editProductName').value = product.name;
            document.getElementById('editProductPrice').value = product.price;
            document.getElementById('editProductDescription').value = product.description;
        }

        // Tutup Modal
        function closeModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        // Konfirmasi Hapus Produk
        $(document).ready(function () {
            $('.delete-product').on('click', function (e) {
                e.preventDefault();

                let productId = $(this).data('id');
                let deleteUrl = `/products/${productId}`;

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Produk yang dihapus tidak dapat dikembalikan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                    //Ajax Session Login, Proses Ngirim HTTP dengan Format JSON Response
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: deleteUrl,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function (response) {
                                if (response.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: response.message,
                                        timer: 2000
                                    });

                                    $(`#product-row-${productId}`).fadeOut(500, function () {
                                        $(this).remove();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal',
                                        text: response.message,
                                    });
                                }
                            },
                            error: function () {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Terjadi kesalahan saat menghapus produk.',
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>
