<div class="relative group">
    <form wire:submit.prevent="performSearch">
        <div class="relative">
            <input type="text" wire:model="search" placeholder="Search for products..."
                class="w-80 pl-12 pr-12 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent focus:bg-white transition-all duration-300 text-gray-900 placeholder-gray-500">

            <!-- Search Icon -->
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors duration-200"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>

            <!-- Search Button -->
            <button type="submit" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                <div
                    class="p-2 gradient-primary rounded-lg hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                    <svg class="h-4 w-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </div>
            </button>
        </div>
    </form>

    <!-- Search suggestions (placeholder for future enhancement) -->
    @if($search && strlen($search) > 2)
        <div
            class="absolute top-full left-0 right-0 mt-2 bg-white rounded-xl shadow-lg border border-gray-100 z-50 opacity-0 invisible group-focus-within:opacity-100 group-focus-within:visible transition-all duration-300">
            <div class="p-4">
                <div class="text-sm text-gray-500 mb-2">Popular searches</div>
                <div class="space-y-2">
                    <div class="flex items-center p-2 hover:bg-gray-50 rounded-lg cursor-pointer">
                        <svg class="w-4 h-4 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <span class="text-sm text-gray-700">{{ $search }}</span>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>