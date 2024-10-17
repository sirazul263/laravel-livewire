<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Layout\Navbar;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;

class CartPage extends Component
{
    use LivewireAlert;
    #[Title('Cart Page')]
    
    public $cart_items =[];
    public $grand_total =0;

    public function mount(){
        $this->cart_items = CartManagement::getCartItemsFromCookie();
        $this->grand_total =CartManagement::calculateGrandTotal($this->cart_items);

    }

    public function removeItem($product_id){
        $this->cart_items = CartManagement::removeCartItem($product_id);
        $this->grand_total =CartManagement::calculateGrandTotal($this->cart_items);
        $this->dispatch('update-cart-count', total_count: count($this->cart_items))->to(Navbar::class);
        $this->alert('success', 'Product removed from the cart successfully!', [
            'position'=>'top-right',
            'timer'=>5000,
            'toast'=>true,
        ]);
    }

    public function increaseQuantity($product_id){
        $this->cart_items = CartManagement::incrementQuantityToCartItem($product_id);
        $this->grand_total =CartManagement::calculateGrandTotal($this->cart_items);
         $this->dispatch('update-cart-count', total_count: count($this->cart_items))->to(Navbar::class);
       
    }
    public function decreaseQuantity($product_id){
        $this->cart_items = CartManagement::decrementQuantityToCartItem($product_id);
        $this->grand_total =CartManagement::calculateGrandTotal($this->cart_items);
        $this->dispatch('update-cart-count', total_count: count($this->cart_items))->to(Navbar::class);
    }


    public function render()
    {
        return view('livewire.cart-page');
    }
}
