<?php


namespace App\Services\Buyer\Order;


use App\Models\Order;
use App\Repositories\OrderItemRepository;
use App\Repositories\OrdersHoldsScheduleRepository;
use App\Services\Buyer\Cashback\CashbackScheduleService;
use App\Services\Buyer\Cashback\CashbackService;
use App\Services\Partner\AsAlone\RewardsService as PartnerAsAloneRewardsService;
use App\Services\Seller\RewardsService as SellerRewardsService;

class ProductReceivedService
{
    /** @var CashbackService $cashbackService */
    private $cashbackService;

    /** @var CashbackScheduleService $cashbackScheduleService */
    private $cashbackScheduleService;

    /** @var SellerRewardsService $sellerRewardsService */
    private $sellerRewardsService;

    /** @var PartnerAsAloneRewardsService $partnerAsAloneRewardsService */
    private $partnerAsAloneRewardsService;


    /** @var OrderItemRepository $orderItemRepository */
    private $orderItemRepository;

    /** @var OrdersHoldsScheduleRepository $ordersHoldsScheduleRepository */
    private $ordersHoldsScheduleRepository;

    public function __construct()
    {
        $this->cashbackService = app(CashbackService::class);
        $this->cashbackScheduleService = app(CashbackScheduleService::class);
        $this->sellerRewardsService = app(SellerRewardsService::class);
        $this->partnerAsAloneRewardsService = app(PartnerAsAloneRewardsService::class);

        $this->orderItemRepository = app(OrderItemRepository::class);
        $this->ordersHoldsScheduleRepository = app(OrdersHoldsScheduleRepository::class);
    }

    public function productHasBeenReceived(Order $order, int $period, bool $holdIsExpired = false)
    {
        $this->startCashback($order, $period);

        //Получить цены и комиссии
        $sellersPricesAndFees = $this->getPricesGroupedBySeller($order);

        //Добавить на балансы продавцам
        $this
            ->sellerRewardsService
            ->add($sellersPricesAndFees, $order);

        //Добавить на балансы одиночным партнерам
        $this
            ->partnerAsAloneRewardsService
            ->add($sellersPricesAndFees, $order);

        //Отметить холд как выполненный
        $this
            ->ordersHoldsScheduleRepository
            ->markAsCompleteByOrder(
                $order->id,
                $holdIsExpired
            );
    }

    /**
     * Добавить работу кэшбэка
     *
     * @param Order $order
     * @param int   $period
     */
    private function startCashback(Order $order, int $period): void
    {
        $this
            ->cashbackService
            ->setInProgressStatus($order)        //Статус "Идут выплаты"
            ->setPayoutsPeriod($order, $period); //Период выплат

        //Заполнить расписание выплат кэшбэка
        $this
            ->cashbackScheduleService
            ->fill($order, $period);
    }

    /**
     * Цены и комиссии сервиса, сгруппированные по продавцу
     *
     * @param Order $order
     *
     * @return array
     */
    private function getPricesGroupedBySeller(Order $order): array
    {
        $products = $this
            ->orderItemRepository
            ->getProductsByOrder($order->id);

        $pricesGroupBySeller = [];

        foreach ($products->toArray() as $product) {
            $sellerId = $product['product']['user_id'];

            $pricesGroupBySeller[$sellerId] = !empty($pricesGroupBySeller[$sellerId])
                ? $pricesGroupBySeller[$sellerId]
                : ['user_id' => $sellerId, 'amount' => 0, 'fee_amount' => 0];

            //Суммировать цену товаров
            $pricesGroupBySeller[$sellerId]['amount'] += $product['price'];

            //Суммировать комиссию сервиса
            $pricesGroupBySeller[$sellerId]['fee_amount'] += ($product['price'] * $product['product_percent_fee']) / 100;
        }

        return $pricesGroupBySeller;
    }
}