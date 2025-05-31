<?php

namespace App\Livewire\Frontend\Components;

use Livewire\Component;

class SearchBar extends Component
{
    public $search = '';
    
    public function performSearch()
    {
        if ($this->search) {
            return redirect()->route('products', ['search' => $this->search]);
        }
    }

    public function render()
    {
        return view('livewire.frontend.components.search-bar');
    }
}
