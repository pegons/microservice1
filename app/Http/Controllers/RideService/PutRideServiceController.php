<?php

namespace App\Http\Controllers\RideService;

use Illuminate\Http\Request;
use App\Dtos\PutRideServiceDto;
use App\Http\Controllers\Controller;
use Microservice\Application\Services\Update\UpdateRideServiceApplicationInterface;

class PutRideServiceController extends Controller
{
    public function __construct(
        UpdateRideServiceApplicationInterface $updatePostRideServiceApplication
    ) {
        $this->updatePostRideServiceApplication = $updatePostRideServiceApplication;
    }
    /**
     * @OA\Put(
     * 		path="/ride_service",
     * 		tags={"Ride Services"},
     * 		summary="Put a ride service",
     * 		description="Put a ride service",
     * 		operationId="PutRideService",
     * 		security={
     *			{"bearerAuth": {}},
     *		},
     *		@OA\RequestBody(
     *			required=true,
     *			@OA\JsonContent(
     *				ref="#/components/schemas/PutRideService"
     *			)
     *		),
     *		@OA\Response(
     *			response=200,
     *			description="Updated ride service",
     *			@OA\JsonContent(ref="#/components/schemas/GetRideService")
     *		),
     *		@OA\Response(
     *			response=404,
     *			description="Not found"
     *		),
     *		@OA\Response(
     *			response=401,
     *			description="Unauthorized"
     *		)
     * )
     */


    public function __invoke(Request $request): array
    {
        $putDto = new PutRideServiceDto([
            'id' => $request->id,
            'pickUp' => $request->pickUp,
            'dropOff' => $request->dropOff,
            'vehicleType' => $request->vehicleTypeId
        ]);


        return ($this->updatePostRideServiceApplication)($putDto)->toArray();
    }
}
