<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;
use Livewire\Component;

class RegisterPage extends Component
{
    #[Title('Register')]


    public $name;
    public $email;
    public $password;

    public function save(){
        $this->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:6|max:255',
        ]);
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);
       Auth::loginUsingId($user->id);
       return redirect()->intended();
    }

    public function render()
    {
        return view('livewire.auth.register-page');
    }
}
