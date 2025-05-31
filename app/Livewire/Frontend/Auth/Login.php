<?php

namespace App\Livewire\Frontend\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Login extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    public function mount()
    {
        // Redirect if already authenticated
        if (Auth::guard('account')->check()) {
            return redirect()->route('account.dashboard');
        }
    }

    public function login()
    {
        $this->validate();

        if (Auth::guard('account')->attempt([
            'email' => $this->email,
            'password' => $this->password,
        ], $this->remember)) {
            session()->regenerate();
            
            $this->dispatch('notify', message: 'Welcome back!', type: 'success');
            
            return redirect()->intended(route('account.dashboard'));
        }

        $this->addError('email', 'The provided credentials do not match our records.');
    }

    public function render()
    {
        return view('livewire.frontend.auth.login');
    }
}
