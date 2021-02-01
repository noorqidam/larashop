<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'user_id',
        'sku',
        'type',
        'name',
        'slug',
        'price',
        'weight',
        'length',
        'width',
        'height',
        'short_description',
        'description',
        'status',
    ];

    public const DRAFT = 0;
    public const ACTIVE = 1;
    public const INACTIVE = 2;

    public const STATUSES = [
        self::DRAFT => 'draft',
        self::ACTIVE => 'active',
        self::INACTIVE => 'inactive',
    ];

    public const SIMPLE = 'simple';
    public const CONFIGURABLE = 'configurable';

    public const TYPES = [
        self::SIMPLE => 'Simple',
        self::CONFIGURABLE => 'Configurable',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productInventory()
    {
        return $this->hasOne(ProductInventory::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    public function variants()
    {
        return $this->hasMany(Product::class, 'parent_id')->orderBy('price', 'ASC');
    }

    public function parent()
    {
        return $this->belongsTo(Product::class, 'parent_id');
    }

    public function productAttributeValues()
    {
        return $this->hasMany(ProductAttributeValue::class, 'parent_product_id');
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class)->orderBy('id', 'DESC');
    }

    public static function statuses()
    {
        return self::STATUSES;
    }

    /**
     * Get status label
     *
     * @return string
     */
    public function statusLabel()
    {
        $statuses = $this->statuses();
        return isset($this->status) ? $statuses[$this->status] : null;
    }

    /**
     * Get product types
     *
     * @return array
     */
    public static function types()
    {
        return self::TYPES;
    }
}
