<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'description' => $this->detail,
            'price' => $this->price,
            'stoke' => $this->stoke ?: 'out of stoke',
            'discount' => $this->discount.'%',
            'totalPrise' => $this->discount >0?round((1 - ($this->discount/100))* $this->price, 2):0,
            'rating' => $this->reviews->count() > 0 ? round($this->reviews->sum('star')/ $this->reviews->count(), 2): 'no review yet',
            'reviews' => route('reviews.index', $this->id)
        ];
    }
}
