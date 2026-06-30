<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'customer_id' => $this->customer_id,
            'ammount' => $this->ammount,
            'shipping_address' => $this->shipping_address,
            'order_address' => $this->order_address,
            'order_email' => $this->order_email,
            'order_date' => $this->order_date,
            'order_status' => $this->order_status,
            'customer' => new CustomerResource($this->whenLoaded('customer')),
            'order_details' => OrderDetailResource::collection($this->whenLoaded('orderDetails')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
