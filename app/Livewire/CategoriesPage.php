<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Title;

#[Title('Category Page -Market-cart')]

class CategoriesPage extends Component
{
    public function render()
    {
        $category = Category::where('is_active',1)->get();
        return view('livewire.categories-page',[
            'category' => $category
        ]);
    }
}
