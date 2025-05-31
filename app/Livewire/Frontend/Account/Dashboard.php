<?php

namespace App\Livewire\Frontend\Account;

use Livewire\Attributes\Layout;
use Livewire\Component;
use TomatoPHP\FilamentEcommerce\Models\Cart;
use TomatoPHP\FilamentEcommerce\Models\Order;

#[Layout('components.layouts.app')]
class Dashboard extends Component
{
    public function render()
    {
        $user = auth('account')->user();

        // Get user statistics
        $totalOrders = Order::where('account_id', $user->id)->count();
        $pendingOrders = Order::where('account_id', $user->id)->where('status', 'pending')->count();
        $completedOrders = Order::where('account_id', $user->id)->where('status', 'completed')->count();
        $cartItems = Cart::where('account_id', $user->id)->count();

        // Get recent orders
        $recentOrders = Order::where('account_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        return view('livewire.frontend.account.dashboard', [
            'user' => $user,
            'totalOrders' => $totalOrders,
            'pendingOrders' => $pendingOrders,
            'completedOrders' => $completedOrders,
            'cartItems' => $cartItems,
            'recentOrders' => $recentOrders,
        ]);
    }
}
