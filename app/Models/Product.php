<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // adding fillable for mass assiement
    protected $fillable=['name','description','price','image'];

    // relationship to the category model
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

}
