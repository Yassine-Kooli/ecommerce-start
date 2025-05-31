<div x-data="{ open: @entangle('isOpen') }" x-show="open" x-transition class="md:hidden">
    <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white border-t">
        <a href="{{ route('home') }}" class="block px-3 py-2 text-base font-medium text-gray-900 hover:text-indigo-600">
            Home
        </a>
        <a href="{{ route('products') }}"
            class="block px-3 py-2 text-base font-medium text-gray-900 hover:text-indigo-600">
            Products
        </a>
        <a href="{{ route('cart') }}" class="block px-3 py-2 text-base font-medium text-gray-900 hover:text-indigo-600">
            Cart
        </a>
        <a href="{{ route('wishlist') }}"
            class="block px-3 py-2 text-base font-medium text-gray-900 hover:text-indigo-600">
            Wishlist
        </a>

        <!-- Search on mobile -->
        <div class="px-3 py-2">
            <livewire:frontend.components.search-bar />
        </div>

        @guest('account')
            <a href="{{ route('login') }}"
                class="block px-3 py-2 text-base font-medium text-gray-900 hover:text-indigo-600">
                Login
            </a>
            <a href="{{ route('register') }}"
                class="block px-3 py-2 text-base font-medium text-gray-900 hover:text-indigo-600">
                Register
            </a>
        @else
            <a href="{{ route('account.dashboard') }}"
                class="block px-3 py-2 text-base font-medium text-gray-900 hover:text-indigo-600">
                Dashboard
            </a>
            <a href="{{ route('account.orders') }}"
                class="block px-3 py-2 text-base font-medium text-gray-900 hover:text-indigo-600">
                Orders
            </a>
            <a href="{{ route('account.profile') }}"
                class="block px-3 py-2 text-base font-medium text-gray-900 hover:text-indigo-600">
                Profile
            </a>
            <form method="POST" action="{{ route('logout') }}" class="px-3 py-2">
                @csrf
                <button type="submit"
                    class="block w-full text-left text-base font-medium text-gray-900 hover:text-indigo-600">
                    Logout
                </button>
            </form>
        @endguest
    </div>
</div>