<?php


namespace App\Repositories;


use App\Models\SellerHistoryAccount;

class SellerHistoryAccountRepository
{
    /** @var SellerHistoryAccount $model */
    private $model;

    public function __construct(SellerHistoryAccount $model)
    {
        $this->model = $model;
    }

    /**
     * Добавить
     *
     * @param array $item
     *
     * @return SellerHistoryAccount
     */
    public function store(array $item): SellerHistoryAccount
    {
        return $this
            ->model
            ->query()
            ->create($item);
    }

    /**
     * Заполнить историю
     *
     * @param array $items
     *
     * @return bool
     */
    public function fill(array $items): bool
    {
        return $this
            ->model
            ->query()
            ->insert($items);
    }
    
}