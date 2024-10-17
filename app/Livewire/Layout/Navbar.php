<?php

namespace App\Livewire\Layout;

use App\Helpers\CartManagement;
use Livewire\Attributes\On;
use Livewire\Component;

class Navbar extends Component
{
   public $total_count = 0;

    public function mount(){
        $this->total_count = count(CartManagement::getCartItemsFromCookie());
    }

    #[On('update-cart-count')]
    public function updateCardCount($total_count){
     $this->total_count = $total_count;  // Update the total count in the navbar component when the total count changes in the CartManagement class.
    }

    public function render()
    {
        return view('livewire.layout.navbar');
    }
}
