<div
    class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-500 border border-gray-100">
    <!-- Product Image -->
    <div class="relative overflow-hidden">
        <a href="{{ route('product.detail', $product->slug) }}">
            @if($product->getFirstMediaUrl('gallery'))
                <img src="{{ $product->getFirstMediaUrl('gallery') }}" alt="{{ $product->name['en'] ?? 'Product Image' }}"
                    class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-700">
            @else
                <div
                    class="w-full h-64 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center group-hover:from-gray-200 group-hover:to-gray-300 transition-all duration-500">
                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
            @endif
        </a>

        <!-- Overlay with quick actions -->
        <div
            class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 flex items-center justify-center">
            <div
                class="opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300">
                <button wire:click="addToCart"
                    class="px-6 py-3 bg-white text-gray-900 rounded-xl font-semibold hover:bg-gray-100 transform hover:scale-105 transition-all duration-200 shadow-lg">
                    Quick Add
                </button>
            </div>
        </div>

        <!-- Wishlist Button -->
        <button wire:click="addToWishlist"
            class="absolute top-4 right-4 p-3 bg-white bg-opacity-90 backdrop-blur-sm rounded-full shadow-lg hover:bg-white hover:scale-110 transition-all duration-200 group">
            <svg class="w-5 h-5 text-gray-600 group-hover:text-red-500" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                </path>
            </svg>
        </button>

        <!-- Discount Badge -->
        @if($product->discount > 0)
            <div
                class="absolute top-4 left-4 gradient-secondary text-white px-3 py-1 rounded-full text-sm font-bold shadow-lg">
                -{{ number_format((($product->discount / $product->price) * 100), 0) }}%
            </div>
        @endif

        <!-- New Badge -->
        @if($product->created_at->diffInDays() < 7)
            <div
                class="absolute bottom-4 left-4 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                NEW
            </div>
        @endif
    </div>

    <!-- Product Info -->
    <div class="p-6">
        <a href="{{ route('product.detail', $product->slug) }}">
            <h3
                class="text-xl font-semibold text-gray-900 mb-3 hover:text-indigo-600 transition-colors duration-200 line-clamp-2">
                {{ $product->name['en'] ?? 'Product Name' }}
            </h3>
        </a>

        <p class="text-gray-600 text-sm mb-4 line-clamp-2 leading-relaxed">
            {{ $product->about['en'] ?? 'Premium quality product with exceptional features and design.' }}
        </p>

        <!-- Rating (placeholder) -->
        <div class="flex items-center mb-4">
            <div class="flex items-center">
                @for($i = 1; $i <= 5; $i++)
                    <svg class="w-4 h-4 {{ $i <= 4 ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                        </path>
                    </svg>
                @endfor
            </div>
            <span class="text-sm text-gray-500 ml-2">(4.0)</span>
        </div>

        <!-- Price -->
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center space-x-3">
                @if($product->discount > 0)
                    <span class="text-2xl font-bold text-gray-900">
                        ${{ number_format($product->price - $product->discount, 2) }}
                    </span>
                    <span class="text-lg text-gray-500 line-through">
                        ${{ number_format($product->price, 2) }}
                    </span>
                @else
                    <span class="text-2xl font-bold text-gray-900">
                        ${{ number_format($product->price, 2) }}
                    </span>
                @endif
            </div>

            <!-- Stock status -->
            <div class="flex items-center">
                <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                <span class="text-sm text-green-600 font-medium">In Stock</span>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-3">
            <button wire:click="addToCart"
                class="flex-1 gradient-primary text-white py-3 px-4 rounded-xl font-semibold hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                Add to Cart
            </button>

            <button wire:click="addToWishlist"
                class="p-3 border-2 border-gray-200 rounded-xl hover:border-red-300 hover:bg-red-50 transition-all duration-200 group">
                <svg class="w-5 h-5 text-gray-600 group-hover:text-red-500" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                    </path>
                </svg>
            </button>
        </div>
    </div>
</div>