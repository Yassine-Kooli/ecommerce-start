<div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
    <!-- Product Image -->
    <div class="relative">
        <a href="{{ route('product.detail', $product->slug) }}">
            @if($product->getFirstMediaUrl('gallery'))
                <img src="{{ $product->getFirstMediaUrl('gallery') }}" alt="{{ $product->name['en'] ?? 'Product Image' }}"
                    class="w-full h-48 object-cover">
            @else
                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
            @endif
        </a>

        <!-- Wishlist Button -->
        <button wire:click="addToWishlist"
            class="absolute top-2 right-2 p-2 bg-white rounded-full shadow-md hover:bg-gray-50 transition-colors duration-200">
            <svg class="w-5 h-5 text-gray-600 hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                </path>
            </svg>
        </button>

        <!-- Discount Badge -->
        @if($product->discount > 0)
            <div class="absolute top-2 left-2 bg-red-500 text-white px-2 py-1 rounded text-sm font-semibold">
                -{{ number_format((($product->discount / $product->price) * 100), 0) }}%
            </div>
        @endif
    </div>

    <!-- Product Info -->
    <div class="p-4">
        <a href="{{ route('product.detail', $product->slug) }}">
            <h3 class="text-lg font-semibold text-gray-900 mb-2 hover:text-indigo-600 transition-colors duration-200">
                {{ $product->name['en'] ?? 'Product Name' }}
            </h3>
        </a>

        <p class="text-gray-600 text-sm mb-3 line-clamp-2">
            {{ $product->about['en'] ?? 'Product description' }}
        </p>

        <!-- Price -->
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center space-x-2">
                @if($product->discount > 0)
                    <span class="text-lg font-bold text-indigo-600">
                        ${{ number_format($product->price - $product->discount, 2) }}
                    </span>
                    <span class="text-sm text-gray-500 line-through">
                        ${{ number_format($product->price, 2) }}
                    </span>
                @else
                    <span class="text-lg font-bold text-indigo-600">
                        ${{ number_format($product->price, 2) }}
                    </span>
                @endif
            </div>
        </div>

        <!-- Add to Cart Button -->
        <button wire:click="addToCart"
            class="w-full bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 transition-colors duration-200 font-medium">
            Add to Cart
        </button>
    </div>
</div>