<?php

namespace App\Models;

use App\Models\Product;
use App\Traits\HasScope;
use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, HasSlug, HasScope;

    protected $fillable = ['name', 'slug', 'image'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn($image) => asset('storage/categories/'. $image),
        );
    }

}
