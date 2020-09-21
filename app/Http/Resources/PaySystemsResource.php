<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class PaySystemsResource
 *
 * @package App\Http\Resources
 * @property int    $id
 * @property string $title
 * @property string $slug
 * @property string $icon
 */
class PaySystemsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'    => $this->id,
            'title' => $this->title,
            'slug'  => $this->slug,
            'icon'  => $this->icon,
        ];
    }
}
