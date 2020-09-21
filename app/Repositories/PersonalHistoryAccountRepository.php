<?php


namespace App\Repositories;


use App\Models\PersonalHistoryAccount;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class PersonalHistoryAccountRepository
{
    /** @var PersonalHistoryAccount $model */
    private $model;

    public function __construct(PersonalHistoryAccount $personalHistoryAccount)
    {
        $this->model = $personalHistoryAccount;
    }

    public function store(array $item): PersonalHistoryAccount
    {
        return $this
            ->model
            ->create($item);
    }

    /**
     * История движения финансов
     *
     * @param int            $userId
     * @param array|string[] $sort
     *
     * @return Builder
     */
    public function historyByUser(int $userId, array $sort = ['id', 'desc']): Builder
    {
        return $this
            ->model
            ->query()
            ->with('paySystem')
            ->where('user_id', $userId)
            ->orderBy($sort[0], $sort[1]);
    }
}