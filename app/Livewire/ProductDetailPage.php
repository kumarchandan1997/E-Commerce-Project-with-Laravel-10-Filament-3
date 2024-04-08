<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Home Page -Market-cart')]


class ProductDetailPage extends Component
{
    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function render()
    {
        $products = Product::where('slug',$this->slug)->first();
        return view('livewire.product-detail-page',[
            'products' => $products
        ]);
    }
}
