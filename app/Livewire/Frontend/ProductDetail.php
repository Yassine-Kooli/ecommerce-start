<?php

namespace App\Livewire\Frontend;

use Livewire\Attributes\Layout;
use Livewire\Component;
use TomatoPHP\FilamentEcommerce\Models\Product;

#[Layout('components.layouts.app')]
class ProductDetail extends Component
{
    public $slug;

    public $product;

    public $quantity = 1;

    public $selectedImage = 0;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->product = Product::where('slug', $slug)
            ->where('is_activated', true)
            ->firstOrFail();
    }

    public function incrementQuantity()
    {
        $this->quantity++;
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart()
    {
        $this->dispatch('add-to-cart', productId: $this->product->id, quantity: $this->quantity);
        $this->dispatch('notify', message: 'Product added to cart!', type: 'success');
    }

    public function addToWishlist()
    {
        $this->dispatch('add-to-wishlist', productId: $this->product->id);
        $this->dispatch('notify', message: 'Product added to wishlist!', type: 'success');
    }

    public function selectImage($index)
    {
        $this->selectedImage = $index;
    }

    public function render()
    {
        $relatedProducts = Product::where('is_activated', true)
            ->where('id', '!=', $this->product->id)
            ->take(4)
            ->get();

        return view('livewire.frontend.product-detail', [
            'relatedProducts' => $relatedProducts,
        ]);
    }
}
