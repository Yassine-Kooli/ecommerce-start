<?php

namespace App\Livewire\Frontend\Account;

use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.app')]
class Profile extends Component
{
    use WithFileUploads;

    public $name;

    public $email;

    public $phone;

    public $address;

    public $current_password;

    public $new_password;

    public $new_password_confirmation;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:500',
    ];

    protected $passwordRules = [
        'current_password' => 'required',
        'new_password' => 'required|min:8|confirmed',
    ];

    public function mount()
    {
        $user = auth('account')->user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->address = $user->address;
    }

    public function updateProfile()
    {
        $this->validate();

        $user = auth('account')->user();

        // Check if email is unique (excluding current user)
        $this->validate([
            'email' => 'required|email|unique:accounts,email,'.$user->id,
        ]);

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
        ]);

        $this->dispatch('notify', message: 'Profile updated successfully!', type: 'success');
    }

    public function updatePassword()
    {
        $this->validate($this->passwordRules);

        $user = auth('account')->user();

        if (! Hash::check($this->current_password, $user->password)) {
            $this->addError('current_password', 'Current password is incorrect.');

            return;
        }

        $user->update([
            'password' => Hash::make($this->new_password),
        ]);

        $this->current_password = '';
        $this->new_password = '';
        $this->new_password_confirmation = '';

        $this->dispatch('notify', message: 'Password updated successfully!', type: 'success');
    }

    public function render()
    {
        return view('livewire.frontend.account.profile');
    }
}
