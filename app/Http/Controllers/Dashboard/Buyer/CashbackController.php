<?php

namespace App\Http\Controllers\Dashboard\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Cashback;
use App\Repositories\CashbackRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;

class CashbackController extends Controller
{
    /** @var CashbackRepository $cashbackRepository */
    private $cashbackRepository;

    public function __construct()
    {
        $this->cashbackRepository = app(CashbackRepository::class);
    }

    /**
     * История начислений Кэшбэка
     *
     * @return View
     */
    public function index(): View
    {
        /** @var LengthAwarePaginator $cashbacks */
        $cashbacks = $this
            ->cashbackRepository
            ->listInProgress(auth()->user()->id)
            ->paginate(10);

        $cashbacks = $cashbacks->map(function (Cashback $item) {
            $item->was_paid = $item
                ->schedules
                ->where('payout_complete', true)
                ->sum('payout_amount');
            return $item;
        });

        return view('dashboard.buyer.cashback.index', compact('cashbacks'));
    }
}
