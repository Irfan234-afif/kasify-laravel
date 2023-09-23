<?php

namespace App\Http\Resources;

use App\Http\Resources\ItemOrderResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'name' => $this->name,
            'total_price' => $this->total_price,
            'order_at' => $this->order_at,
            'items' => ItemOrderResource::collection($this->items),
        ];
    }
}