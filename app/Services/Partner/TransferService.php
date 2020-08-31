<?php


namespace App\Services\Partner;


use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Response;

/**
 * Class TransferService
 *
 * @package App\Services\Partner
 * @author  Anton Reviakin
 */
class TransferService
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = app(UserRepository::class);
    }

    /**
     * Перевести на персональный счет
     *
     * @return bool
     */
    public function transferToPersonalAccount(): bool
    {
        $amount = request('amount');

        /** @var User $user */
        $user = auth()->user();

        //Не хватает средств на балансе
        if (!$user->checkPartnerAccount($amount)) {
            abort(
                Response::HTTP_BAD_REQUEST,
                __('partner/validation.amount.balance_error')
            );
        }

        return $this->userRepository->transferFromPartnerToPersonal($user->id, $amount);
    }
}