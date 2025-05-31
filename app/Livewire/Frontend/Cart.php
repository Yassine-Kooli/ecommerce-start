<?php

namespace App\Livewire\Frontend;

use Livewire\Attributes\Layout;
use Livewire\Component;
use TomatoPHP\FilamentEcommerce\Models\Cart as CartModel;

#[Layout('components.layouts.app')]
class Cart extends Component
{
    protected $listeners = ['cart-updated' => 'updateCartCount'];

    public function updateCartCount()
    {
        // This method will trigger cart counter updates when called
    }

    public function updateQuantity($cartId, $quantity)
    {
        $cartItem = CartModel::find($cartId);
        if ($cartItem && $quantity > 0) {
            $cartItem->update([
                'qty' => $quantity,
                'total' => ($cartItem->price - $cartItem->discount) * $quantity,
            ]);
            $this->dispatch('cart-updated');
        }
    }

    public function removeItem($cartId)
    {
        CartModel::find($cartId)?->delete();
        $this->dispatch('cart-updated');
    }

    public function clearCart()
    {
        if (auth('account')->check()) {
            CartModel::where('account_id', auth('account')->id())->delete();
        } else {
            CartModel::where('session_id', session()->getId())->delete();
        }
        $this->dispatch('cart-updated');
    }

    public function render()
    {
        $cartItems = collect();
        $total = 0;

        if (auth('account')->check()) {
            $cartItems = CartModel::with('product')
                ->where('account_id', auth('account')->id())
                ->get();
        } else {
            $cartItems = CartModel::with('product')
                ->where('session_id', session()->getId())
                ->get();
        }

        $total = $cartItems->sum('total');

        return view('livewire.frontend.cart', [
            'cartItems' => $cartItems,
            'total' => $total,
        ]);
    }
}
