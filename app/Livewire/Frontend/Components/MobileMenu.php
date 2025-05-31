<?php

namespace App\Livewire\Frontend\Components;

use Livewire\Component;

class MobileMenu extends Component
{
    public $isOpen = false;
    
    protected $listeners = ['toggle-mobile-menu' => 'toggleMenu'];
    
    public function toggleMenu()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function render()
    {
        return view('livewire.frontend.components.mobile-menu');
    }
}
