<?php


namespace App\Services\Partner;


use App\Models\User;
use App\Repositories\UserRepository;

/**
 * Class RefferalsService
 *
 * @package App\Services\Partner
 * @author  Anton Reviakin
 */
class RefferalsService
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = app(UserRepository::class);
    }

    public function list()
    {
        /** @var User $user */
        $user = auth()->user();

        return $this->userRepository->getReferrals($user->id);
    }
}