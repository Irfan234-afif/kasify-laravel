<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SalesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $order = $this->order;
        return [
            "id" => $this->id,
            "order_count" => $this->order_count,
            "revenue" => number_format($this->revenue, 0, '.', ''),
            "profit" => number_format($this->profit, 0, '.', ''),
            "created_at" => $this->created_at,
            "order" => [
                'order_id' => $order->id,
                'total_price' => $order->total_price,
                'item_count' => count($order->items),
                'order_at' => $order->order_at,
            ],
        ];
    }
}