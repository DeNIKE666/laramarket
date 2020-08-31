<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'pages';

    protected $fillable = [
        'slug',
        'name',
        'content',
    ];

    public function scopeSlugPage($query, $slug)
    {
        return $query->where('slug', $slug);
    }
}
