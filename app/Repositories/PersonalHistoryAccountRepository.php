<?php


namespace App\Repositories;


use App\Models\PersonalHistoryAccount;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

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
     * @return LengthAwarePaginator
     */
    public function historyByUser(int $userId, array $sort = ['id', 'asc']): LengthAwarePaginator
    {
        return $this
            ->model
            ->query()
            ->with('paySystem')
            ->where('user_id', $userId)
            ->orderBy($sort)
            ->paginate(10);
    }
}