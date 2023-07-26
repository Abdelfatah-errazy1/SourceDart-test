<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable=['name'];

    
    //relationship to the parent category
    
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    //relationship to the children category

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    //relationship to the product

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
