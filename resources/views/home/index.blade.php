@extends('layouts.app')

@section('title', 'Home - QuickCart')

@section('content')
    <div class="bg-[url('/images/background.jpg')] bg-cover bg-center bg-no-repeat ">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center">
                <h1 class="text-5xl md:text-5xl font-bold mb-6 animate-fade-in text-blue-600">
                    Welcome to QuickCart
                </h1>
                <p class="text-xl md:text-xl mb-8 text-blue-600 animate-fade-in">
                    Shop the latest laptops, phones, and gadgets from Apple, Samsung, Sony, and more. <br> Premium tech at
                    prices
                    you’ll love.
                </p>
                <a href="#products"
                    class="inline-block px-8 py-4 bg-white text-blue-600 font-semibold rounded-lg hover:bg-gray-100 transition duration-300 shadow-lg">
                    Shop Now
                    <i class="fas fa-arrow-down ml-2"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-truck text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Free Shipping</h3>
                <p class="text-gray-600">On orders over $50</p>
            </div>
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-shield-alt text-green-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Secure Payment</h3>
                <p class="text-gray-600">100% secure transactions</p>
            </div>
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-undo text-purple-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Easy Returns</h3>
                <p class="text-gray-600">30-day return policy</p>
            </div>
        </div>
    </div>

    <!-- Products Section -->
    <div id="products" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Section Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Our Products</h2>
                <p class="text-gray-600 mt-2">Explore our curated collection</p>
            </div>

            <!-- Filter/Sort Dropdown -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open"
                    class="px-4 py-2 border border-gray-300 rounded-lg flex items-center space-x-2 hover:border-blue-500 transition duration-200">
                    <i class="fas fa-filter"></i>
                    <span>Sort By</span>
                    <i class="fas fa-chevron-down"></i>
                </button>

                <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform scale-95"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl z-10 border border-gray-200">
                    <a href="?sort=newest" class="block px-4 py-3 hover:bg-gray-50 transition duration-200">Newest First</a>
                    <a href="?sort=price_low" class="block px-4 py-3 hover:bg-gray-50 transition duration-200">Price: Low to
                        High</a>
                    <a href="?sort=price_high" class="block px-4 py-3 hover:bg-gray-50 transition duration-200">Price: High
                        to Low</a>
                    <a href="?sort=popular" class="block px-4 py-3 hover:bg-gray-50 transition duration-200">Most
                        Popular</a>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6">

            @forelse($products as $product)
                <div class="product-card bg-white rounded-xl shadow-md overflow-hidden group">
                    <!-- Product Image -->
                    <div class="relative overflow-hidden h-64 bg-gray-200">

                        <img src="{{ asset('images/' . $product->image) }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition duration-500">

                        <!-- Quick View Badge -->
                        <div
                            class="absolute top-4 right-4 bg-blue-600 text-white px-3 py-1 rounded-full text-xs font-semibold">
                            New
                        </div>

                        <!-- Quick Action Buttons -->
                        <div
                            class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition duration-300 flex items-center justify-center space-x-2 opacity-0 group-hover:opacity-100">
                            <a href="/product/{{ $product->id }}"
                                class="w-10 h-10 bg-white rounded-full flex items-center justify-center hover:bg-blue-600 hover:text-white transition duration-200">
                                <i class="fas fa-eye"></i>
                            </a>
                            <button onclick="addToCartQuick({{ $product->id }})"
                                class="w-10 h-10 bg-white rounded-full flex items-center justify-center hover:bg-blue-600 hover:text-white transition duration-200">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="p-4">
                        <a href="/product/{{ $product->id }}" class="block">
                            <h3
                                class="text-lg font-semibold text-gray-900 mb-2 hover:text-blue-600 transition duration-200 line-clamp-2">
                                {{ $product->name }}
                            </h3>
                        </a>

                        <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                            {{ $product->description }}
                        </p>

                        <!-- Rating -->
                        <div class="flex items-center mb-3">
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="text-gray-600 text-sm ml-2">(4.5)</span>
                        </div>

                        <!-- Price and Add to Cart -->
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold text-blue-600">
                                ${{ number_format($product->price, 2) }}
                            </span>
                            <button onclick="addToCart({{ $product->id }})"
                                class="btn-primary px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 flex items-center space-x-2">
                                <i class="fas fa-cart-plus"></i>
                                <span>Add</span>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <i class="fas fa-box-open text-gray-300 text-6xl mb-4"></i>
                    <p class="text-gray-500 text-xl">No products available</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if ($products->hasPages())
            <div class="mt-12 flex justify-center">
                {{ $products->links() }}
            </div>
        @endif
    </div>

    <!-- Newsletter Section -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center text-white">
                <h2 class="text-3xl font-bold mb-4">Stay Updated!</h2>
                <p class="text-xl mb-8 text-blue-100">Subscribe to our newsletter for exclusive deals and updates</p>
                <div class="max-w-md mx-auto flex">
                    <input type="email" placeholder="Enter your email"
                        class="flex-1 px-6 py-4 rounded-l-lg focus:outline-none text-gray-900">
                    <button
                        class="px-8 py-4 bg-white text-blue-600 font-semibold rounded-r-lg hover:bg-gray-100 transition duration-200">
                        Subscribe
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Add to Cart Function
        function addToCart(productId) {
            fetch('/cart/add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        quantity: 1
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update cart count
                        updateCartCount(data.cartCount);

                        // Show success message
                        showNotification('Product added to cart!', 'success');
                    }
                })
                .catch(error => {
                    showNotification('Something went wrong!', 'error');
                });
        }

        // Quick Add to Cart
        function addToCartQuick(productId) {
            addToCart(productId);
        }

        // Update Cart Count
        function updateCartCount(count) {
            const badge = document.querySelector('.cart-badge');
            badge.textContent = count;
            badge.classList.add('animate-bounce');
            setTimeout(() => badge.classList.remove('animate-bounce'), 500);
        }

        // Show Notification
        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className =
                `fixed top-24 right-4 z-50 px-6 py-4 rounded-lg shadow-lg flex items-center space-x-3 ${type === 'success' ? 'bg-green-500' : 'bg-red-500'} text-white`;
            notification.innerHTML = `
            <i class="fas fa-${type === 'success' ? 'check' : 'exclamation'}-circle text-2xl"></i>
            <span class="font-medium">${message}</span>
        `;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.remove();
            }, 3000);
        }
    </script>
@endpush
