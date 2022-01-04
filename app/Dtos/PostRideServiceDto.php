<?php

namespace App\Dtos;

use Spatie\DataTransferObject\FlexibleDataTransferObject;

/**
 * PostRideService Class.
 *
 * @OA\Schema(schema="PostRideService",
 * title="Post ride service Dto",
 * required={"pickUp","dropOff","vehicleType"})
 */
class PostRideServiceDto extends FlexibleDataTransferObject
{
    /**
     * @OA\Property(
     * 	property="pickUp",
     * 	type="string",
     * 	example="Granada:10,20:40,10"
     * )
     */
    public string $pickUp;

    /**
     * @OA\Property(
     * 	property="dropOff",
     * 	type="string",
     * 	example="Barcelona:10,20:40,10,40"
     * )
     */
    public string $dropOff;

    /**
     * @OA\Property(
     * 	property="vehicleTypeId",
     * 	type="string",
     * 	example="uuiD"
     * )
     */
    public string $vehicleType;
}
