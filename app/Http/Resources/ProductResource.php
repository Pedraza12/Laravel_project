<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'sku' => $this->sku,
            'name' => $this->name,
            'price' => $this->price,
            'weight' => $this->weight,
            'descriptions' => $this->descriptions,
            'thumbnail' => $this->thumbnail,
            'image' => $this->image,
            'category' => $this->category,
            'create_date' => $this->create_date,
            'stock' => $this->stock,
            'categories' => CategoryResource::collection($this->whenLoaded('categories')),
            'options' => OptionResource::collection($this->whenLoaded('options')),
            'order_details' => OrderDetailResource::collection($this->whenLoaded('orderDetails')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
