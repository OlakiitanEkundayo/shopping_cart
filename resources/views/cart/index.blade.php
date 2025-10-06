@extends('layouts.app')

@section('title', 'Shopping Cart - QuickCart')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Shopping Cart</h1>
            <p class="text-gray-600">Review your items and proceed to checkout</p>
        </div>

        @if (session('cart') && count(session('cart')) > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8" x-data="cartManager()">
                <!-- Cart Items -->
                <div class="lg:col-span-2 space-y-4">
                    <template x-for="(item, index) in cartItems" :key="index">
                        <div
                            class="bg-white rounded-xl shadow-md p-6 flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-6">
                            <!-- Product Image -->
                            <div class="w-full sm:w-32 h-32 bg-gray-200 rounded-lg overflow-hidden flex-shrink-0">
                                <img :src="item.image || 'https://via.placeholder.com/200x200?text=Product'"
                                    :alt="item.name" class="w-full h-full object-cover">
                            </div>

                            <!-- Product Info -->
                            <div class="flex-1 w-full">
                                <div class="flex justify-between items-start mb-3">
                                    <div>
                                        <h3 class="text-xl font-semibold text-gray-900 mb-1" x-text="item.name"></h3>
                                        <p class="text-gray-600 text-sm">SKU: <span x-text="item.id"></span></p>
                                    </div>
                                    <button @click="removeItem(index)"
                                        class="text-red-500 hover:text-red-700 transition duration-200">
                                        <i class="fas fa-trash-alt text-xl"></i>
                                    </button>
                                </div>

                                <!-- Price and Quantity -->
                                <div
                                    class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
                                    <!-- Quantity Selector -->
                                    <div class="flex items-center border-2 border-gray-300 rounded-lg">
                                        <button @click="updateQuantity(index, item.quantity - 1)"
                                            class="px-4 py-2 hover:bg-gray-100 transition duration-200">
                                            <i class="fas fa-minus text-gray-600"></i>
                                        </button>
                                        <input type="number" :value="item.quantity"
                                            @input="updateQuantity(index, $event.target.value)" min="1"
                                            class="w-16 text-center border-0 focus:ring-0 font-semibold">
                                        <button @click="updateQuantity(index, item.quantity + 1)"
                                            class="px-4 py-2 hover:bg-gray-100 transition duration-200">
                                            <i class="fas fa-plus text-gray-600"></i>
                                        </button>
                                    </div>

                                    <!-- Price -->
                                    <div class="text-right">
                                        <p class="text-sm text-gray-600 mb-1">
                                            $<span x-text="item.price.toFixed(2)"></span> each
                                        </p>
                                        <p class="text-2xl font-bold text-blue-600">
                                            $<span x-text="(item.price * item.quantity).toFixed(2)"></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>

                    <!-- Continue Shopping Button -->
                    <div class="flex justify-between items-center pt-4">
                        <a href="/"
                            class="flex items-center space-x-2 text-blue-600 hover:text-blue-700 font-semibold transition duration-200">
                            <i class="fas fa-arrow-left"></i>
                            <span>Continue Shopping</span>
                        </a>
                        <button @click="clearCart()"
                            class="text-red-500 hover:text-red-700 font-semibold transition duration-200">
                            <i class="fas fa-trash-alt mr-2"></i>
                            Clear Cart
                        </button>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-md p-6 sticky top-24">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Order Summary</h2>

                        <!-- Summary Items -->
                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal (<span x-text="totalItems"></span> items)</span>
                                <span class="font-semibold">$<span x-text="subtotal.toFixed(2)"></span></span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Shipping</span>
                                <span class="font-semibold text-green-600"
                                    x-text="shipping === 0 ? 'Free' : '$' + shipping.toFixed(2)"></span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Tax (10%)</span>
                                <span class="font-semibold">$<span x-text="tax.toFixed(2)"></span></span>
                            </div>

                            <!-- Discount Code -->
                            <div class="pt-4 border-t">
                                <div x-data="{ showDiscount: false }">
                                    <button @click="showDiscount = !showDiscount"
                                        class="text-blue-600 hover:text-blue-700 font-semibold text-sm flex items-center space-x-2">
                                        <i class="fas fa-tag"></i>
                                        <span>Apply Discount Code</span>
                                    </button>
                                    <div x-show="showDiscount" x-transition class="mt-3 flex space-x-2">
                                        <input type="text" placeholder="Enter code"
                                            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <button
                                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 font-semibold">
                                            Apply
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total -->
                        <div class="border-t pt-4 mb-6">
                            <div class="flex justify-between items-center">
                                <span class="text-xl font-semibold text-gray-900">Total</span>
                                <span class="text-3xl font-bold text-blue-600">$<span
                                        x-text="total.toFixed(2)"></span></span>
                            </div>
                        </div>

                        <!-- Checkout Button -->
                        <a href="/checkout"
                            class="block w-full bg-blue-600 text-white text-center px-6 py-4 rounded-lg font-bold text-lg hover:bg-blue-700 transition duration-200 shadow-lg hover:shadow-xl mb-4">
                            Proceed to Checkout
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>

                        <!-- Security Badges -->
                        <div class="flex items-center justify-center space-x-4 text-gray-500 text-sm pt-4 border-t">
                            <div class="flex items-center">
                                <i class="fas fa-lock mr-2"></i>
                                <span>Secure Checkout</span>
                            </div>
                        </div>

                        <!-- Payment Methods -->
                        <div class="mt-6 pt-6 border-t">
                            <p class="text-sm text-gray-600 mb-3 text-center">We accept</p>
                            <div class="flex justify-center space-x-3 opacity-60">
                                <i class="fab fa-cc-visa text-3xl"></i>
                                <i class="fab fa-cc-mastercard text-3xl"></i>
                                <i class="fab fa-cc-amex text-3xl"></i>
                                <i class="fab fa-cc-paypal text-3xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty Cart State -->
            <div class="text-center py-20">
                <div class="w-32 h-32 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-shopping-cart text-gray-400 text-6xl"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Your Cart is Empty</h2>
                <p class="text-gray-600 mb-8 text-lg">Looks like you haven't added any items to your cart yet.</p>
                <a href="/"
                    class="inline-block px-8 py-4 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-200 shadow-lg">
                    <i class="fas fa-shopping-bag mr-2"></i>
                    Start Shopping
                </a>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        function cartManager() {
            return {
                cartItems: @json(session('cart', [])),

                get totalItems() {
                    return this.cartItems.reduce((sum, item) => sum + item.quantity, 0);
                },

                get subtotal() {
                    return this.cartItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);
                },

                get shipping() {
                    return this.subtotal > 50 ? 0 : 10;
                },

                get tax() {
                    return this.subtotal * 0.10;
                },

                get total() {
                    return this.subtotal + this.shipping + this.tax;
                },

                updateQuantity(index, newQuantity) {
                    newQuantity = parseInt(newQuantity);
                    if (newQuantity < 1) return;

                    this.cartItems[index].quantity = newQuantity;
                    this.syncWithServer();
                },

                removeItem(index) {
                    if (confirm('Are you sure you want to remove this item?')) {
                        this.cartItems.splice(index, 1);
                        this.syncWithServer();

                        if (this.cartItems.length === 0) {
                            setTimeout(() => window.location.reload(), 500);
                        }
                    }
                },

                clearCart() {
                    if (confirm('Are you sure you want to clear your cart?')) {
                        this.cartItems = [];
                        this.syncWithServer();
                        setTimeout(() => window.location.reload(), 500);
                    }
                },

                syncWithServer() {
                    fetch('/cart/update', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                cart: this.cartItems
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Update cart badge
                                const badge = document.querySelector('.cart-badge');
                                badge.textContent = this.totalItems;
                            }
                        });
                }
            }
        }
    </script>
@endpush
