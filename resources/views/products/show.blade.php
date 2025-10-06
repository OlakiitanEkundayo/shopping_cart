@extends('layouts.app')

@section('title', $product->name . ' - QuickCart')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Breadcrumb -->
        <nav class="flex mb-8 text-sm">
            <a href="/" class="text-gray-500 hover:text-blue-600 transition duration-200">Home</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="/products" class="text-gray-500 hover:text-blue-600 transition duration-200">Products</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-gray-900 font-medium">{{ $product->name }}</span>
        </nav>

        <!-- Product Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12" x-data="productDetail()">
            <!-- Product Images -->
            <div>
                <!-- Main Image -->
                <div class="bg-gray-100 rounded-2xl overflow-hidden mb-4 sticky top-24">
                    <img :src="selectedImage" alt="{{ $product->name }}" class="w-full h-80 lg:h-[600px] object-cover">
                </div>

                <!-- Thumbnail Images -->
                <div class="grid grid-cols-4 gap-4">
                    <button
                        @click="selectedImage = '{{ $product->image ?? 'https://via.placeholder.com/800x800?text=Product' }}'"
                        :class="selectedImage === '{{ $product->image ?? 'https://via.placeholder.com/800x800?text=Product' }}'
                            ?
                            'border-blue-600' : 'border-gray-300'"
                        class="border-2 rounded-lg overflow-hidden hover:border-blue-600 transition duration-200">
                        <img src="{{ $product->image ?? 'https://via.placeholder.com/200x200?text=Product' }}"
                            alt="Thumbnail" class="w-full h-24 object-cover">
                    </button>
                </div>
            </div>

            <!-- Product Info -->
            <div>
                <!-- Product Title and Rating -->
                <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>

                <div class="flex items-center mb-6">
                    <div class="flex text-yellow-400 text-lg">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <span class="ml-2 text-gray-600">(4.5)</span>
                    <span class="ml-4 text-gray-600">5 Reviews</span>
                </div>

                <!-- Price -->
                <div class="mb-6">
                    <span class="text-5xl font-bold text-blue-600">${{ number_format($product->price, 2) }}</span>
                    <span
                        class="text-2xl text-gray-400 line-through ml-4">${{ number_format($product->price * 1.3, 2) }}</span>
                    <span class="ml-3 px-3 py-1 bg-red-100 text-red-600 rounded-full text-sm font-semibold">23% OFF</span>
                </div>

                <!-- Stock Status -->
                <div class="mb-6">
                    @if ($product->stock_quantity > 0)
                        <div class="flex items-center text-green-600">
                            <i class="fas fa-check-circle mr-2"></i>
                            <span class="font-semibold">In Stock ({{ $product->stock_quantity }} available)</span>
                        </div>
                    @else
                        <div class="flex items-center text-red-600">
                            <i class="fas fa-times-circle mr-2"></i>
                            <span class="font-semibold">Out of Stock</span>
                        </div>
                    @endif
                </div>

                <!-- Description -->
                <div class="mb-8">
                    <h3 class="text-xl font-semibold mb-3">Description</h3>
                    <p class="text-gray-600 leading-relaxed">
                        {{ $product->description }}
                    </p>
                </div>

                <!-- Quantity Selector -->
                <div class="mb-8">
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Quantity</label>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center border-2 border-gray-300 rounded-lg">
                            <button @click="quantity > 1 ? quantity-- : quantity"
                                class="px-4 py-3 hover:bg-gray-100 transition duration-200">
                                <i class="fas fa-minus text-gray-600"></i>
                            </button>
                            <input type="number" x-model="quantity" min="1" max="{{ $product->stock_quantity }}"
                                class="w-20 text-center border-0 focus:ring-0 font-semibold text-lg">
                            <button @click="quantity < {{ $product->stock_quantity }} ? quantity++ : quantity"
                                class="px-4 py-3 hover:bg-gray-100 transition duration-200">
                                <i class="fas fa-plus text-gray-600"></i>
                            </button>
                        </div>
                        <span class="text-gray-600">Max: {{ $product->stock_quantity }}</span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 mb-8">
                    <button @click="addToCart()"
                        class="flex-1 bg-blue-600 text-white px-8 py-4 rounded-lg font-semibold hover:bg-blue-700 transition duration-200 flex items-center justify-center space-x-3 shadow-lg hover:shadow-xl">
                        <i class="fas fa-shopping-cart text-xl"></i>
                        <span class="text-lg">Add to Cart</span>
                    </button>
                    <button
                        class="px-6 py-4 border-2 border-blue-600 text-blue-600 rounded-lg font-semibold hover:bg-blue-50 transition duration-200 flex items-center justify-center">
                        <i class="fas fa-heart text-xl"></i>
                    </button>
                    <button
                        class="px-6 py-4 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition duration-200 flex items-center justify-center">
                        <i class="fas fa-share-alt text-xl"></i>
                    </button>
                </div>

                <!-- Features -->
                <div class="bg-gray-50 rounded-xl p-6 mb-8">
                    <h3 class="text-lg font-semibold mb-4">Key Features</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <span class="text-gray-700">High quality product</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <span class="text-gray-700">Free shipping on orders over $50</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <span class="text-gray-700">30-day money-back guarantee</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <span class="text-gray-700">24/7 customer support</span>
                        </li>
                    </ul>
                </div>

                <!-- Shipping Info -->
                <div class="border-t pt-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-truck text-blue-600 text-xl mr-3"></i>
                            <div>
                                <p class="font-semibold">Free Delivery</p>
                                <p class="text-sm text-gray-500">Estimated delivery: 3-5 business days</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-undo text-blue-600 text-xl mr-3"></i>
                            <div>
                                <p class="font-semibold">Easy Returns</p>
                                <p class="text-sm text-gray-500">30-day return policy</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Details Tabs -->
        <div class="mt-16" x-data="{ activeTab: 'description' }">
            <!-- Tab Headers -->
            <div class="border-b border-gray-200 mb-8">
                <div class="flex space-x-8">
                    <button @click="activeTab = 'description'"
                        :class="activeTab === 'description' ? 'border-blue-600 text-blue-600' :
                            'border-transparent text-gray-500'"
                        class="pb-4 border-b-2 font-semibold transition duration-200 hover:text-blue-600">
                        Description
                    </button>
                    <button @click="activeTab = 'specifications'"
                        :class="activeTab === 'specifications' ? 'border-blue-600 text-blue-600' :
                            'border-transparent text-gray-500'"
                        class="pb-4 border-b-2 font-semibold transition duration-200 hover:text-blue-600">
                        Specifications
                    </button>
                    <button @click="activeTab = 'reviews'"
                        :class="activeTab === 'reviews' ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-500'"
                        class="pb-4 border-b-2 font-semibold transition duration-200 hover:text-blue-600">
                        Reviews (156)
                    </button>
                </div>
            </div>

            <!-- Tab Content -->
            <div>
                <!-- Description Tab -->
                <div x-show="activeTab === 'description'" class="prose max-w-none">
                    <h3 class="text-2xl font-bold mb-4">Product Description</h3>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        {{ $product->description }}
                    </p>
                    <p class="text-gray-600 leading-relaxed">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore
                        et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.
                    </p>
                </div>

                <!-- Specifications Tab -->
                <div x-show="activeTab === 'specifications'">
                    <h3 class="text-2xl font-bold mb-6">Technical Specifications</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-gray-600 text-sm mb-1">SKU</p>
                            <p class="font-semibold">{{ $product->id }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-gray-600 text-sm mb-1">Weight</p>
                            <p class="font-semibold">1.5 kg</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-gray-600 text-sm mb-1">Dimensions</p>
                            <p class="font-semibold">25 x 15 x 10 cm</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-gray-600 text-sm mb-1">Material</p>
                            <p class="font-semibold">Premium Quality</p>
                        </div>
                    </div>
                </div>

                <!-- Reviews Tab -->
                <div x-show="activeTab === 'reviews'">
                    <h3 class="text-2xl font-bold mb-6">Customer Reviews</h3>

                    <!-- Review Summary -->
                    <div class="bg-gray-50 rounded-xl p-6 mb-8">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="flex items-center mb-2">
                                    <span class="text-5xl font-bold mr-4">4.5</span>
                                    <div>
                                        <div class="flex text-yellow-400 text-xl mb-1">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                        </div>
                                        <p class="text-gray-600">Based on 5 reviews</p>
                                    </div>
                                </div>
                            </div>
                            <button
                                class="px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
                                Write a Review
                            </button>
                        </div>
                    </div>

                    <!-- Individual Reviews -->
                    <div class="space-y-6">
                        @for ($i = 1; $i <= 3; $i++)
                            <div class="border-b pb-6">
                                <div class="flex items-start justify-between mb-3">
                                    <div>
                                        <h4 class="font-semibold text-lg">John Doe</h4>
                                        <div class="flex text-yellow-400 text-sm mt-1">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                    </div>
                                    <span class="text-gray-500 text-sm">2 days ago</span>
                                </div>
                                <p class="text-gray-700 leading-relaxed">
                                    Great product! Exactly as described. Fast shipping and excellent customer service.
                                    Highly recommended!
                                </p>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        <div class="mt-20">
            <h2 class="text-3xl font-bold mb-8">You May Also Like</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse ($relatedProducts as $related)
                    <div class="product-card bg-white rounded-xl shadow-md overflow-hidden group">
                        <div class="relative overflow-hidden h-48 bg-gray-200">
                            <img src="{{ asset('images/' . $related->image) }}" alt="Related Product"
                                class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 mb-2">Related Product {{ $related->name }}</h3>
                            <div class="flex items-center justify-between">
                                <span class="text-xl font-bold text-blue-600">{{ $related->price }}</span>
                                <button
                                    class="px-3 py-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                                    <i class="fas fa-cart-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function productDetail() {
            return {
                selectedImage: '{{ asset('images/' . $product->image) ?? 'https://via.placeholder.com/800x800?text=Product' }}',
                quantity: 1,

                addToCart() {
                    fetch('/cart/add', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                product_id: {{ $product->id }},
                                quantity: this.quantity
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                this.showNotification('Product added to cart!', 'success');
                                this.updateCartCount(data.cartCount);
                            }
                        })
                        .catch(error => {
                            this.showNotification('Something went wrong!', 'error');
                        });
                },

                updateCartCount(count) {
                    const badge = document.querySelector('.cart-badge');
                    badge.textContent = count;
                    badge.classList.add('animate-bounce');
                    setTimeout(() => badge.classList.remove('animate-bounce'), 500);
                },

                showNotification(message, type) {
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
            }
        }
    </script>
@endpush
{{-- <span class="ml-4 text-gray-500">|</span> --}}
