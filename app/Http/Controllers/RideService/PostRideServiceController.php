<?php

namespace App\Http\Controllers\RideService;

use Illuminate\Http\Request;
use App\Dtos\PostRideServiceDto;
use App\Http\Controllers\Controller;
use Microservice\Application\Services\Create\CreateRideServiceApplicationInterface;

class PostRideServiceController extends Controller
{
    public function __construct(
        CreateRideServiceApplicationInterface $createPostRideServiceApplication
    ) {
        $this->createPostRideServiceApplication = $createPostRideServiceApplication;
    }
    /**
     * @OA\Post(
     * 		path="/ride_service",
     * 		tags={"Ride Services"},
     * 		summary="Store a ride service",
     * 		description="Store a ride service",
     * 		operationId="StoreRideService",
     * 		security={
     *			{"bearerAuth": {}},
     *		},
     *		@OA\RequestBody(
     *			required=true,
     *			@OA\JsonContent(
     *				ref="#/components/schemas/PostRideService"
     *			)
     *		),
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


    public function __invoke(Request $request): array
    {
        $postDto = new PostRideServiceDto([
            'pickUp' => $request->pickUp,
            'dropOff' => $request->dropOff,
            'vehicleType' => $request->vehicleTypeId
        ]);


        return ($this->createPostRideServiceApplication)($postDto)->toArray();
    }
}
