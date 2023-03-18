<?php

namespace App\Models;

use App\Models\Supplier;
use App\Traits\HasScope;
use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, HasSlug, HasScope;

    protected $fillable = [
        'category_id', 'supplier_id', 'name', 'slug', 'description', 'quantity', 'image', 'unit'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn($image) => asset('storage/products/'. $image),
        );
    }
}


