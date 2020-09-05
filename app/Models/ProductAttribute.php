<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Attribute;
use App\Models\Product;

class ProductAttribute extends Model
{
    protected $fillable = [
        'product_id',
        'attribute_id',
        'value'
    ];

    public $timestamps = false;

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class, 'id', 'product_id');
    }

    public  static function add($fields)
    {
        $productAttribute = new static;
        $productAttribute->fill($fields);
        $productAttribute->save();

        return $productAttribute;
    }

}
