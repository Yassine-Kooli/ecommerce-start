<div>
    <!-- Page Header -->
    <div class="bg-gray-100 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900">Shopping Cart</h1>
            <p class="text-gray-600 mt-2">Review your items before checkout</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if($cartItems->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cart Items -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-sm">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-medium text-gray-900">Cart Items ({{ $cartItems->count() }})</h2>
                        </div>

                        <div class="divide-y divide-gray-200">
                            @foreach($cartItems as $item)
                                <div class="p-6 flex items-center space-x-4">
                                    <!-- Product Image -->
                                    <div class="flex-shrink-0">
                                        @if($item->product && $item->product->getFirstMediaUrl('gallery'))
                                            <img src="{{ $item->product->getFirstMediaUrl('gallery') }}"
                                                 alt="{{ $item->item }}"
                                                 class="w-20 h-20 object-cover rounded-lg">
                                        @else
                                            <div class="w-20 h-20 bg-gray-200 rounded-lg flex items-center justify-center">
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Product Info -->
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-lg font-medium text-gray-900">{{ $item->item }}</h3>
                                        <div class="flex items-center space-x-2 mt-1">
                                            @if($item->discount > 0)
                                                <span class="text-lg font-semibold text-indigo-600">
                                                    ${{ number_format($item->price - $item->discount, 2) }}
                                                </span>
                                                <span class="text-sm text-gray-500 line-through">
                                                    ${{ number_format($item->price, 2) }}
                                                </span>
                                            @else
                                                <span class="text-lg font-semibold text-indigo-600">
                                                    ${{ number_format($item->price, 2) }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Quantity Controls -->
                                    <div class="flex items-center space-x-2">
                                        <button wire:click="updateQuantity({{ $item->id }}, {{ $item->qty - 1 }})"
                                                class="p-1 text-gray-400 hover:text-gray-600"
                                                {{ $item->qty <= 1 ? 'disabled' : '' }}>
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                            </svg>
                                        </button>
                                        <span class="px-3 py-1 text-gray-900 font-medium">{{ $item->qty }}</span>
                                        <button wire:click="updateQuantity({{ $item->id }}, {{ $item->qty + 1 }})"
                                                class="p-1 text-gray-400 hover:text-gray-600">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Item Total -->
                                    <div class="text-lg font-semibold text-gray-900">
                                        ${{ number_format($item->total, 2) }}
                                    </div>

                                    <!-- Remove Button -->
                                    <button wire:click="removeItem({{ $item->id }})"
                                            class="p-2 text-red-400 hover:text-red-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>

                        <!-- Clear Cart -->
                        <div class="px-6 py-4 border-t border-gray-200">
                            <button wire:click="clearCart"
                                    class="text-red-600 hover:text-red-800 text-sm font-medium">
                                Clear Cart
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h2 class="text-lg font-medium text-gray-900 mb-4">Order Summary</h2>

                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="text-gray-900">${{ number_format($total, 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Shipping</span>
                                <span class="text-gray-900">Free</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tax</span>
                                <span class="text-gray-900">$0.00</span>
                            </div>
                            <div class="border-t pt-3">
                                <div class="flex justify-between">
                                    <span class="text-lg font-medium text-gray-900">Total</span>
                                    <span class="text-lg font-medium text-gray-900">${{ number_format($total, 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6">
                            <a href="{{ route('checkout') }}"
                               class="w-full bg-indigo-600 text-white py-3 px-4 rounded-lg hover:bg-indigo-700 transition-colors duration-200 font-medium text-center block">
                                Proceed to Checkout
                            </a>
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('products') }}"
                               class="w-full bg-gray-100 text-gray-900 py-3 px-4 rounded-lg hover:bg-gray-200 transition-colors duration-200 font-medium text-center block">
                                Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty Cart -->
            <div class="text-center py-12">
                <svg class="w-24 h-24 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5 6m0 0h9M17 21a2 2 0 100-4 2 2 0 000 4zM9 21a2 2 0 100-4 2 2 0 000 4z"></path>
                </svg>
                <h3 class="text-2xl font-medium text-gray-900 mb-2">Your cart is empty</h3>
                <p class="text-gray-600 mb-6">Start shopping to add items to your cart.</p>
                <a href="{{ route('products') }}"
                   class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition-colors duration-200 font-medium">
                    Start Shopping
                </a>
            </div>
        @endif
    </div>
</div>
