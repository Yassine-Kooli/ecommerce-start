<?php

namespace App\Livewire\Frontend\Components;

use Livewire\Component;
use TomatoPHP\FilamentEcommerce\Models\Cart;

class CartCounter extends Component
{
    public $cartCount = 0;

    protected $listeners = ['add-to-cart' => 'updateCartCount'];

    public function mount()
    {
        $this->updateCartCount();
    }

    public function updateCartCount()
    {
        // Get cart count from session or authenticated user
        if (auth('account')->check()) {
            $this->cartCount = Cart::where('account_id', auth('account')->id())->sum('qty');
        } else {
            $this->cartCount = Cart::where('session_id', session()->getId())->sum('qty');
        }
    }

    public function render()
    {
        return view('livewire.frontend.components.cart-counter');
    }
}
