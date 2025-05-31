<div>
    @if($wishlistCount > 0)
        <span
            class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
            {{ $wishlistCount > 99 ? '99+' : $wishlistCount }}
        </span>
    @endif
</div>