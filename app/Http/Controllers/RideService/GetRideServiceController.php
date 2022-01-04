<?php

namespace App\Http\Controllers\RideService;

use App\Http\Controllers\Controller;
use Microservice\Application\Services\Get\GetRideServiceApplicationInterface;

class GetRideServiceController extends Controller
{
    private GetRideServiceApplicationInterface $getRideServiceApplication;
    public function __construct(
        GetRideServiceApplicationInterface $getRideServiceApplication
    ) {
        $this->getRideServiceApplication = $getRideServiceApplication;
    }
    /**
     * @OA\Get(
     * 		path="/ride_service/{ride_service_id}",
     * 		tags={"Ride Services"},
     * 		summary="Get a ride service",
     * 		description="Get a ride service",
     * 		operationId="GetRideService",
     * 		security={
     *			{"bearerAuth": {}},
     *		},
     * 	   @OA\Parameter(
     * 		  name="ride_service_id",
     * 		  in="path",
     *        required=true,
     * 		  description="Filter by ride_service_id",
     * 		    @OA\Schema(
     *			    type="string"
     *		    )
     * 	    ),
     *		@OA\Response(
     *			response=200,
     *			description="Created ride service",
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
    public function __invoke(String $rideServiceId): array
    {
        return ($this->getRideServiceApplication)($rideServiceId)->toArray();
    }
}
