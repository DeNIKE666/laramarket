<?php
namespace App\Repositories\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Attribute;

class AttributeRepository
{

    public function listAttributes()
    {
        return Attribute::all();
    }
}
