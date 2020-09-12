<?php


namespace App\Repositories;


use App\Models\PaymentOption;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class PaySystemsRepository
{
    /** @var PaymentOption $model */
    private $model;

    public function __construct(PaymentOption $model)
    {
        $this->model = $model;
    }

    /**
     * Список
     *
     * @param Builder $builder
     *
     * @return Builder
     */
    public function list(): Builder
    {
        return $this
            ->model
            ->query()
            ->orderBy('sort');
    }

    /**
     * Получить платежную систему по id
     *
     * @param int $id
     *
     * @return PaymentOption|null
     */
    public function getById(int $id): ?PaymentOption
    {
        return $this
            ->model
            ->query()
            ->where(compact('id'))
            ->firstOrFail();
    }

    /**
     * Список платежных систем для оплаты заказа
     *
     * @return Collection
     */
    public function listForPurchasing(): Collection
    {
        return $this
            ->model
            ->purchasing()
            ->get();
    }
}