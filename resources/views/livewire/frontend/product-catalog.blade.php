<div>
    <!-- Page Header -->
    <div class="bg-gray-100 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900">Products</h1>
            <p class="text-gray-600 mt-2">Discover our amazing collection</p>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Search -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search products..."
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- Price Range -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Min Price</label>
                    <input type="number" wire:model.live.debounce.500ms="priceMin" placeholder="$0"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Max Price</label>
                    <input type="number" wire:model.live.debounce.500ms="priceMax" placeholder="$1000"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- Sort -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sort By</label>
                    <select wire:model.live="sortBy"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="latest">Latest</option>
                        <option value="oldest">Oldest</option>
                        <option value="price_low">Price: Low to High</option>
                        <option value="price_high">Price: High to Low</option>
                        <option value="name">Name A-Z</option>
                    </select>
                </div>
            </div>

            <!-- Clear Filters -->
            <div class="mt-4 flex justify-between items-center">
                <button wire:click="clearFilters" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                    Clear All Filters
                </button>

                <div class="text-sm text-gray-600">
                    Showing {{ $products->count() }} of {{ $products->total() }} products
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                @foreach($products as $product)
                    <livewire:frontend.components.product-card :product="$product" :key="'catalog-' . $product->id" />
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $products->links() }}
            </div>
        @else
            <!-- No Products Found -->
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2M4 13h2m13-4h-2m-5-4v2m0 0V5a1 1 0 011-1h1a1 1 0 011 1v1M9 7h6">
                    </path>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No products found</h3>
                <p class="text-gray-600 mb-4">Try adjusting your search criteria or clear the filters.</p>
                <button wire:click="clearFilters"
                    class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors duration-200">
                    Clear Filters
                </button>
            </div>
        @endif
    </div>
</div>