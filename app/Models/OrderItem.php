<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'variant_options',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'quantity' => 'integer',
        'variant_options' => 'array',
    ];

    /**
     * Get the order that owns the order item.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the product that owns the order item.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the total price for this order item
     */
    public function getTotalAttribute()
    {
        return $this->price * $this->quantity;
    }

    /**
     * Get formatted variant options as string
     */
    public function getFormattedVariantOptionsAttribute()
    {
        if (!$this->variant_options) {
            return '';
        }

        $formatted = [];
        foreach ($this->variant_options as $variant => $option) {
            $formatted[] = "{$variant}: {$option}";
        }

        return implode(', ', $formatted);
    }
}