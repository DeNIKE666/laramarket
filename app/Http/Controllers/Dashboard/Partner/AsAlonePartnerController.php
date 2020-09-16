<?php

namespace App\Http\Controllers\Dashboard\Partner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Partner\TransferToPersonalAccountRequest;
use App\Services\Partner\AsAlone\HistoryAccountService;
use App\Services\Partner\RefferalsService;
use App\Services\Partner\TransferService;
use Illuminate\Http\Response;
use Illuminate\View\View;

class AsAlonePartnerController extends Controller
{
    private $transferService;
    private $refferalsService;
    private $historyAccountService;

    public function __construct()
    {
        $this->transferService = new TransferService();
        $this->refferalsService = new RefferalsService();
        $this->historyAccountService = new HistoryAccountService();
    }

    public function index(): View
    {
        return view('dashboard.partner.index');
    }

    public function referrals(): View
    {
        $referrals = $this->refferalsService->list();

        return view('dashboard.partner.referrals', compact('referrals'));
    }

    /**
     * История начислений
     *
     * @return View
     */
    public function historyAccount(): View
    {
        $history = $this->historyAccountService->list();

        return view('dashboard.partner.history_account', compact('history'));
    }

    public function transferToPersonalAccount(TransferToPersonalAccountRequest $request)
    {
        $transfer = $this
            ->transferService
            ->transferToPersonalAccount();

        return response(
            ['message' => $transfer],
            Response::HTTP_OK
        );
    }
}
