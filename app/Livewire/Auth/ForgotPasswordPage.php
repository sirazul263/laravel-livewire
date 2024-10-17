<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Title;
use Livewire\Component;

class ForgotPasswordPage extends Component
{
    #[Title('Forgot Password')]
     
    public $email;

    public function save(){
        $this->validate([
            'email' => 'required|email|max:255|exists:users,email',
        ]);

        $status = Password::sendResetLink(['email' => $this->email]);
        if($status===Password::RESET_LINK_SENT){
            session()->flash('success', 'Password reset link has been sent successfully to your email address!');
            $this->email = "";
        }
        // Send password reset email to the given email address
    }

    public function render()
    {
        return view('livewire.auth.forgot-password-page');
    }
}
