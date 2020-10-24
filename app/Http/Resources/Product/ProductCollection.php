<?php

namespace App\Http\Resources\Product;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductCollection extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this ->name,
            'totalPrise' => $this->discount >0?round((1 - ($this->discount/100))* $this->price, 2):$this->price,
            'discount' => $this->discount.'%',
            'rating' => $this->reviews->count() > 0 ? round($this->reviews->sum('star')/ $this->reviews->count(), 2): 'no review yet',
            'href' => route('products.show', $this->id)

        ];
    }
}
