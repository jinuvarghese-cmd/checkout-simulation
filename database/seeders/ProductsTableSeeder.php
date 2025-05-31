<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantOption;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        $product = Product::create([
            'name' => 'Converse Chuck Taylor All Star II Hi',
            'description' => 'The Converse Chuck Taylor All Star II Hi features a premium canvas upper, Lunarlon sockliner for cushioning, and a micro-suede lining for comfort.',
            'price' => 75.00,
            'image_url' => 'https://example.com/converse.jpg',
        ]);

        // Color variants
        $colorVariant = ProductVariant::create([
            'product_id' => $product->id,
            'name' => 'Color',
        ]);

        ProductVariantOption::create(['variant_id' => $colorVariant->id, 'value' => 'Black']);
        ProductVariantOption::create(['variant_id' => $colorVariant->id, 'value' => 'White']);
        ProductVariantOption::create(['variant_id' => $colorVariant->id, 'value' => 'Red']);

        // Size variants
        $sizeVariant = ProductVariant::create([
            'product_id' => $product->id,
            'name' => 'Size',
        ]);

        ProductVariantOption::create(['variant_id' => $sizeVariant->id, 'value' => 'US 7']);
        ProductVariantOption::create(['variant_id' => $sizeVariant->id, 'value' => 'US 8']);
        ProductVariantOption::create(['variant_id' => $sizeVariant->id, 'value' => 'US 9']);
        ProductVariantOption::create(['variant_id' => $sizeVariant->id, 'value' => 'US 10']);
    }
}