@extends('layouts.app')

@section('title', 'Order Confirmation - QuickCart')

@section('content')
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Success Animation -->
            <div class="text-center mb-8">
                <div class="inline-block">
                    <div
                        class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4 animate-bounce">
                        <i class="fas fa-check text-green-600 text-5xl"></i>
                    </div>
                </div>
                <h1 class="text-4xl font-bold text-gray-900 mb-2">Order Confirmed!</h1>
                <p class="text-xl text-gray-600">Thank you for your purchase</p>
            </div>

            <!-- Order Number -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl p-8 text-white text-center mb-8 shadow-lg">
                <p class="text-sm mb-2 text-blue-100">Order Number</p>
                <h2 class="text-4xl font-bold mb-4">#{{ $order->id ?? '000000' }}</h2>
                <p class="text-blue-100">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    {{ $order->created_at->format('F d, Y - h:i A') ?? now()->format('F d, Y - h:i A') }}
                </p>
            </div>

            <!-- Order Status Timeline -->
            <div class="bg-white rounded-xl shadow-md p-8 mb-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Order Status</h3>

                <div class="relative">
                    <!-- Timeline Line -->
                    <div class="absolute left-6 top-0 bottom-0 w-0.5 bg-gray-200"></div>

                    <!-- Status Steps -->
                    <div class="space-y-8">
                        <!-- Order Placed -->
                        <div class="relative flex items-start">
                            <div
                                class="flex items-center justify-center w-12 h-12 rounded-full bg-green-500 text-white font-bold z-10">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="ml-6 flex-1">
                                <h4 class="font-semibold text-gray-900 text-lg">Order Placed</h4>
                                <p class="text-gray-600 text-sm">Your order has been received</p>
                                <p class="text-gray-500 text-xs mt-1">{{ now()->format('M d, Y - h:i A') }}</p>
                            </div>
                        </div>

                        <!-- Processing -->
                        <div class="relative flex items-start">
                            <div
                                class="flex items-center justify-center w-12 h-12 rounded-full bg-blue-500 text-white font-bold z-10 animate-pulse">
                                <i class="fas fa-cog fa-spin"></i>
                            </div>
                            <div class="ml-6 flex-1">
                                <h4 class="font-semibold text-gray-900 text-lg">Processing</h4>
                                <p class="text-gray-600 text-sm">We're preparing your order</p>
                                <p class="text-gray-500 text-xs mt-1">Estimated: 1-2 hours</p>
                            </div>
                        </div>

                        <!-- Shipped -->
                        <div class="relative flex items-start">
                            <div
                                class="flex items-center justify-center w-12 h-12 rounded-full bg-gray-300 text-gray-600 font-bold z-10">
                                <i class="fas fa-shipping-fast"></i>
                            </div>
                            <div class="ml-6 flex-1">
                                <h4 class="font-semibold text-gray-400 text-lg">Shipped</h4>
                                <p class="text-gray-400 text-sm">Your order will be on its way soon</p>
                                <p class="text-gray-400 text-xs mt-1">Estimated: 2-3 days</p>
                            </div>
                        </div>

                        <!-- Delivered -->
                        <div class="relative flex items-start">
                            <div
                                class="flex items-center justify-center w-12 h-12 rounded-full bg-gray-300 text-gray-600 font-bold z-10">
                                <i class="fas fa-home"></i>
                            </div>
                            <div class="ml-6 flex-1">
                                <h4 class="font-semibold text-gray-400 text-lg">Delivered</h4>
                                <p class="text-gray-400 text-sm">Order arrives at your doorstep</p>
                                <p class="text-gray-400 text-xs mt-1">Estimated: 3-5 days</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Details -->
            <div class="bg-white rounded-xl shadow-md p-8 mb-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Order Details</h3>

                <!-- Items -->
                <div class="space-y-4 mb-6">
                    @foreach ($order->orderItems ?? [] as $item)
                        <div class="flex items-center space-x-4 pb-4 border-b">
                            <div class="w-20 h-20 bg-gray-200 rounded-lg overflow-hidden flex-shrink-0">
                                <img src="{{ $item->product->image ?? 'https://via.placeholder.com/100x100?text=Product' }}"
                                    alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900">{{ $item->product->name }}</h4>
                                <p class="text-gray-600 text-sm">Quantity: {{ $item->quantity }}</p>
                                <p class="text-gray-600 text-sm">Price: ${{ number_format($item->price, 2) }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-gray-900 text-lg">
                                    ${{ number_format($item->price * $item->quantity, 2) }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Order Summary -->
                <div class="border-t pt-6">
                    <div class="space-y-3">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span class="font-semibold">${{ number_format($order->subtotal ?? 0, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Shipping</span>
                            <span class="font-semibold text-green-600">
                                {{ ($order->shipping ?? 0) == 0 ? 'Free' : '$' . number_format($order->shipping, 2) }}
                            </span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Tax</span>
                            <span class="font-semibold">${{ number_format($order->tax ?? 0, 2) }}</span>
                        </div>
                        <div class="border-t pt-3 flex justify-between items-center">
                            <span class="text-xl font-bold text-gray-900">Total</span>
                            <span class="text-3xl font-bold text-blue-600">
                                ${{ number_format($order->total ?? 0, 2) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Customer & Shipping Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Customer Information -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-user text-blue-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Customer Info</h3>
                    </div>
                    <div class="space-y-2 text-gray-600">
                        <p><strong>Name:</strong> {{ $order->customer_name ?? 'N/A' }}</p>
                        <p><strong>Email:</strong> {{ $order->email ?? 'N/A' }}</p>
                        <p><strong>Phone:</strong> {{ $order->phone ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Shipping Address -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-map-marker-alt text-purple-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Shipping Address</h3>
                    </div>
                    <div class="text-gray-600">
                        <p>{{ $order->address ?? 'N/A' }}</p>
                        <p>{{ $order->city ?? 'N/A' }}, {{ $order->state ?? 'N/A' }} {{ $order->zip ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <!-- Email Confirmation Notice -->
            <div class="bg-blue-50 border-l-4 border-blue-600 rounded-lg p-6 mb-8">
                <div class="flex items-start">
                    <i class="fas fa-envelope text-blue-600 text-2xl mr-4 mt-1"></i>
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-2">Confirmation Email Sent</h4>
                        <p class="text-gray-600">
                            We've sent a confirmation email to <strong>{{ $order->email ?? 'your email' }}</strong> with
                            your order details and tracking information.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/"
                    class="px-8 py-4 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition duration-200 text-center shadow-lg">
                    <i class="fas fa-shopping-bag mr-2"></i>
                    Continue Shopping
                </a>
                <button onclick="window.print()"
                    class="px-8 py-4 border-2 border-blue-600 text-blue-600 rounded-lg font-semibold hover:bg-blue-50 transition duration-200">
                    <i class="fas fa-print mr-2"></i>
                    Print Receipt
                </button>
            </div>

            <!-- Help Section -->
            <div class="mt-12 text-center">
                <p class="text-gray-600 mb-4">Need help with your order?</p>
                <div class="flex flex-wrap justify-center gap-6">
                    <a href="#" class="text-blue-600 hover:text-blue-700 font-semibold flex items-center">
                        <i class="fas fa-headset mr-2"></i>
                        Contact Support
                    </a>
                    <a href="#" class="text-blue-600 hover:text-blue-700 font-semibold flex items-center">
                        <i class="fas fa-question-circle mr-2"></i>
                        View FAQs
                    </a>
                    <a href="#" class="text-blue-600 hover:text-blue-700 font-semibold flex items-center">
                        <i class="fas fa-undo mr-2"></i>
                        Return Policy
                    </a>
                </div>
            </div>

            <!-- Social Share -->
            <div class="mt-12 text-center pb-8">
                <p class="text-gray-600 mb-4">Share your purchase!</p>
                <div class="flex justify-center space-x-4">
                    <button
                        class="w-12 h-12 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition duration-200">
                        <i class="fab fa-facebook-f"></i>
                    </button>
                    <button
                        class="w-12 h-12 bg-blue-400 text-white rounded-full hover:bg-blue-500 transition duration-200">
                        <i class="fab fa-twitter"></i>
                    </button>
                    <button
                        class="w-12 h-12 bg-pink-600 text-white rounded-full hover:bg-pink-700 transition duration-200">
                        <i class="fab fa-instagram"></i>
                    </button>
                    <button
                        class="w-12 h-12 bg-green-600 text-white rounded-full hover:bg-green-700 transition duration-200">
                        <i class="fab fa-whatsapp"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Confetti animation on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Create confetti effect
            createConfetti();
        });

        function createConfetti() {
            const colors = ['#3B82F6', '#8B5CF6', '#EC4899', '#10B981', '#F59E0B'];
            const confettiCount = 50;

            for (let i = 0; i < confettiCount; i++) {
                setTimeout(() => {
                    const confetti = document.createElement('div');
                    confetti.style.position = 'fixed';
                    confetti.style.width = '10px';
                    confetti.style.height = '10px';
                    confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                    confetti.style.left = Math.random() * window.innerWidth + 'px';
                    confetti.style.top = '-10px';
                    confetti.style.opacity = '1';
                    confetti.style.transform = 'rotate(' + Math.random() * 360 + 'deg)';
                    confetti.style.transition = 'all 3s ease-out';
                    confetti.style.pointerEvents = 'none';
                    confetti.style.zIndex = '9999';

                    document.body.appendChild(confetti);

                    setTimeout(() => {
                        confetti.style.top = window.innerHeight + 'px';
                        confetti.style.opacity = '0';
                    }, 50);

                    setTimeout(() => {
                        confetti.remove();
                    }, 3000);
                }, i * 30);
            }
        }
    </script>
@endpush
