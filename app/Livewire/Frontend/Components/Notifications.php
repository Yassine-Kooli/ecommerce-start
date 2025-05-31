<?php

namespace App\Livewire\Frontend\Components;

use Livewire\Component;

class Notifications extends Component
{
    public $notifications = [];

    protected $listeners = ['notify' => 'addNotification'];

    public function addNotification($message, $type = 'success')
    {
        $id = uniqid();
        $this->notifications[] = [
            'id' => $id,
            'message' => $message,
            'type' => $type,
        ];

        // Auto-remove after 5 seconds using JavaScript
        $this->dispatch('auto-remove-notification', id: $id);
    }

    public function removeNotification($id)
    {
        $this->notifications = array_filter($this->notifications, function ($notification) use ($id) {
            return $notification['id'] !== $id;
        });
    }

    public function render()
    {
        return view('livewire.frontend.components.notifications');
    }
}
