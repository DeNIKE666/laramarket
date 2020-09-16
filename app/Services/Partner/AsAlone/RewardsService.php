<?php


namespace App\Services\Partner\AsAlone;


use App\Models\Order;
use App\Repositories\Admin\SettingsRepository;
use App\Repositories\PartnerAsAloneHistoryAccountRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;

class RewardsService
{
    /** @var SettingsRepository $settingsRepository */
    private $settingsRepository;

    /** @var UserRepository $userRepository */
    private $userRepository;

    /** @var PartnerAsAloneHistoryAccountRepository $partnerAsAloneHistoryAccountRepository */
    private $partnerAsAloneHistoryAccountRepository;

    public function __construct()
    {
        $this->settingsRepository = app(SettingsRepository::class);
        $this->userRepository = app(UserRepository::class);
        $this->partnerAsAloneHistoryAccountRepository = app(PartnerAsAloneHistoryAccountRepository::class);
    }

    /**
     * Добавить на балансы партнерам
     *
     * @param array $sellersPricesAndFees
     * @param Order $order
     */
    public function add(array $sellersPricesAndFees, Order $order): void
    {
        $rewardsPercent = $this->getRewardsPercent();

        //Найденые партнеры
        $partnersRewards = [];

        foreach ($sellersPricesAndFees as $item) {
            //Найти партнера (пригласителя)
            $partner = $this
                ->userRepository
                ->getPartnerByUser($item['user_id']);

            //Партнер не найден - пропустить итерацию
            if (!$partner) {
                continue;
            }

            //Процент партнерки от суммы заказа
            $partnerReward = ($item['amount'] * $rewardsPercent) / 100;

            $this
                ->userRepository
                ->addToPartnerAccount(
                    $partner->id,
                    $partnerReward
                );

            //Заполнить массив для истории партнерских начислений
            $partnersRewards[] = [
                'receiver_id' => $partner->id,     //Получатель (партнер)
                'sender_id'   => $item['user_id'], //Реферал (продавец)
                'order_id'    => $order->id,       //Заказ
                'percent'     => $rewardsPercent,  //Зафиксировать процент партнерских
                'amount'      => $partnerReward,   //Сумма партнерских
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ];
        }

        //Массовая вставка истории начислений
        $this
            ->partnerAsAloneHistoryAccountRepository
            ->fill($partnersRewards);
    }

    /**
     * Партнерский процент из настроек
     *
     * @return float
     */
    private function getRewardsPercent(): float
    {
        //Процент вознаграждения
        $setting = $this
            ->settingsRepository
            ->getSingleItem('percent_for_single_level_program');

        if (!$setting) {
            abort(
                Response::HTTP_NOT_FOUND,
                'Не найден параметр "Процент от заказа одноуровневой партнерской программы"'
            );
        }

        return (float)$setting->value;
    }
}