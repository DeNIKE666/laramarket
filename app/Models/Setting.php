<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'slug',
        'name',
        'value',
    ];

    public $timestamps = false;

    public static function getNumberValue($slug) {

        try {
            $setting = Setting::where('slug', $slug)->firstOrFail();
            return (int) $setting->value;
        } catch(ModelNotFoundException $e) {
            dd($e);
        }
    }
}

