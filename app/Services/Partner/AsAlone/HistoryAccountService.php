<?php


namespace App\Services\Partner\AsAlone;


use App\Models\User;
use App\Repositories\PartnerAsAloneHistoryAccountRepository;
use App\Repositories\UserRepository;

/**
 * Class HistoryAccountService
 *
 * @package App\Services\Partner
 * @author  Anton Reviakin
 */
class HistoryAccountService
{
    private $userRepository;
    private $partnerAsAloneHistoryAccountRepository;

    public function __construct()
    {
        $this->userRepository = app(UserRepository::class);
        $this->partnerAsAloneHistoryAccountRepository = app(PartnerAsAloneHistoryAccountRepository::class);
    }

    public function list()
    {
        return $this
            ->partnerAsAloneHistoryAccountRepository
            ->get(auth()->user()->id);
    }
}