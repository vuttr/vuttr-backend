<?php

namespace App\Serializers;

use App\Models\Tool;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ToolResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->getKey(),
            'title' => $this->getAttribute('title'),
            'link' => $this->getAttribute('link'),
            'description' => $this->getAttribute('description'),
            'tags' => $this->tags()->pluck('name'),
        ];
    }
}
