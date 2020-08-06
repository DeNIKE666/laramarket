<?php
namespace App\Repositories\Admin;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SettingRepository
{
    public function listSettings()
    {
        return Setting::paginate(30);
    }
}
