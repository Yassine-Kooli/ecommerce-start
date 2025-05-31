<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900">My Wishlist</h1>
            <p class="mt-2 text-gray-600">Items you've saved for later</p>
        </div>

        @auth('account')
            @if($wishlistItems && $wishlistItems->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($wishlistItems as $product)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden group">
                            <div class="relative">
                                @if($product->getFirstMediaUrl('gallery'))
                                    <img src="{{ $product->getFirstMediaUrl('gallery') }}" alt="{{ $product->name['en'] ?? 'Product' }}"
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

                                <!-- Remove from wishlist button -->
                                <button wire:click="removeFromWishlist({{ $product->id }})"
                                    class="absolute top-2 right-2 p-2 bg-white rounded-full shadow-md hover:bg-red-50 transition-colors">
                                    <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>

                            <div class="p-4">
                                <h3 class="text-lg font-medium text-gray-900 mb-2">
                                    <a href="{{ route('product.detail', $product->slug) }}" class="hover:text-indigo-600">
                                        {{ $product->name['en'] ?? 'Product' }}
                                    </a>
                                </h3>

                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center space-x-2">
                                        @if($product->discount && $product->discount > 0)
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

                                <div class="flex space-x-2">
                                    <button wire:click="addToCart({{ $product->id }})"
                                        class="flex-1 bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition-colors text-sm font-medium">
                                        Add to Cart
                                    </button>
                                    <a href="{{ route('product.detail', $product->slug) }}"
                                        class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition-colors text-sm font-medium">
                                        View
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($wishlistItems->hasPages())
                    <div class="mt-8">
                        {{ $wishlistItems->links() }}
                    </div>
                @endif
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Your wishlist is empty</h3>
                    <p class="mt-1 text-sm text-gray-500">Start adding products you love to your wishlist.</p>
                    <div class="mt-6">
                        <a href="{{ route('products') }}"
                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Browse Products
                        </a>
                    </div>
                </div>
            @endif
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Please login to view your wishlist</h3>
                <p class="mt-1 text-sm text-gray-500">You need to be logged in to save and view your favorite products.</p>
                <div class="mt-6">
                    <livewire:frontend.components.auth-modal />
                </div>
            </div>
        @endauth
    </div>
</div>