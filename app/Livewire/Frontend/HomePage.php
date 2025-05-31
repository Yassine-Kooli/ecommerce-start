<?php

namespace App\Livewire\Frontend;

use Livewire\Attributes\Layout;
use Livewire\Component;
use TomatoPHP\FilamentEcommerce\Models\Product;

#[Layout('components.layouts.app')]
class HomePage extends Component
{
    public function render()
    {
        $featuredProducts = Product::where('is_activated', true)
            ->where('is_trend', true)
            ->take(8)
            ->get();

        $newProducts = Product::where('is_activated', true)
            ->latest()
            ->take(8)
            ->get();

        return view('livewire.frontend.home-page', [
            'featuredProducts' => $featuredProducts,
            'newProducts' => $newProducts,
        ]);
    }
}
