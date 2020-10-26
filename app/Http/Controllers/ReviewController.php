<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Models\Product;
use App\Models\Review;
use \Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->except(['index', 'show']);
    }

    public function index(Product $product)
    {
        return ReviewResource::collection($product->reviews);
    }

    public function store(ReviewRequest $request, Product $product)
    {
        $review = new Review($request->all());
        $product->reviews()->save($review);
        return response()->json([
            'data' => new ReviewResource($review)
        ], Response::HTTP_CREATED);
    }

    public function show(Review $review, Product $product)
    {
      return dd($product);
    }

    public function edit(Review $review)
    {
        //
    }

    public function update(ReviewRequest $request, Review $review)
    {
        //
    }

    public function destroy(Review $review)
    {
        //
    }
}
