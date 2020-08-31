<?php


namespace App\Repositories;


use App\Models\PartnerHistoryAccount;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class UserRepository
 *
 * @package App\Repositories
 * @author  Anton Reviakin
 */
class PartnerHistoryAccountRepository
{
    /** @var Model */
    private $model;

    public function __construct(PartnerHistoryAccount $model)
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


}