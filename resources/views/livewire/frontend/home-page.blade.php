<div>
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">
                    Welcome to EcomStore
                </h1>
                <p class="text-xl md:text-2xl mb-8 text-indigo-100">
                    Discover amazing products at unbeatable prices
                </p>
                <a href="{{ route('products') }}"
                    class="bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                    Shop Now
                </a>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    @if($featuredProducts->count() > 0)
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Featured Products</h2>
                    <p class="text-gray-600">Check out our trending products</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($featuredProducts as $product)
                        <livewire:frontend.components.product-card :product="$product" :key="'featured-' . $product->id" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- New Products -->
    @if($newProducts->count() > 0)
        <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">New Arrivals</h2>
                    <p class="text-gray-600">Latest products just for you</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($newProducts as $product)
                        <livewire:frontend.components.product-card :product="$product" :key="'new-' . $product->id" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</div>