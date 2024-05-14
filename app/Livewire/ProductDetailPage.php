<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Title;
use Jantinnerezo\LivewireAlert\LivewireAlert;

#[Title('Home Page -Market-cart')]


class ProductDetailPage extends Component
{
    use LivewireAlert;
    public $slug;
    public $quantity = 1;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function increseQty()
    {
        $this->quantity++;
    }

    public function decreseQty()
    {
        if($this->quantity > 1)
        {
            $this->quantity--;
        }
    }

    public function addToCart($productId)
     {
        $total_count = CartManagement::addItemToCartWithQuantity($productId , $this->quantity);
        $this->dispatch('update-cart-count',total_count: $total_count)->to(Navbar::class);

        $this->alert('success', 'Product added to cart successfully!', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
           ]);
     }

    public function render()
    {
        $products = Product::where('slug',$this->slug)->first();
        return view('livewire.product-detail-page',[
            'products' => $products
        ]);
    }
}
