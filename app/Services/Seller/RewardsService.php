<?php


namespace App\Services\Seller;


use App\Models\Order;
use App\Models\SellerHistoryAccount;
use App\Repositories\SellerHistoryAccountRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Carbon;

class RewardsService
{
    /** @var UserRepository $userRepository */
    private $userRepository;

    /** @var SellerHistoryAccountRepository $sellerHistoryAccountRepository */
    private $sellerHistoryAccountRepository;

    public function __construct()
    {
        $this->userRepository = app(UserRepository::class);
        $this->sellerHistoryAccountRepository = app(SellerHistoryAccountRepository::class);
    }

    /**
     * Добавить на балансы продавцам
     *
     * @param array $sellersPricesAndFees
     */
    public function add(array $sellersPricesAndFees, Order $order): void
    {
        foreach ($sellersPricesAndFees as $item) {
            $this
                ->userRepository
                ->addToSellerAccount(
                    $item['user_id'],
                    ($item['amount'] - $item['fee_amount']) //Сумма заказа с учетом комиссии сервиса
                );
        }

        //Вставка истории продавцам
        $this->appendToSellersAccountsHistory($sellersPricesAndFees, $order);
    }

    /**
     * Массовая вставка истории продавцам
     *
     * @param array $sellersPricesAndFees
     * @param Order $order
     */
    private function appendToSellersAccountsHistory(array $sellersPricesAndFees, Order $order): void
    {
        $items = [];

        foreach ($sellersPricesAndFees as $item) {
            //Покупка
            $items[] = [
                'user_id'         => $item['user_id'], //Продавец
                'with_user_id'    => $order->user_id,  //Покупатель
                'trans_direction' => SellerHistoryAccount::DIR_IN,
                'trans_type'      => SellerHistoryAccount::TYPE_PURCHASE,
                'amount'          => $item['amount'],
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now(),
            ];

            //Комиссия сервиса
            $items[] = [
                'user_id'         => $item['user_id'], //Продавец
                'with_user_id'    => null,             //Сервис
                'trans_direction' => SellerHistoryAccount::DIR_OUT,
                'trans_type'      => SellerHistoryAccount::TYPE_PLATFORM_FEE,
                'amount'          => $item['fee_amount'],
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now(),
            ];
        }

        $this
            ->sellerHistoryAccountRepository
            ->fill($items);
    }
}