<div>
    @if($cartCount > 0)
        <span
            class="absolute -top-2 -right-2 gradient-secondary text-white text-xs rounded-full h-6 w-6 flex items-center justify-center font-bold shadow-lg animate-pulse">
            {{ $cartCount > 99 ? '99+' : $cartCount }}
        </span>
    @endif
</div>