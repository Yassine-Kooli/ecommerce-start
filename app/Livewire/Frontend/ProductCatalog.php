<?php

namespace App\Livewire\Frontend;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use TomatoPHP\FilamentEcommerce\Models\Product;

#[Layout('components.layouts.app')]
class ProductCatalog extends Component
{
    use WithPagination;

    public $search = '';

    public $sortBy = 'latest';

    public $priceMin = '';

    public $priceMax = '';

    public $perPage = 12;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'latest'],
        'priceMin' => ['except' => ''],
        'priceMax' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSortBy()
    {
        $this->resetPage();
    }

    public function updatingPriceMin()
    {
        $this->resetPage();
    }

    public function updatingPriceMax()
    {
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->priceMin = '';
        $this->priceMax = '';
        $this->sortBy = 'latest';
        $this->resetPage();
    }

    public function render()
    {
        $query = Product::where('is_activated', true);

        // Search filter
        if ($this->search) {
            $query->where(function ($q) {
                $q->whereJsonContains('name->en', $this->search)
                    ->orWhereJsonContains('about->en', $this->search)
                    ->orWhere('sku', 'like', '%'.$this->search.'%');
            });
        }

        // Price filters
        if ($this->priceMin) {
            $query->where('price', '>=', $this->priceMin);
        }

        if ($this->priceMax) {
            $query->where('price', '<=', $this->priceMax);
        }

        // Sorting
        switch ($this->sortBy) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $products = $query->paginate($this->perPage);

        return view('livewire.frontend.product-catalog', [
            'products' => $products,
        ]);
    }
}
