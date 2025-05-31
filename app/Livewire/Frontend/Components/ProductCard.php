<?php

namespace App\Livewire\Frontend\Components;

use Livewire\Component;
use TomatoPHP\FilamentEcommerce\Models\Product;

class ProductCard extends Component
{
    public Product $product;

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function addToCart()
    {
        $this->dispatch('add-to-cart', productId: $this->product->id);
        $this->dispatch('notify', message: 'Product added to cart!', type: 'success');
    }

    public function addToWishlist()
    {
        $this->dispatch('add-to-wishlist', productId: $this->product->id);
        $this->dispatch('notify', message: 'Product added to wishlist!', type: 'success');
    }

    public function render()
    {
        return view('livewire.frontend.components.product-card');
    }
}
