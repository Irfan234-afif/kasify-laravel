<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemOrderResource extends JsonResource
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
            'name' => $this->name,
            'detail' => $this->pivot->detail,
            'quantity' => $this->pivot->quantity,
            'basic_price' => $this->basic_price,
            'selling_price' => $this->selling_price,
            // 'pivot' => [
            //     'quantity' => $this->pivot->quantity,
            //     'detail' => $this->pivot->detail,
            // ],
        ];
    }
}