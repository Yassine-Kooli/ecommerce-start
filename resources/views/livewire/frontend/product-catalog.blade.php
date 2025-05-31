<div>
    <!-- Page Header -->
    <div class="relative bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 py-20">
        <!-- Background decoration -->
        <div class="absolute inset-0">
            <div class="absolute top-10 left-10 w-32 h-32 bg-indigo-500 opacity-20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 right-10 w-40 h-40 bg-purple-500 opacity-20 rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div
                class="inline-flex items-center px-4 py-2 bg-white bg-opacity-10 backdrop-blur-sm rounded-full text-white text-sm font-medium mb-6">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z">
                    </path>
                </svg>
                Premium Collection
            </div>

            <h1 class="text-5xl lg:text-6xl font-display font-bold text-white mb-6">
                Our Products
            </h1>
            <p class="text-xl text-gray-300 max-w-3xl mx-auto leading-relaxed">
                Discover our carefully curated collection of premium products designed to elevate your lifestyle
            </p>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8 mb-12">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-semibold text-gray-900">Filter & Search</h2>
                <button wire:click="clearFilters"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-indigo-600 hover:text-indigo-800 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                        </path>
                    </svg>
                    Clear All Filters
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Search -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-3">Search Products</label>
                    <div class="relative">
                        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search products..."
                            class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Price Range -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-3">Min Price</label>
                    <div class="relative">
                        <input type="number" wire:model.live.debounce.500ms="priceMin" placeholder="0"
                            class="w-full pl-8 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 text-sm">$</span>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-3">Max Price</label>
                    <div class="relative">
                        <input type="number" wire:model.live.debounce.500ms="priceMax" placeholder="1000"
                            class="w-full pl-8 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 text-sm">$</span>
                        </div>
                    </div>
                </div>

                <!-- Sort -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-3">Sort By</label>
                    <select wire:model.live="sortBy"
                        class="w-full py-3 px-4 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 bg-white">
                        <option value="latest">Latest First</option>
                        <option value="oldest">Oldest First</option>
                        <option value="price_low">Price: Low to High</option>
                        <option value="price_high">Price: High to Low</option>
                        <option value="name">Name A-Z</option>
                    </select>
                </div>
            </div>

            <!-- Results Summary -->
            <div class="mt-8 pt-6 border-t border-gray-200 flex flex-col sm:flex-row justify-between items-center">
                <div class="text-gray-600 mb-4 sm:mb-0">
                    <span class="font-medium text-gray-900">{{ $products->total() }}</span> products found
                    @if($search || $priceMin || $priceMax)
                        <span class="ml-2 text-sm">with current filters</span>
                    @endif
                </div>

                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-500">Showing {{ $products->count() }} of
                        {{ $products->total() }}</span>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 mb-12">
                @foreach($products as $product)
                    <livewire:frontend.components.product-card :product="$product" :key="'catalog-' . $product->id" />
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="flex justify-center">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                    {{ $products->links() }}
                </div>
            </div>
        @else
            <!-- No Products Found -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 text-center py-20">
                <div class="max-w-md mx-auto">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-8">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2M4 13h2m13-4h-2m-5-4v2m0 0V5a1 1 0 011-1h1a1 1 0 011 1v1M9 7h6">
                            </path>
                        </svg>
                    </div>

                    <h3 class="text-2xl font-semibold text-gray-900 mb-4">No products found</h3>
                    <p class="text-gray-600 mb-8 leading-relaxed">
                        We couldn't find any products matching your criteria. Try adjusting your search terms or clearing
                        the filters to see more results.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <button wire:click="clearFilters"
                            class="gradient-primary text-white px-8 py-3 rounded-xl font-semibold hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                            Clear All Filters
                        </button>

                        <a href="{{ route('home') }}"
                            class="border-2 border-gray-200 text-gray-700 px-8 py-3 rounded-xl font-semibold hover:border-gray-300 hover:bg-gray-50 transition-all duration-200">
                            Browse All Products
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>