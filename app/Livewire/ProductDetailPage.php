<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Layout\Navbar;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;

class ProductDetailPage extends Component
{
    use LivewireAlert;
    #[Title('Product Detail')]

    public $slug;

    public $quantity =1;

    public function mount($slug){
        $this->slug = $slug;
    }

    public function increaseQuantity(){
        $this->quantity++;
    }
    public function decreaseQuantity(){
        if($this->quantity>1){
            $this->quantity--;
        }
    }

    public function addToCart($product_id){
        $total_count= CartManagement::addItemToCart($product_id , $this->quantity);
        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);
        $this->alert('success', 'Product added to the cart successfully!', [
            'position'=>'top-right',
            'timer'=>5000,
            'toast'=>true,
        ]);
    }


    public function render()
    {
        return view('livewire.product-detail-page' , [
            'product'=>Product::where('slug',  $this->slug)->firstOrFail(),
        ]);
    }
}
