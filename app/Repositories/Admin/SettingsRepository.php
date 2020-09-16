<?php

namespace App\Repositories\Admin;

use App\Models\Setting;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SettingsRepository
{
    /** @var Setting $model */
    private $model;

    public function __construct(Setting $model)
    {
        $this->model = $model;
    }

    /**
     * Список настроек
     *
     * @return LengthAwarePaginator
     */
    public function listSettings(): LengthAwarePaginator
    {
        return $this
            ->model
            ->query()
            ->paginate(30);
    }

    /**
     * Вернуть настройку по параметру
     *
     * @param string $slug
     *
     * @return Setting|null
     */
    public function getSingleItem(string $slug): ?Setting
    {
        $item = $this
            ->model
            ->query()
            ->where('slug', $slug)
            ->first();

        if (!$item) {
            return $item;
        }

        //Если поле JSON
        if ($item->is_json) {
            $item->value = json_decode($item->value, true);
        }

        return $item;
    }
}
