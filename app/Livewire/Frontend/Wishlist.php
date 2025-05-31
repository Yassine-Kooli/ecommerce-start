<?php

namespace App\Livewire\Frontend;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use TomatoPHP\FilamentEcommerce\Models\Product;

#[Layout('components.layouts.app')]
class Wishlist extends Component
{
    use WithPagination;

    protected $listeners = ['add-to-wishlist' => 'toggleWishlist'];

    public function toggleWishlist($productId)
    {
        if (! auth('account')->check()) {
            $this->dispatch('notify', message: 'Please login to add items to wishlist!', type: 'error');

            return;
        }

        $userId = auth('account')->id();

        // Check if item exists in wishlist
        $exists = DB::table('wishlists')
            ->where('account_id', $userId)
            ->where('product_id', $productId)
            ->exists();

        if ($exists) {
            // Remove from wishlist
            DB::table('wishlists')
                ->where('account_id', $userId)
                ->where('product_id', $productId)
                ->delete();

            $this->dispatch('notify', message: 'Product removed from wishlist!', type: 'success');
        } else {
            // Add to wishlist
            DB::table('wishlists')->insert([
                'account_id' => $userId,
                'product_id' => $productId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $this->dispatch('notify', message: 'Product added to wishlist!', type: 'success');
        }

        $this->dispatch('add-to-wishlist'); // Update counter
    }

    public function removeFromWishlist($productId)
    {
        DB::table('wishlists')
            ->where('account_id', auth('account')->id())
            ->where('product_id', $productId)
            ->delete();

        $this->dispatch('notify', message: 'Product removed from wishlist!', type: 'success');
        $this->dispatch('add-to-wishlist'); // Update counter
    }

    public function addToCart($productId)
    {
        $this->dispatch('add-to-cart', productId: $productId);
    }

    public function render()
    {
        $wishlistItems = collect();

        if (auth('account')->check()) {
            $productIds = DB::table('wishlists')
                ->where('account_id', auth('account')->id())
                ->pluck('product_id');

            $wishlistItems = Product::whereIn('id', $productIds)
                ->where('is_activated', true)
                ->paginate(12);
        }

        return view('livewire.frontend.wishlist', [
            'wishlistItems' => $wishlistItems,
        ]);
    }
}
