@extends('layouts.app')

@section('content')
<div class="bg-cover bg-center" style="background-image: url('{{ asset('images/banner-1.jpg') }}');">
    <div class="container mx-auto px-4 py-12">
        <div class="flex flex-col lg:flex-row items-center justify-between">
            <div class="lg:w-1/2 text-center lg:text-left">
                <h1 class="text-4xl font-bold text-green-600">Organic Foods at your <span class="text-black">Doorsteps</span></h1>
                <p class="mt-4 text-gray-600">Dignissim massa diam elementum.</p>
                <div class="mt-6 flex flex-col lg:flex-row gap-4">
                    <a href="#" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-500">Start Shopping</a>
                    <a href="#" class="px-6 py-3 bg-black text-white rounded-lg hover:bg-gray-800">Join Now</a>
                </div>
            </div>
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
@endsection
