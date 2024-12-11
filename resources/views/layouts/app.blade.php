<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organic Store</title>
    @vite('resources/css/app.css')
</head>
<body>
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center">
                <img src="{{ asset('images/logo.svg') }}" alt="Organic Logo" class="h-10">
            </div>
            
            <!-- Search Bar -->
            <div class="search-bar flex items-center bg-gray-100 rounded-full px-4 shadow-md w-full max-w-lg mx-8">
                <select class="bg-transparent border-none text-gray-600 text-sm outline-none">
                    <option>All Categories</option>
                    <option>Fruits</option>
                    <option>Vegetables</option>
                    <option>Dairy</option>
                </select>
                <input 
                    type="text" 
                    placeholder="Search for more than 20,000 products..." 
                    class="flex-grow p-2 text-gray-700 bg-transparent outline-none"
                />
                <button class="text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 10l6 6m-6-6a8 8 0 110 16 8 8 0 010-16z" />
                    </svg>
                </button>
            </div>

            <!-- Navigation Links & Icons -->
            <nav class="flex items-center space-x-6">
                <!-- Links -->
                <ul class="flex items-center space-x-6">
                    <li><a href="#" class="text-gray-600 hover:text-green-600">Home</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-green-600">Pages</a></li>
                </ul>
                <!-- Icons -->
                <div class="flex items-center space-x-4">
                    <!-- User Profile Icon -->
                    <a href="#" class="text-gray-600 hover:text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A11.934 11.934 0 0112 16c2.615 0 5.033.835 6.879 1.804m-6.879-5.308a4 4 0 100-8 4 4 0 000 8z" />
                        </svg>
                    </a>
                    <!-- Bookmark Icon -->
                    <a href="#" class="text-gray-600 hover:text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 6a2 2 0 012-2h10a2 2 0 012 2v16l-7-5-7 5V6z" />
                        </svg>
                    </a>
                    <!-- Cart Icon -->
                    <a href="#" class="text-gray-600 hover:text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l1.4-7H6.6M16 16a2 2 0 11-4 0m6 0a2 2 0 11-4 0m-6 0a2 2 0 100 4m0-4a2 2 0 100 4m-6 0a2 2 0 100 4m0-4a2 2 0 100 4" />
                        </svg>
                    </a>
                </div>
            </nav>
        </div>
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>
