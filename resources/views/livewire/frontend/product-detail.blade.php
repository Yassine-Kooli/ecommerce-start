<div>
    <!-- Breadcrumb -->
    <div class="bg-gray-100 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-4">
                    <li>
                        <a href="{{ route('home') }}" class="text-gray-500 hover:text-gray-700">Home</a>
                    </li>
                    <li>
                        <svg class="flex-shrink-0 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </li>
                    <li>
                        <a href="{{ route('products') }}" class="text-gray-500 hover:text-gray-700">Products</a>
                    </li>
                    <li>
                        <svg class="flex-shrink-0 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </li>
                    <li>
                        <span class="text-gray-900 font-medium">{{ $product->name['en'] ?? 'Product' }}</span>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Product Detail -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Product Images -->
            <div>
                <!-- Main Image -->
                <div class="aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden mb-4">
                    @if($product->getMedia('gallery')->count() > 0)
                        <img src="{{ $product->getMedia('gallery')[$selectedImage]->getUrl() ?? $product->getFirstMediaUrl('gallery') }}"
                            alt="{{ $product->name['en'] ?? 'Product Image' }}" class="w-full h-96 object-cover">
                    @else
                        <div class="w-full h-96 bg-gray-200 flex items-center justify-center">
                            <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                    @endif
                </div>

                <!-- Thumbnail Images -->
                @if($product->getMedia('gallery')->count() > 1)
                    <div class="grid grid-cols-4 gap-2">
                        @foreach($product->getMedia('gallery') as $index => $media)
                            <button wire:click="selectImage({{ $index }})"
                                class="aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden {{ $selectedImage == $index ? 'ring-2 ring-indigo-500' : '' }}">
                                <img src="{{ $media->getUrl() }}" alt="Product thumbnail" class="w-full h-20 object-cover">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Product Info -->
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-4">
                    {{ $product->name['en'] ?? 'Product Name' }}
                </h1>

                <!-- Price -->
                <div class="flex items-center space-x-4 mb-6">
                    @if($product->discount > 0)
                        <span class="text-3xl font-bold text-indigo-600">
                            ${{ number_format($product->price - $product->discount, 2) }}
                        </span>
                        <span class="text-xl text-gray-500 line-through">
                            ${{ number_format($product->price, 2) }}
                        </span>
                        <span class="bg-red-100 text-red-800 text-sm font-medium px-2.5 py-0.5 rounded">
                            Save ${{ number_format($product->discount, 2) }}
                        </span>
                    @else
                        <span class="text-3xl font-bold text-indigo-600">
                            ${{ number_format($product->price, 2) }}
                        </span>
                    @endif
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Description</h3>
                    <p class="text-gray-600">
                        {{ $product->about['en'] ?? 'Product description' }}
                    </p>
                </div>

                @if($product->description && isset($product->description['en']))
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Details</h3>
                        <div class="text-gray-600">
                            {!! nl2br(e($product->description['en'])) !!}
                        </div>
                    </div>
                @endif

                <!-- Quantity and Add to Cart -->
                <div class="mb-6">
                    <div class="flex items-center space-x-4 mb-4">
                        <label class="text-sm font-medium text-gray-900">Quantity:</label>
                        <div class="flex items-center border border-gray-300 rounded-lg">
                            <button wire:click="decrementQuantity" class="px-3 py-2 text-gray-600 hover:text-gray-800">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4">
                                    </path>
                                </svg>
                            </button>
                            <span class="px-4 py-2 text-gray-900 font-medium">{{ $quantity }}</span>
                            <button wire:click="incrementQuantity" class="px-3 py-2 text-gray-600 hover:text-gray-800">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex space-x-4">
                        <button wire:click="addToCart"
                            class="flex-1 bg-indigo-600 text-white py-3 px-6 rounded-lg hover:bg-indigo-700 transition-colors duration-200 font-medium">
                            Add to Cart
                        </button>
                        <button wire:click="addToWishlist"
                            class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="border-t pt-6">
                    <dl class="space-y-4">
                        @if($product->sku)
                            <div class="flex">
                                <dt class="text-sm font-medium text-gray-900 w-24">SKU:</dt>
                                <dd class="text-sm text-gray-600">{{ $product->sku }}</dd>
                            </div>
                        @endif
                        @if($product->barcode)
                            <div class="flex">
                                <dt class="text-sm font-medium text-gray-900 w-24">Barcode:</dt>
                                <dd class="text-sm text-gray-600">{{ $product->barcode }}</dd>
                            </div>
                        @endif
                        <div class="flex">
                            <dt class="text-sm font-medium text-gray-900 w-24">Status:</dt>
                            <dd class="text-sm text-gray-600">
                                @if($product->is_in_stock)
                                    <span class="text-green-600">In Stock</span>
                                @else
                                    <span class="text-red-600">Out of Stock</span>
                                @endif
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
            <div class="mt-16">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">Related Products</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $relatedProduct)
                        <livewire:frontend.components.product-card :product="$relatedProduct"
                            :key="'related-' . $relatedProduct->id" />
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>