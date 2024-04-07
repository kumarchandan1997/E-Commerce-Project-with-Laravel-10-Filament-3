<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Brand;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use App\Models\Product;

use Livewire\Component;


#[Title('Product Page -Market-cart')]

class ProductPage extends Component
{
    public function render()
    {
        $productQuery = Product::query()->where('is_active',1);
        $category = Category::where('is_active',1)->get();
        $brand = Brand::where('is_active',1)->get();
        return view('livewire.product-page',[
            'products' => $productQuery->paginate(1),
            'category' => $category,
            'brand' => $brand
        ]);
    }
}
