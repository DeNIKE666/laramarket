<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = [
        'slug',
        'name',
        'is_filter',
    ];

    public $timestamps = false;

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function children()
    {
        return $this->hasMany(ProductAttribute::class);
    }
}
