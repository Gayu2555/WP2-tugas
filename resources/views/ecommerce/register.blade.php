<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Sesuaikan jika menggunakan Vite -->
</head>
<body>
    <div class="container mx-auto mt-10">
        <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
            <!-- Flash Messages -->
            @if (session('success'))
                <div class="mb-4 p-4 text-green-700 bg-green-100 border border-green-400 rounded">
                    {{ session('success') }}
                </div>
            @elseif (session('error'))
                <div class="mb-4 p-4 text-red-700 bg-red-100 border border-red-400 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Register Form -->
            <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">Register</h2>
            <form method="POST" action="{{ route('ecommerce.register') }}">
                @csrf
                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="name" name="name" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" required>
                </div>
                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" required>
                </div>
                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" required>
                </div>
                <!-- Alamat -->
                <div class="mb-4">
                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <textarea id="alamat" name="alamat" rows="3" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" required></textarea>
                </div>
                <!-- Provinsi -->
                <div class="mb-4">
                    <label for="provinsi" class="block text-sm font-medium text-gray-700">Provinsi</label>
                    <input type="text" id="provinsi" name="provinsi" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" required>
                </div>
                <!-- Kabupaten -->
                <div class="mb-4">
                    <label for="kabupaten" class="block text-sm font-medium text-gray-700">Kabupaten/Kota</label>
                    <input type="text" id="kabupaten" name="kabupaten" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" required>
                </div>
                <!-- Kecamatan -->
                <div class="mb-4">
                    <label for="kecamatan" class="block text-sm font-medium text-gray-700">Kecamatan</label>
                    <input type="text" id="kecamatan" name="kecamatan" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" required>
                </div>
                <!-- Desa -->
                <div class="mb-6">
                    <label for="desa" class="block text-sm font-medium text-gray-700">Desa</label>
                    <input type="text" id="desa" name="desa" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" required>
                </div>
                <!-- Submit -->
                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-500">
                    Register
                </button>
            </form>
        </div>
    </div>
</body>
</html>
