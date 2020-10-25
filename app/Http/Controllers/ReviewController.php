<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReviewResource;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    public function index(Product $product)
    {
        return ReviewResource::collection($product->reviews);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Review $review, Product $product)
    {
      return dd($product);
    }

    public function edit(Review $review)
    {
        //
    }

    public function update(Request $request, Review $review)
    {
        //
    }

    public function destroy(Review $review)
    {
        //
    }
}
