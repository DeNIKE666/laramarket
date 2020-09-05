<?php
namespace App\Http\Controllers\Dashboard\Seller;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class SellerController extends Controller
{
    public function seller_status()
    {
        return view(
            'dashboard.shop.user.status'

        );
    }

    public function data_sellers()
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user->hasSellerRequest()) {
            return redirect()->back()->with('status', 'Заявка на продовца отправлена');
        }
        //dd($user->hasPropery($user->id));
        if (!$property = $user->hasPropery($user->id)) {
            $property = new Property();
        }
        //$property = new Property();
        return view(
            'dashboard.shop.user.data_seller',
            compact(
                'user',
                'property'
            )
        );
    }
}