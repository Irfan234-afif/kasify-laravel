<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // dd($this);
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'name' => $this->name,
            'code_product' => $this->code_product,
            'stock' => $this->stock,
            'description' => $this->description,
            'basic_price' => $this->basic_price,
            'selling_price' => $this->selling_price,
            'category' => [
                'category_id' => $this->category->id,
                'category_name' => $this->category->name,
            ],
        ];
    }
}