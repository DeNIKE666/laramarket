<?php


namespace App\Services\Partner;


use App\Models\User;
use App\Repositories\PartnerHistoryAccountRepository;
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
    private $partnerHistoryAccountRepository;

    public function __construct()
    {
        $this->userRepository = app(UserRepository::class);
        $this->partnerHistoryAccountRepository = app(PartnerHistoryAccountRepository::class);
    }

    public function list()
    {
        /** @var User $user */
        $user = auth()->user();

        return $this->partnerHistoryAccountRepository->get($user->id);
    }
}