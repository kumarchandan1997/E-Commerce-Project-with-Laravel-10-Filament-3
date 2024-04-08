<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Brand;
use App\Models\Category;
use App\Models\User;

#[Title('Home Page -Market-cart')]

class HomePage extends Component
{
    public function render()
    {
        $brands = Brand::where('is_active', 1)->get();
        $category = Category::where('is_active', 1)->get();
        return view('livewire.home-page', [
            'brands' => $brands,
            'category' => $category
        ]);
    }
}
