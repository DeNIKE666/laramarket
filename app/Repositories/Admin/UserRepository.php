<?php
namespace App\Repositories\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\User;

class UserRepository
{
    public function listUsers()
    {
        return User::where('role', '!=', User::ROLE_ADMIN)->paginate(30);
    }
}
