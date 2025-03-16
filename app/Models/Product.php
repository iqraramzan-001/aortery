<?php

namespace App\Models;
 use App\Enums\ProductClassification;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'sku', 'qty', 'supplier_id', 'category_id', 'price',
        'manufacturer', 'classification', 'country', 'model_no', 'mdma_no',
        'description', 'type','length','width','height','warehouse_id',
        'discount_price','subcategory_id','subsubcategory_id'
    ];

    protected $casts = [
        'classification' => ProductClassification::class,
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function subCategory()
    {
        return $this->belongsTo(Category::class, 'subcategory_id');
    }
    public function subSubCategory()
    {
        return $this->belongsTo(Category::class, 'subsubcategory_id');
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(WareHouse::class, 'warehouse_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
