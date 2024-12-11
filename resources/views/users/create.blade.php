<!-- resources/views/users/create.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <div class="max-w-lg mx-auto p-8 bg-white shadow mt-10">
        <h2 class="text-xl font-semibold mb-6">Tambah User</h2>
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium">Nama</label>
                <input type="text" id="name" name="name" class="w-full px-4 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium">Email</label>
                <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium">Password</label>
                <input type="password" id="password" name="password" class="w-full px-4 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-4 py-2 border rounded" required>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
        </form>
    </div>
</body>
</html>
