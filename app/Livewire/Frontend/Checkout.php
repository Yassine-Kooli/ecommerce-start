<?php

namespace App\Livewire\Frontend;

use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;
use TomatoPHP\FilamentEcommerce\Models\Cart;
use TomatoPHP\FilamentEcommerce\Models\Order;
use TomatoPHP\FilamentEcommerce\Models\OrderItem;

#[Layout('components.layouts.app')]
class Checkout extends Component
{
    public $cartItems;

    public $total = 0;

    public $shipping_address;

    public $billing_address;

    public $payment_method = 'cash_on_delivery';

    public $notes;

    public $same_as_shipping = true;

    protected $rules = [
        'shipping_address' => 'required|string|max:500',
        'billing_address' => 'required_if:same_as_shipping,false|string|max:500',
        'payment_method' => 'required|in:cash_on_delivery,bank_transfer',
        'notes' => 'nullable|string|max:1000',
    ];

    public function mount()
    {
        $this->loadCartItems();

        // Pre-fill addresses from user profile
        $user = auth('account')->user();
        $this->shipping_address = $user->address ?? '';
        $this->billing_address = $user->address ?? '';
    }

    public function loadCartItems()
    {
        $this->cartItems = Cart::with('product')
            ->where('account_id', auth('account')->id())
            ->get();

        $this->total = $this->cartItems->sum('total');
    }

    public function updatedSameAsShipping()
    {
        if ($this->same_as_shipping) {
            $this->billing_address = $this->shipping_address;
        }
    }

    public function updatedShippingAddress()
    {
        if ($this->same_as_shipping) {
            $this->billing_address = $this->shipping_address;
        }
    }

    public function placeOrder()
    {
        $this->validate();

        if ($this->cartItems->isEmpty()) {
            $this->dispatch('notify', message: 'Your cart is empty!', type: 'error');

            return;
        }

        // Create order
        $order = Order::create([
            'uuid' => Str::uuid(),
            'account_id' => auth('account')->id(),
            'status' => 'pending',
            'total' => $this->total,
            'shipping_address' => $this->shipping_address,
            'billing_address' => $this->same_as_shipping ? $this->shipping_address : $this->billing_address,
            'payment_method' => $this->payment_method,
            'notes' => $this->notes,
        ]);

        // Create order items
        foreach ($this->cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'item' => $cartItem->item,
                'price' => $cartItem->price,
                'discount' => $cartItem->discount,
                'qty' => $cartItem->qty,
                'total' => $cartItem->total,
            ]);
        }

        // Clear cart
        Cart::where('account_id', auth('account')->id())->delete();

        $this->dispatch('notify', message: 'Order placed successfully!', type: 'success');

        return redirect()->route('account.orders');
    }

    public function render()
    {
        return view('livewire.frontend.checkout');
    }
}
