<?php

namespace App\Http\Controllers;

use App\Exceptions\ProductNotBelongsToUser;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * ProductController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index', 'show']);
    }

    public function index()
    {
        return ProductCollection::collection(Product::paginate(10));
    }

    public function store(ProductRequest $request)
    {
        if ($request->json()) {
            $project = Product::create([
                "name" => $request->name,
                "user_id" => auth()->id(),
                "detail" => $request->description,
                "price" => $request->price,
                "stock" => $request->stock,
                "discount" => $request->discount,
            ]);
            return response(["data" => new ProductResource($project)], Response::HTTP_CREATED);
        } else {
            return "error";
        }
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    public function update(Request $request, Product $product)
    {
        $this->productUserCheck($product);
        if($request->has('description')) {
            $request['detail'] = $request->description;
            unset($request['description']);
        }
        $product->update($request->all());

        return response(["data" => new ProductResource($product)], Response::HTTP_CREATED);
    }

    public function destroy(Product $product)
    {
        $this->productUserCheck($product);
        try {
            $product->delete();
            return \response(null, Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return response($e, 404);
        }
    }

    public function productUserCheck($product)
    {
        if (auth()->user()->id !== $product->id) {
            throw new ProductNotBelongsToUser;
        }
    }
}
