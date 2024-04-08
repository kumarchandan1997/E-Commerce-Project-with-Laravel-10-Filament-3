<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Subcategory extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug','category_id','description','is_active'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
