<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Unit;
use App\Http\Requests\Units\{StoreUnitRequest, UpdateUnitRequest};
use App\Http\Resources\Units\{UnitCollection, UnitResource};
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): UnitCollection|UnitResource
    {
        return (new UnitCollection(Unit::paginate()))->additional([
            'message' => 'The units was received successfully.',
            'success' => true,
            'code' => Response::HTTP_OK
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUnitRequest $request): UnitResource|JsonResponse
    {

        $unit = Unit::create($request->validated());

        return (new UnitResource($unit))
            ->additional([
                'message' => 'The unit was created successfully.',
                'success' => true,
                'code' => Response::HTTP_CREATED
            ])
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): UnitResource
    {
        return (new UnitResource(Unit::findOrFail($id)))->additional([
            'message' => 'The unit was received successfully.',
            'success' => true,
            'code' => Response::HTTP_OK
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUnitRequest $request, string $id): UnitResource
    {
        $unit = Unit::findOrFail($id);

        $unit->update($request->validated());

        return (new UnitResource($unit))->additional([
            'message' => 'The unit was updated successfully.',
            'success' => true,
            'code' => Response::HTTP_OK
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): UnitResource|JsonResponse
    {
        try {
            Unit::destroy($id);

            return (new UnitResource(null))
                ->additional([
                    'message' => 'The unit was deleted successfully.',
                    'success' => true,
                    'code' => Response::HTTP_OK
                ]);
        } catch (\Exception $e) {
            return (new UnitResource(null))
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
