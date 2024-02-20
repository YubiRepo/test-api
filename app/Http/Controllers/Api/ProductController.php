<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Http\Requests\Products\{StoreProductRequest, UpdateProductRequest};
use App\Http\Resources\Products\{ProductCollection, ProductResource};
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): ProductCollection|ProductResource
    {
        $products = Product::with(['unit:id,name'])->paginate();
        $products->through(function ($product) {
            if (!$product->image) {
                $product->image = 'https://via.placeholder.com/350?text=' . str_replace(' ', '+', $product->name);
            } else {
                $product->image =  asset('/storage/uploads/images/' . $product->image);
            }

            return $product;
        });

        return (new ProductCollection($products))->additional([
            'message' => 'The products was received successfully.',
            'success' => true,
            'code' => Response::HTTP_OK
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request): ProductResource|JsonResponse
    {
        $validated = $request->validated();

        if ($request->file('image') && $request->file('image')->isValid()) {
            $path = storage_path('app/public/uploads/images/');
            $filename = $request->file('image')->hashName();

            if (!file_exists($path)) mkdir($path, 0777, true);

            Image::make($request->file('image')->getRealPath())->resize(500, 500, function ($constraint) {
                $constraint->upsize();
				$constraint->aspectRatio();
            })->save($path . $filename);

            $validated['image'] = $filename;
        }

        $product = Product::create($validated);

        return (new ProductResource($product))
            ->additional([
                'message' => 'The product was created successfully.',
                'success' => true,
                'code' => Response::HTTP_CREATED
            ])
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): ProductResource
    {
        $product = Product::with(['unit:id,name'])->findOrFail($id);
        if (!$product->image) {
            $product->image = 'https://via.placeholder.com/350?text=' . str_replace(' ', '+', $product->name);
        } else {
            $product->image =  asset('/storage/uploads/images/' . $product->image);
        }

        return (new ProductResource($product))->additional([
            'message' => 'The product was received successfully.',
            'success' => true,
            'code' => Response::HTTP_OK
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id): ProductResource
    {
        $product = Product::with(['unit:id,name'])->findOrFail($id);
        $validated = $request->validated();

        if ($request->file('image') && $request->file('image')->isValid()) {
            $path = storage_path('app/public/uploads/images/');
            $filename = $request->file('image')->hashName();

            if (!file_exists($path)) mkdir($path, 0777, true);

            Image::make($request->file('image')->getRealPath())->resize(500, 500, function ($constraint) {
                $constraint->upsize();
				$constraint->aspectRatio();
            })->save($path . $filename);

            // delete old image from storage
            if ($product->image != null && file_exists($path . $product->image)) unlink($path . $product->image);

            $validated['image'] = $filename;
        }

        $product->update($validated);

        return (new ProductResource($product))->additional([
            'message' => 'The product was updated successfully.',
            'success' => true,
            'code' => Response::HTTP_OK
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): ProductResource|JsonResponse
    {
        try {
            $product = Product::with(['unit:id,name'])->findOrFail($id);

            $path = storage_path('app/public/uploads/images/');

            if ($product->image != null && file_exists($path . $product->image)) unlink($path . $product->image);

            $product->delete();

            return (new ProductResource(null))
                ->additional([
                    'message' => 'The product was deleted successfully.',
                    'success' => true,
                    'code' => Response::HTTP_OK
                ]);
        } catch (\Exception $e) {
            return (new ProductResource(null))
                ->additional([
                    'message' => $e->getMessage(),
                    'success' => false,
                    'code' => Response::HTTP_INTERNAL_SERVER_ERROR
                ])
                ->response()
                ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
