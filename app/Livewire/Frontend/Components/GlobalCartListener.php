<?php

namespace App\Livewire\Frontend\Components;

use Livewire\Component;
use TomatoPHP\FilamentEcommerce\Models\Cart as CartModel;
use TomatoPHP\FilamentEcommerce\Models\Product;

class GlobalCartListener extends Component
{
    protected $listeners = ['add-to-cart' => 'addToCart'];

    public function addToCart($productId, $quantity = 1)
    {
        $product = Product::find($productId);

        if (! $product) {
            return;
        }

        // Handle JSON name field properly
        $productName = 'Product';
        if (is_array($product->name)) {
            $productName = $product->name['en'] ?? $product->name[array_key_first($product->name)] ?? 'Product';
        } elseif (is_string($product->name)) {
            $productName = $product->name;
        }

        $cartData = [
            'product_id' => $product->id,
            'item' => $productName,
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

        // Dispatch events to update UI components
        $this->dispatch('cart-updated');
    }

    public function render()
    {
        return view('livewire.frontend.components.empty');
    }
}
