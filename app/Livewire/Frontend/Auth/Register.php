<?php

namespace App\Livewire\Frontend\Auth;

use App\Models\Account;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Register extends Component
{
    public $name = '';

    public $email = '';

    public $password = '';

    public $password_confirmation = '';

    public $phone = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:accounts,email',
        'password' => 'required|min:8|confirmed',
        'phone' => 'nullable|string|max:20',
    ];

    public function mount()
    {
        // Redirect if already authenticated
        if (Auth::guard('account')->check()) {
            return redirect()->route('account.dashboard');
        }
    }

    public function register()
    {
        $this->validate();

        $account = Account::create([
            'name' => $this->name,
            'email' => $this->email,
            'username' => $this->email, // Use email as username
            'password' => Hash::make($this->password),
            'phone' => $this->phone,
            'type' => 'account',
            'loginBy' => 'email',
            'is_active' => true,
        ]);

        Auth::guard('account')->login($account);

        session()->regenerate();

        $this->dispatch('notify', message: 'Account created successfully! Welcome!', type: 'success');

        return redirect()->route('account.dashboard');
    }

    public function render()
    {
        return view('livewire.frontend.auth.register');
    }
}
