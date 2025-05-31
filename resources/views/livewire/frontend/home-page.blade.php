<div>
    <!-- Hero Section -->
    <section class="relative overflow-hidden">
        <!-- Background with gradient overlay -->
        <div class="absolute inset-0 gradient-primary"></div>
        <div class="absolute inset-0 bg-black opacity-20"></div>

        <!-- Decorative elements -->
        <div class="absolute top-0 left-0 w-full h-full">
            <div class="absolute top-20 left-10 w-72 h-72 bg-white opacity-10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-white opacity-5 rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left content -->
                <div class="text-white">
                    <div
                        class="inline-flex items-center px-4 py-2 bg-white bg-opacity-20 rounded-full text-sm font-medium mb-6">
                        <span class="w-2 h-2 bg-green-400 rounded-full mr-2"></span>
                        New Collection Available
                    </div>

                    <h1 class="text-5xl lg:text-7xl font-display font-bold mb-6 leading-tight">
                        Premium
                        <span
                            class="block text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-orange-500">
                            Shopping
                        </span>
                        Experience
                    </h1>

                    <p class="text-xl lg:text-2xl mb-8 text-gray-100 leading-relaxed">
                        Discover curated collections of premium products with exceptional quality and unmatched style.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('products') }}"
                            class="inline-flex items-center justify-center px-8 py-4 bg-white text-gray-900 rounded-xl font-semibold hover:bg-gray-100 transform hover:-translate-y-1 transition-all duration-300 shadow-xl">
                            <span>Explore Collection</span>
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>

                        <button
                            class="inline-flex items-center justify-center px-8 py-4 border-2 border-white text-white rounded-xl font-semibold hover:bg-white hover:text-gray-900 transition-all duration-300">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Watch Video
                        </button>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-8 mt-12 pt-8 border-t border-white border-opacity-20">
                        <div>
                            <div class="text-3xl font-bold">10K+</div>
                            <div class="text-gray-300 text-sm">Happy Customers</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold">500+</div>
                            <div class="text-gray-300 text-sm">Premium Products</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold">24/7</div>
                            <div class="text-gray-300 text-sm">Customer Support</div>
                        </div>
                    </div>
                </div>

                <!-- Right content - Product showcase -->
                <div class="relative">
                    <div class="relative z-10">
                        <!-- Main product card -->
                        <div
                            class="bg-white rounded-3xl p-8 shadow-2xl transform rotate-3 hover:rotate-0 transition-transform duration-500">
                            <div
                                class="w-full h-64 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl mb-6 flex items-center justify-center">
                                <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Featured Product</h3>
                            <p class="text-gray-600 mb-4">Premium quality guaranteed</p>
                            <div class="flex items-center justify-between">
                                <span class="text-2xl font-bold text-indigo-600">$199.99</span>
                                <button
                                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                                    Add to Cart
                                </button>
                            </div>
                        </div>

                        <!-- Floating elements -->
                        <div
                            class="absolute -top-4 -right-4 w-20 h-20 bg-yellow-400 rounded-full flex items-center justify-center shadow-lg">
                            <span class="text-sm font-bold text-gray-900">NEW</span>
                        </div>

                        <div
                            class="absolute -bottom-4 -left-4 w-16 h-16 bg-green-500 rounded-full flex items-center justify-center shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center group">
                    <div
                        class="w-16 h-16 gradient-primary rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Free Shipping</h3>
                    <p class="text-gray-600">Free shipping on all orders over $50. Fast and reliable delivery worldwide.
                    </p>
                </div>

                <div class="text-center group">
                    <div
                        class="w-16 h-16 gradient-secondary rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Quality Guarantee</h3>
                    <p class="text-gray-600">Premium quality products with 30-day money-back guarantee.</p>
                </div>

                <div class="text-center group">
                    <div
                        class="w-16 h-16 gradient-accent rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">24/7 Support</h3>
                    <p class="text-gray-600">Round-the-clock customer support for all your needs.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    @if($featuredProducts->count() > 0)
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <div
                        class="inline-flex items-center px-4 py-2 bg-indigo-100 text-indigo-800 rounded-full text-sm font-medium mb-4">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                            </path>
                        </svg>
                        Trending Now
                    </div>
                    <h2 class="text-4xl lg:text-5xl font-display font-bold text-gray-900 mb-6">Featured Products</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">Discover our handpicked selection of premium products
                        that our customers love most</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($featuredProducts as $product)
                        <livewire:frontend.components.product-card :product="$product" :key="'featured-' . $product->id" />
                    @endforeach
                </div>

                <div class="text-center mt-12">
                    <a href="{{ route('products') }}"
                        class="inline-flex items-center px-8 py-4 gradient-primary text-white rounded-xl font-semibold hover:shadow-lg transform hover:-translate-y-1 transition-all duration-300">
                        View All Products
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </section>
    @endif

    <!-- New Products -->
    @if($newProducts->count() > 0)
        <section class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <div
                        class="inline-flex items-center px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-medium mb-4">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.293l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Just Arrived
                    </div>
                    <h2 class="text-4xl lg:text-5xl font-display font-bold text-gray-900 mb-6">New Arrivals</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">Be the first to discover our latest collection of
                        premium products</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($newProducts as $product)
                        <livewire:frontend.components.product-card :product="$product" :key="'new-' . $product->id" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Newsletter Section -->
    <section class="py-20 gradient-primary">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center text-white">
                <h2 class="text-4xl lg:text-5xl font-display font-bold mb-6">Stay Updated</h2>
                <p class="text-xl text-gray-100 mb-8 max-w-2xl mx-auto">Subscribe to our newsletter and be the first to
                    know about new products, exclusive offers, and special promotions.</p>

                <div class="max-w-md mx-auto">
                    <div class="flex flex-col sm:flex-row gap-4">
                        <input type="email" placeholder="Enter your email address"
                            class="flex-1 px-6 py-4 rounded-xl text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-4 focus:ring-white focus:ring-opacity-30">
                        <button
                            class="px-8 py-4 bg-white text-gray-900 rounded-xl font-semibold hover:bg-gray-100 transform hover:-translate-y-1 transition-all duration-300 shadow-xl">
                            Subscribe
                        </button>
                    </div>
                    <p class="text-sm text-gray-200 mt-4">No spam, unsubscribe at any time.</p>
                </div>
            </div>
        </div>
    </section>
</div>