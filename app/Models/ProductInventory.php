<?php

namespace App\Models;

use App\Exceptions\OutOfStockException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductInventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'qty',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public static function reduceStock($productId, $qty)
    {
        $inventory = self::where('product_id', $productId)->firstOrFail();

        if ($inventory->qty < $qty) {
            $product = Product::findOrFail($productId);
            throw new OutOfStockException('The product ' . $product->sku . ' is out of stock');
        }

        $inventory->qty = $inventory->qty - $qty;
        $inventory->save();
    }

    public function increaseStock($productId, $qty)
    {
        $inventory = self::where('product_id', $productId)->firstOrFail();
        $inventory->qty = $inventory->qty + $qty;
        $inventory->save();
    }
}
