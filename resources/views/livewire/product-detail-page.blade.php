<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <section class="overflow-hidden bg-white py-11 font-poppins dark:bg-gray-800" x-data="{ mainImage: '{{ asset('storage/' . ($product->images[0]['filename'] ?? '')) }}' }">
        <div class="max-w-6xl px-4 py-4 mx-auto lg:py-8 md:px-6">
            <div class="flex flex-wrap -mx-4">

                {{-- Brand Logo --}}
                @if (isset($brand))
                    <div class="w-full mb-6">
                        <img src="{{ asset('storage/' . $brand->image) }}" alt="{{ $brand->name }}"
                            class="border-4 border-white w-60">
                    </div>
                @endif

                {{-- Left Side: Image Gallery --}}
                <div class="sticky top-0 z-10 w-full md:w-1/2 px-4">
                    {{-- Gambar Utama --}}
                    <div class="relative mb-6 lg:mb-10">
                        <img :src="mainImage" alt="{{ $product->name }}"
                            class="object-cover w-full h-96 rounded-md shadow-md">
                    </div>

                    {{-- Thumbnail --}}
                    <div class="flex-wrap hidden md:flex gap-4">
                        @foreach ($product->images as $image)
                            <div class="w-1/4 border-2 border-white p-2 cursor-pointer rounded-md shadow-sm hover:border-blue-500"
                                @click="mainImage='{{ asset('storage/' . $image) }}'">
                                <img src="{{ asset('storage/' . $image) }}" alt="{{ $product->name }}"
                                    class="object-cover w-full h-20 rounded">
                            </div>
                        @endforeach
                    </div>
                </div>
                {{-- Right Side: Product Info --}}
                <div class="w-full md:w-1/2 px-4 mt-10 md:mt-0">
                    <div class="lg:pl-10">
                        {{-- Product Name --}}
                        <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-4">{{ $product->name }}</h2>

                        {{-- Price --}}
                        <p class="text-4xl font-bold text-blue-600 mb-4">
                            {{ Number::currency($product->price, 'IDR') }}
                        </p>

                        {{-- Description --}}
                        <p class="text-gray-700 dark:text-gray-300 mb-6">
                            {!! Str::markdown($product->description ?? '') !!}
                        </p>

                        {{-- Quantity Control --}}
                        <div class="w-40 mb-8">
                            <label
                                class="block text-lg font-semibold text-gray-700 dark:text-gray-300 mb-1">Quantity</label>
                            <div
                                class="flex items-center rounded-lg overflow-hidden border border-gray-300 dark:border-gray-600">
                                <button wire:click='decreaseQty' class="w-10 h-10 bg-gray-200 dark:bg-gray-700 text-xl font-bold">-</button>
                                <input type="number" wire:model='quantity' readonly value="1"
                                    class="w-12 text-center bg-transparent text-gray-700 dark:text-gray-300 outline-none" />
                                <button wire:click='increaseQty' class="w-10 h-10 bg-gray-200 dark:bg-gray-700 text-xl font-bold">+</button>
                            </div>
                        </div>

                        {{-- Add to Cart Button --}}
                        <button wire:click='addToCart({{ $product->id }})'
                            class="w-full md:w-1/2 bg-white hover:bg-blue-700 text-black py-3 rounded-lg font-semibold transition">
                            Add to Cart
                        </button>

                        {{-- Free Shipping Info --}}
                        <div class="flex items-center mt-6 text-gray-600 dark:text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h18v13H3V3zM16 21h-1a3 3 0 01-6 0H5a3 3 0 116 0h2a3 3 0 116 0z" />
                            </svg>
                            <span>Free Shipping</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
