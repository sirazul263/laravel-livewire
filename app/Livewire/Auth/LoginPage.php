<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

class LoginPage extends Component
{
    #[Title('Login')]

    public $email;
    public $password;

    public function login(){
        $this->validate([
            'email' => 'required|email|max:255|exists:users,email',
            'password' => 'required|min:6|max:255',
            ]);
        if(!Auth::attempt(['email' => $this->email ,'password' => $this->password])){
            session()->flash('error', 'Invalid credentials');
            return;
        } 
        return redirect()->intended();  // Redirect after successful login
    }
    public function render()
    {
        return view('livewire.auth.login-page');
    }
}
