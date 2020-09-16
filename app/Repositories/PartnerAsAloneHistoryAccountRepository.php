<?php


namespace App\Repositories;


use App\Models\PartnerAsAloneHistoryAccount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class UserRepository
 *
 * @package App\Repositories
 * @author  Anton Reviakin
 */
class PartnerAsAloneHistoryAccountRepository
{
    /** @var PartnerAsAloneHistoryAccount */
    private $model;

    public function __construct(PartnerAsAloneHistoryAccount $model)
    {
        $this->model = $model;
    }

    /**
     * История начислений
     *
     * @param int $receiver_id
     *
     * @return Collection
     */
    public function get(int $receiver_id): Collection
    {
        return $this->model
            ->query()
            ->with('sender')
            ->where(compact('receiver_id'))
            ->get();
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