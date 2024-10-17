<?php

namespace App\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class MyOrdersPage extends Component
{
    use WithPagination;
    #[Title('My Orders')]
    public function render()
    {
        $orders = Order::where('user_id', Auth::user()->id)->latest()->paginate(2);
        return view('livewire.my-orders-page' , [
            'orders' => $orders,
        ]);
    }
}
