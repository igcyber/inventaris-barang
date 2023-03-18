<?php

namespace App\Models;

use App\Traits\HasScope;
use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory, HasScope;

    protected $fillable = ['user_id', 'name', 'quantity', 'status', 'image', 'unit'];

    protected $casts = [
        'status' => OrderStatus::class
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn($image) => asset('storage/orders/'. $image),
        );
    }
}
