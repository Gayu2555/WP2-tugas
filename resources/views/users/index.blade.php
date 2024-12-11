<!-- resources/views/users/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar User</title>
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
                <a href="#" class="block p-2 rounded bg-red-500 hover:bg-red-600 text-center">Logout</a>
            </div>
        </aside>

    <div class="max-w-4xl mx-auto p-8 bg-white shadow mt-10">
        <h2 class="text-2xl font-semibold mb-6">Daftar User</h2>

        @if (session('success'))
            <div class="p-4 mb-4 text-green-700 bg-green-100 border border-green-300 rounded">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full border-collapse border border-gray-200">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 border">#</th>
                    <th class="p-2 border">Nama</th>
                    <th class="p-2 border">Email</th>
                    <th class="p-2 border">Dibuat pada</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $index => $user)
                    <tr class="hover:bg-gray-100">
                        <td class="p-2 border">{{ $index + 1 }}</td>
                        <td class="p-2 border">{{ $user->name }}</td>
                        <td class="p-2 border">{{ $user->email }}</td>
                        <td class="p-2 border">{{ $user->created_at->format('d M Y, H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-4 text-center">Belum ada user yang terdaftar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
