<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Product Page -Market-cart')]

class CartPage extends Component
{
   public $cart_items = [];
   public $grand_total;

   public function mount()
   {
    $this->cart_items = CartManagement::getcartItemsFromCookie();
    $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
   }

    public function render()
    {
        return view('livewire.cart-page');
    }

    public function removeItem($productId)
    {
        $this->cart_items = CartManagement::removeItemFromCart($productId);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
        $this->dispatch('update-cart-count',total_count: count($this->cart_items))->to(Navbar::class);
    }
}
