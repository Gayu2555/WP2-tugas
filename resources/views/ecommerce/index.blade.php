@extends('layouts.app')

@section('content')
<div class="bg-cover bg-center" style="background-image: url('{{ asset('images/banner-1.jpg') }}');">
    <div class="container mx-auto px-4 py-32"> <!-- Ubah py-12 menjadi py-16 -->
       <div class="flex flex-col lg:flex-row items-center justify-between">
        <div class="lg:w-1/2 text-center lg:text-left">
            <h1 class="text-4xl font-bold text-green-600">Organic Foods at your <span class="text-black">Doorsteps</span></h1>
            <p class="mt-4 text-gray-600">Dignissim massa diam elementum.</p>
            <div class="mt-6 flex flex-col lg:flex-row gap-4">
                <a href="#" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-500">Start Shopping</a>
                <!-- Tampilkan tombol Join Now hanya jika user belum login -->
               <!-- Tombol Join Now, hanya muncul jika user belum login -->
                @if(!Auth::check())
                    <button id="joinNowBtn" class="px-6 py-3 bg-black text-white rounded-lg hover:bg-gray-800">Join Now</button>
                @endif
                <!-- Tombol Logout -->
                @if(Auth::check())
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-500">
                            Logout
                        </button>
                    </form>
                @endif
            </div>
              <div class="mt-12 flex justify-around text-center">
                    <div>
                        <h2 class="text-xl font-bold">14k+</h2>
                        <p class="text-gray-800">Product Varieties</p>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold">50k+</h2>
                        <p class="text-gray-800">Happy Customers</p>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold">10+</h2>
                        <p class="text-gray-800">Store Locations</p>
                    </div>
                </div>
        </div>
    </div>
   <div id="loginModal" class="hidden fixed z-10 inset-0 bg-black bg-opacity-50 flex justify-center items-center">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full relative">
        <button id="closeButton" class="absolute top-4 right-4 text-gray-500 hover:text-gray-800 text-3xl">&times;</button>

        <div class="flex flex-col items-center mb-6">
            <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="w-32 h-32 mb-4">
            <h2 class="text-2xl font-bold text-gray-800">Login</h2>
        </div>

        <!-- Menampilkan pesan error jika ada -->
        @if ($errors->any())
            <div class="mb-4 text-red-600 text-sm">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" required value="{{ old('email') }}">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" required>
            </div>
            <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-500">Login</button>
        </form>
        
        <!-- Tombol Cancel -->
        <button id="closeModal" class="mt-4 w-full text-center text-gray-500 hover:underline">Cancel</button>
        
        <!-- Daftar Sekarang -->
        <div class="mt-2 text-center">
            <p class="text-sm text-gray-600">
                Tidak punya akun? 
                <a href="{{ route('ecommerce.register.view') }}" class="text-green-600 hover:underline">Daftar Sekarang</a>
            </p>
        </div>
    </div>
</div>

<script>
     document.addEventListener('DOMContentLoaded', () => {
        const joinNowBtn = document.getElementById('joinNowBtn');
        const loginModal = document.getElementById('loginModal');
        const closeModal = document.getElementById('closeModal');
        const closeButton = document.getElementById('closeButton');

        // Menampilkan modal login hanya jika pengguna belum login
        if (!{{ Auth::check() ? 'true' : 'false' }}) {
            joinNowBtn?.addEventListener('click', () => {
                loginModal.classList.remove('hidden');
            });
        }

        closeModal?.addEventListener('click', () => {
            loginModal.classList.add('hidden');
        });

        closeButton?.addEventListener('click', () => {
            loginModal.classList.add('hidden');
        });

        loginModal?.addEventListener('click', (event) => {
            if (event.target === loginModal) {
                loginModal.classList.add('hidden');
            }
        });
    });
</script>

   </div>
   </div>
</div>
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<div class="bg-gray-100 py-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-green-100 p-6 rounded-lg">
                <h3 class="text-lg font-bold text-green-600">Fresh from farm</h3>
                <p class="text-gray-600 mt-2">Lorem ipsum dolor sit amet, consectetur adipis elit.</p>
            </div>
            <div class="bg-green-600 text-white p-6 rounded-lg">
                <h3 class="text-lg font-bold">100% Organic</h3>
                <p class="mt-2">Lorem ipsum dolor sit amet, consectetur adipis elit.</p>
            </div>
            <div class="bg-orange-100 p-6 rounded-lg">
                <h3 class="text-lg font-bold text-orange-600">Free delivery</h3>
                <p class="text-gray-600 mt-2">Lorem ipsum dolor sit amet, consectetur adipis elit.</p>
            </div>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Category</h2>
        <button class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-500">View All</button>
    </div>
    <!-- Swiper container -->
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <!-- Item 1 -->
            <div class="swiper-slide text-center">
                <img class="rounded-full mx-auto w-26 h-26" src="images/category-thumb-1.jpg" alt="Fruits">
                <p class="mt-2 text-gray-700 font-medium">Fruits & Veges</p>
            </div>
            <!-- Item 2 -->
            <div class="swiper-slide text-center">
                <img class="rounded-full mx-auto w-26 h-26" src="images/category-thumb-2.jpg" alt="Breads">
                <p class="mt-2 text-gray-700 font-medium">Breads & Sweets</p>
            </div>
            <!-- Add more items as needed -->
            <div class="swiper-slide text-center">
                <img class="rounded-full mx-auto w-26 h-26" src="images/category-thumb-3.jpg" alt="Breads">
                <p class="mt-2 text-gray-700 font-medium">Wine</p>
            </div>
            <div class="swiper-slide text-center">
                <img class="rounded-full mx-auto w-26 h-26" src="images/category-thumb-4.jpg" alt="Breads">
                <p class="mt-2 text-gray-700 font-medium">Beverages</p>
            </div>
            <div class="swiper-slide text-center">
                <img class="rounded-full mx-auto w-26 h-26" src="images/category-thumb-5.jpg" alt="Breads">
                <p class="mt-2 text-gray-700 font-medium">Meat Products</p>
            </div>
            <div class="swiper-slide text-center">
                <img class="rounded-full mx-auto w-26 h-26" src="images/category-thumb-6.jpg" alt="Breads">
                <p class="mt-2 text-gray-700 font-medium">Herbs Products</p>
            </div>
            <div class="swiper-slide text-center">
                <img class="rounded-full mx-auto w-26 h-26" src="images/category-thumb-8.jpg" alt="Breads">
                <p class="mt-2 text-gray-700 font-medium">Instant Foods</p>
            </div>
        </div>
        <!-- Navigation buttons -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>
<style>
    .swiper-slide img {
        border: 2px solid #e5e7eb; /* Border gray */
    }
    .swiper-slide:hover img {
        border-color: #d1fae5; /* Border green on hover */
    }
</style>

<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 4,
        spaceBetween: 20,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            640: { slidesPerView: 2, spaceBetween: 10 },
            1024: { slidesPerView: 4, spaceBetween: 20 },
        },
    });
</script>
@endsection
