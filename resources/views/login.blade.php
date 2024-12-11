<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Section</title>
     @vite('resources/css/app.css')
</head>
<body>
    <body class="flex items-center justify-center h-screen bg-gray-100">
        <div class="w-full max-w-sm bg-white p-6 rounded-lgshadow">
             <div class="w-full bg-blue-600 text-white p-2 rounded-t-lg mb-4">
            <marquee behavior="scroll" direction="left" class="text-sm">
                Update Patch 2.5.11 More Secure Credentials and More Easire to Using!!
            </marquee>
        </div>
            <h2 class="text-2xl font-bold mb-4">login</h2>
            @if ($errors->has('login'))
            <p class="text-red-500">{{$errors->first('login')}}</p>
            @endif
            <form action="{{ route('process.login')}}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="username" class="block text-gray-700">Username</label>
                    <input type="text" name="username" id="username" class="w-full p-2 border rounded">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Password</label>
                    <input type="password" name="password" id="password" class="w-full p-2 border rounded">
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded">Login</button>
            </form>
        </div>
</body>
</html>