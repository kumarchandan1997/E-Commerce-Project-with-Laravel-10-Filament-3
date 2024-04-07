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
        $productDetails = Product::where('slug',$this->slug)->firstOrFail();
        dd($productDetails);
        return view('livewire.product-detail-page',[
            'products' => $productDetails
        ]);
    }
}
