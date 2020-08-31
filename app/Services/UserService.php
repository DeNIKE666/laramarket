<?php


namespace App\Services;


use App\Models\User;
use App\Repositories\UserRepository;

/**
 * Class UserService
 *
 * @package App\Services
 * @author  Anton Reviakin
 */
class UserService
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = app(UserRepository::class);
    }

    /**
     * Сделать пользователя партнером
     *
     * @return bool
     */
    public function setAsPartner(): bool
    {
        /** @var User $user */
        $user = auth()->user();

        if ($user->isPartner()) {
            return true;
        }

        return $this->userRepository->setAsPartner($user->id);
    }
}