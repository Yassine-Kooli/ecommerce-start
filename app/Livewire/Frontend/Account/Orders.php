<?php

namespace App\Livewire\Frontend\Account;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use TomatoPHP\FilamentEcommerce\Models\Order;

#[Layout('components.layouts.app')]
class Orders extends Component
{
    use WithPagination;

    public $search = '';

    public $status = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'status' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function render()
    {
        $orders = Order::where('account_id', auth('account')->id())
            ->when($this->search, function ($query) {
                $query->where('uuid', 'like', '%'.$this->search.'%');
            })
            ->when($this->status, function ($query) {
                $query->where('status', $this->status);
            })
            ->latest()
            ->paginate(10);

        return view('livewire.frontend.account.orders', [
            'orders' => $orders,
        ]);
    }
}
