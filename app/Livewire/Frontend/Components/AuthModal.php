<?php

namespace App\Livewire\Frontend\Components;

use App\Models\Account;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AuthModal extends Component
{
    public $showModal = false;

    public $mode = 'login'; // 'login' or 'register'

    // Login fields
    public $email = '';

    public $password = '';

    public $remember = false;

    // Register fields
    public $name = '';

    public $register_email = '';

    public $register_password = '';

    public $register_password_confirmation = '';

    public $phone = '';

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    protected $registerRules = [
        'name' => 'required|string|max:255',
        'register_email' => 'required|email|unique:accounts,email',
        'register_password' => 'required|min:8|confirmed',
        'phone' => 'nullable|string|max:20',
    ];

    public function openModal($mode = 'login')
    {
        $this->mode = $mode;
        $this->showModal = true;
        $this->resetFields();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetFields();
    }

    public function switchMode()
    {
        $this->mode = $this->mode === 'login' ? 'register' : 'login';
        $this->resetFields();
    }

    public function resetFields()
    {
        $this->email = '';
        $this->password = '';
        $this->remember = false;
        $this->name = '';
        $this->register_email = '';
        $this->register_password = '';
        $this->register_password_confirmation = '';
        $this->phone = '';
        $this->resetErrorBag();
    }

    public function login()
    {
        $this->validate();

        if (Auth::guard('account')->attempt([
            'email' => $this->email,
            'password' => $this->password,
        ], $this->remember)) {
            $this->dispatch('notify', message: 'Welcome back!', type: 'success');
            $this->closeModal();

            return redirect()->intended();
        }

        $this->addError('email', 'Invalid credentials.');
    }

    public function register()
    {
        $this->validate($this->registerRules);

        $account = Account::create([
            'name' => $this->name,
            'email' => $this->register_email,
            'username' => $this->register_email, // Use email as username
            'password' => Hash::make($this->register_password),
            'phone' => $this->phone,
            'type' => 'account',
            'loginBy' => 'email',
            'is_active' => true,
        ]);

        Auth::guard('account')->login($account);

        $this->dispatch('notify', message: 'Account created successfully!', type: 'success');
        $this->closeModal();

        return redirect()->route('account.dashboard');
    }

    public function render()
    {
        return view('livewire.frontend.components.auth-modal');
    }
}
