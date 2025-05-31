<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image_url',
        'inventory',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'inventory' => 'integer',
    ];

    /**
     * Get the variants for the product.
     */
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    /**
     * Get the order items for the product.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Check if product is in stock
     */
    public function inStock()
    {
        return $this->inventory > 0;
    }

    /**
     * Decrease inventory
     */
    public function decreaseInventory($quantity)
    {
        $this->decrement('inventory', $quantity);
    }

    /**
     * Increase inventory
     */
    public function increaseInventory($quantity)
    {
        $this->increment('inventory', $quantity);
    }
}