@extends('layouts.app')

@section('title', 'Checkout - QuickCart')

@section('content')
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Progress Steps -->
            <div class="mb-12">
                <div class="flex items-center justify-center">
                    <div class="flex items-center space-x-4">
                        <!-- Step 1 -->
                        <div class="flex items-center">
                            <div
                                class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white font-bold">
                                <i class="fas fa-check"></i>
                            </div>
                            <span class="ml-2 font-semibold text-gray-700">Cart</span>
                        </div>

                        <div class="w-16 h-1 bg-green-500"></div>

                        <!-- Step 2 -->
                        <div class="flex items-center">
                            <div
                                class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                                2
                            </div>
                            <span class="ml-2 font-semibold text-blue-600">Checkout</span>
                        </div>

                        <div class="w-16 h-1 bg-gray-300"></div>

                        <!-- Step 3 -->
                        <div class="flex items-center">
                            <div
                                class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-gray-600 font-bold">
                                3
                            </div>
                            <span class="ml-2 font-semibold text-gray-400">Complete</span>
                        </div>
                    </div>
                </div>
            </div>

            <form action="/order/place" method="POST" x-data="checkoutForm()">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Checkout Form -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Customer Information -->
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <div class="flex items-center mb-6">
                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-blue-600"></i>
                                </div>
                                <h2 class="text-2xl font-bold text-gray-900">Customer Information</h2>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Full Name -->
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Full Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="customer_name" x-model="form.customer_name" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="John Doe">
                                    @error('customer_name')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Email Address <span class="text-red-500">*</span>
                                    </label>
                                    <input type="email" name="email" x-model="form.email" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="john@example.com">
                                    @error('email')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Phone -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Phone Number <span class="text-red-500">*</span>
                                    </label>
                                    <input type="tel" name="phone" x-model="form.phone" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="+1 (555) 000-0000">
                                    @error('phone')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Shipping Address -->
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <div class="flex items-center mb-6">
                                <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-map-marker-alt text-purple-600"></i>
                                </div>
                                <h2 class="text-2xl font-bold text-gray-900">Shipping Address</h2>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Street Address -->
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Street Address <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="address" x-model="form.address" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="123 Main Street, Apt 4B">
                                    @error('address')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- City -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        City <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="city" x-model="form.city" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="New York">
                                    @error('city')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- State -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        State/Province <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="state" x-model="form.state" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="NY">
                                    @error('state')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Zip Code -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        ZIP/Postal Code <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="zip" x-model="form.zip" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="10001">
                                    @error('zip')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Country -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Country <span class="text-red-500">*</span>
                                    </label>
                                    <select name="country" x-model="form.country" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="">Select Country</option>
                                        <option value="US">United States</option>
                                        <option value="CA">Canada</option>
                                        <option value="UK">United Kingdom</option>
                                        <option value="AU">Australia</option>
                                    </select>
                                    @error('country')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Order Notes -->
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <div class="flex items-center mb-6">
                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-sticky-note text-green-600"></i>
                                </div>
                                <h2 class="text-2xl font-bold text-gray-900">Order Notes (Optional)</h2>
                            </div>

                            <textarea name="notes" x-model="form.notes" rows="4"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Any special instructions for your order..."></textarea>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-xl shadow-md p-6 sticky top-24">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6">Order Summary</h2>

                            <!-- Cart Items -->
                            <div class="space-y-4 mb-6 max-h-64 overflow-y-auto">
                                @foreach (session('cart', []) as $item)
                                    <div class="flex items-center space-x-4 pb-4 border-b">
                                        <div class="w-16 h-16 bg-gray-200 rounded-lg overflow-hidden flex-shrink-0">
                                            <img src="{{ $item['image'] ?? 'https://via.placeholder.com/100x100?text=Product' }}"
                                                alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="font-semibold text-gray-900 text-sm">{{ $item['name'] }}</h4>
                                            <p class="text-gray-600 text-sm">Qty: {{ $item['quantity'] }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-bold text-gray-900">
                                                ${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Summary Calculations -->
                            <div class="space-y-3 mb-6">
                                <div class="flex justify-between text-gray-600">
                                    <span>Subtotal</span>
                                    <span class="font-semibold">${{ number_format($subtotal ?? 0, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-gray-600">
                                    <span>Shipping</span>
                                    <span class="font-semibold text-green-600">
                                        {{ ($subtotal ?? 0) > 50 ? 'Free' : '$10.00' }}
                                    </span>
                                </div>
                                <div class="flex justify-between text-gray-600">
                                    <span>Tax (10%)</span>
                                    <span class="font-semibold">${{ number_format(($subtotal ?? 0) * 0.1, 2) }}</span>
                                </div>
                            </div>

                            <!-- Total -->
                            <div class="border-t pt-4 mb-6">
                                <div class="flex justify-between items-center">
                                    <span class="text-xl font-semibold text-gray-900">Total</span>
                                    <span class="text-3xl font-bold text-blue-600">
                                        ${{ number_format(($subtotal ?? 0) + (($subtotal ?? 0) > 50 ? 0 : 10) + ($subtotal ?? 0) * 0.1, 2) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Terms and Conditions -->
                            <div class="mb-6">
                                <label class="flex items-start cursor-pointer">
                                    <input type="checkbox" x-model="form.terms" required
                                        class="mt-1 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    <span class="ml-3 text-sm text-gray-600">
                                        I agree to the <a href="#" class="text-blue-600 hover:underline">Terms and
                                            Conditions</a> and <a href="#"
                                            class="text-blue-600 hover:underline">Privacy Policy</a>
                                    </span>
                                </label>
                            </div>

                            <!-- Place Order Button -->
                            <button type="submit" :disabled="!form.terms || isSubmitting"
                                :class="!form.terms || isSubmitting ? 'bg-gray-400 cursor-not-allowed' :
                                    'bg-blue-600 hover:bg-blue-700'"
                                class="w-full text-white px-6 py-4 rounded-lg font-bold text-lg transition duration-200 shadow-lg flex items-center justify-center space-x-2">
                                <i class="fas fa-lock"></i>
                                <span x-text="isSubmitting ? 'Processing...' : 'Place Order'"></span>
                            </button>

                            <!-- Security Info -->
                            <div class="mt-6 pt-6 border-t">
                                <div class="flex items-center justify-center text-gray-500 text-sm mb-4">
                                    <i class="fas fa-shield-alt mr-2"></i>
                                    <span>Your payment information is secure</span>
                                </div>

                                <!-- Payment Icons -->
                                <div class="flex justify-center space-x-3 opacity-60">
                                    <i class="fab fa-cc-visa text-2xl"></i>
                                    <i class="fab fa-cc-mastercard text-2xl"></i>
                                    <i class="fab fa-cc-amex text-2xl"></i>
                                    <i class="fab fa-cc-paypal text-2xl"></i>
                                </div>
                            </div>

                            <!-- Back to Cart -->
                            <div class="mt-4 text-center">
                                <a href="/cart"
                                    class="text-blue-600 hover:text-blue-700 font-semibold text-sm flex items-center justify-center space-x-2">
                                    <i class="fas fa-arrow-left"></i>
                                    <span>Back to Cart</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function checkoutForm() {
            return {
                form: {
                    customer_name: '',
                    email: '',
                    phone: '',
                    address: '',
                    city: '',
                    state: '',
                    zip: '',
                    country: '',
                    notes: '',
                    terms: false
                },
                isSubmitting: false,

                init() {
                    // Pre-fill form if data exists in session
                    @if (old('customer_name'))
                        this.form.customer_name = '{{ old('customer_name') }}';
                        this.form.email = '{{ old('email') }}';
                        this.form.phone = '{{ old('phone') }}';
                        this.form.address = '{{ old('address') }}';
                        this.form.city = '{{ old('city') }}';
                        this.form.state = '{{ old('state') }}';
                        this.form.zip = '{{ old('zip') }}';
                        this.form.country = '{{ old('country') }}';
                        this.form.notes = '{{ old('notes') }}';
                    @endif
                }
            }
        }
    </script>
@endpush
