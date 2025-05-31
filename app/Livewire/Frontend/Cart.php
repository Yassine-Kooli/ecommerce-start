<?php

namespace App\Livewire\Frontend;

use Livewire\Attributes\Layout;
use Livewire\Component;
use TomatoPHP\FilamentEcommerce\Models\Cart as CartModel;
use TomatoPHP\FilamentEcommerce\Models\Product;

#[Layout('components.layouts.app')]
class Cart extends Component
{
    protected $listeners = ['add-to-cart' => 'addToCart'];

    public function addToCart($productId, $quantity = 1)
    {
        $product = Product::find($productId);

        if (! $product) {
            return;
        }

        $cartData = [
            'product_id' => $product->id,
            'item' => $product->name['en'] ?? 'Product',
            'price' => $product->price,
            'discount' => $product->discount ?? 0,
            'qty' => $quantity,
            'total' => ($product->price - ($product->discount ?? 0)) * $quantity,
            'session_id' => session()->getId(),
        ];

        if (auth('account')->check()) {
            $cartData['account_id'] = auth('account')->id();
        }

        // Check if item already exists in cart
        $existingCart = CartModel::where('product_id', $product->id)
            ->where(function ($query) {
                if (auth('account')->check()) {
                    $query->where('account_id', auth('account')->id());
                } else {
                    $query->where('session_id', session()->getId());
                }
            })
            ->first();

        if ($existingCart) {
            $existingCart->update([
                'qty' => $existingCart->qty + $quantity,
                'total' => ($product->price - ($product->discount ?? 0)) * ($existingCart->qty + $quantity),
            ]);
        } else {
            CartModel::create($cartData);
        }

        $this->dispatch('cart-updated');
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
