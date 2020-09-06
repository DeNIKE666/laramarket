<?php

namespace App\Http\Controllers\Dashboard\Buyer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Страница редактирования профиля
     *
     * @return View
     */
    public function edit(): View
    {
        /** @var User $user */
        $user = auth()->user();

        return view('dashboard.edit_profile', compact('user'));
    }

    /**
     * Обновить информацию о профиле
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        /** @var User $user */
        $user = auth()->user();

        $user->edit($request->all());

        return redirect()->back()->with('status', 'Профиль обновлён');
    }
}
