<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Checkout</h1>
            <p class="mt-2 text-gray-600">Complete your order</p>
        </div>

        @if($cartItems && $cartItems->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Checkout Form -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Shipping Address -->
                    <div class="bg-white shadow rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Shipping Address</h3>
                        <div>
                            <label for="shipping_address" class="block text-sm font-medium text-gray-700">Address</label>
                            <textarea wire:model="shipping_address" id="shipping_address" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('shipping_address') border-red-300 @enderror"
                                placeholder="Enter your full shipping address"></textarea>
                            @error('shipping_address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Billing Address -->
                    <div class="bg-white shadow rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Billing Address</h3>

                        <div class="mb-4">
                            <label class="flex items-center">
                                <input type="checkbox" wire:model.live="same_as_shipping"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <span class="ml-2 text-sm text-gray-700">Same as shipping address</span>
                            </label>
                        </div>

                        @if(!$same_as_shipping)
                            <div>
                                <label for="billing_address" class="block text-sm font-medium text-gray-700">Address</label>
                                <textarea wire:model="billing_address" id="billing_address" rows="3"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('billing_address') border-red-300 @enderror"
                                    placeholder="Enter your billing address"></textarea>
                                @error('billing_address')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        @endif
                    </div>

                    <!-- Payment Method -->
                    <div class="bg-white shadow rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Payment Method</h3>
                        <div class="space-y-3">
                            <label class="flex items-center">
                                <input type="radio" wire:model="payment_method" value="cash_on_delivery"
                                    class="text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                <span class="ml-2 text-sm text-gray-700">Cash on Delivery</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" wire:model="payment_method" value="bank_transfer"
                                    class="text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                <span class="ml-2 text-sm text-gray-700">Bank Transfer</span>
                            </label>
                        </div>
                        @error('payment_method')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Order Notes -->
                    <div class="bg-white shadow rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Order Notes (Optional)</h3>
                        <div>
                            <textarea wire:model="notes" rows="3"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Any special instructions for your order..."></textarea>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white shadow rounded-lg p-6 sticky top-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Order Summary</h3>

                        <div class="space-y-3 mb-4">
                            @foreach($cartItems as $item)
                                <div class="flex justify-between text-sm">
                                    <div class="flex-1">
                                        <p class="text-gray-900">{{ $item->item }}</p>
                                        <p class="text-gray-500">Qty: {{ $item->qty }}</p>
                                    </div>
                                    <p class="text-gray-900">${{ number_format($item->total, 2) }}</p>
                                </div>
                            @endforeach
                        </div>

                        <div class="border-t border-gray-200 pt-4">
                            <div class="flex justify-between text-base font-medium text-gray-900">
                                <p>Total</p>
                                <p>${{ number_format($total, 2) }}</p>
                            </div>
                        </div>

                        <button wire:click="placeOrder"
                            class="w-full mt-6 bg-indigo-600 border border-transparent rounded-md shadow-sm py-3 px-4 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Place Order
                        </button>

                        <div class="mt-4 text-center">
                            <a href="{{ route('cart') }}" class="text-sm text-indigo-600 hover:text-indigo-500">
                                ← Back to Cart
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5 6m0 0h9M17 21a2 2 0 100-4 2 2 0 000 4zM9 21a2 2 0 100-4 2 2 0 000 4z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Your cart is empty</h3>
                <p class="mt-1 text-sm text-gray-500">Add some products to your cart before checking out.</p>
                <div class="mt-6">
                    <a href="{{ route('products') }}"
                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Continue Shopping
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>