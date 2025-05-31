<?php

namespace App\Livewire\Frontend\Components;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class WishlistCounter extends Component
{
    public $wishlistCount = 0;

    protected $listeners = ['add-to-wishlist' => 'updateWishlistCount'];

    public function mount()
    {
        $this->updateWishlistCount();
    }

    public function updateWishlistCount()
    {
        if (auth('account')->check()) {
            $this->wishlistCount = DB::table('wishlists')
                ->where('account_id', auth('account')->id())
                ->count();
        } else {
            $this->wishlistCount = 0;
        }
    }

    public function render()
    {
        return view('livewire.frontend.components.wishlist-counter');
    }
}
