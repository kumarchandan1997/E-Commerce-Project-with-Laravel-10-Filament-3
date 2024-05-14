<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Category;
use App\Models\Brand;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use App\Models\Product;
use Livewire\Attributes\Url;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;


#[Title('Product Page -Market-cart')]

class ProductPage extends Component
{
    use LivewireAlert;
    #[Url]
     public $selected_categories = [];
     #[Url]
     public $selected_brands = [];
    #[Url]
     public $featured =[];

     #[Url]
     public $onsale =[];
     #[Url]
     public $price_range = 300000;

     #[Url]
     public $sort = 'latest';

     // add to cart

     public function addToCart($productId)
     {
        $total_count = CartManagement::addItemToCart($productId);
        $this->dispatch('update-cart-count',total_count: $total_count)->to(Navbar::class);

        $this->alert('success', 'Product added to cart successfully!', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
           ]);
     }

    public function render()
    {
        $productQuery = Product::query()->where('is_active',1);
        if(!empty($this->selected_categories)){
            $productQuery->whereIn('category_id',$this->selected_categories);
        }
        if(!empty($this->selected_brands)){
            $productQuery->whereIn('brand_id',$this->selected_brands);
        }
        if(!empty($this->featured))
        {
            $productQuery->where('is_featured',1);
        }
        if(!empty($this->onsale)){
            $productQuery->where('on_sale',1);
        }
        if(!empty($this->price_range))
        {
            $productQuery->whereBetween('price',[0,$this->price_range]);
        }

        if($this->sort == 'latest')
        {
            $productQuery->latest();
        }

        if($this->sort == 'price')
        {
            $productQuery->orderBy('price');
        }

        $category = Category::where('is_active',1)->get();
        $brand = Brand::where('is_active',1)->get();
        return view('livewire.product-page',[
            'products' => $productQuery->paginate(6),
            'category' => $category,
            'brand' => $brand
        ]);
    }
}
