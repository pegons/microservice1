<?php

namespace App\Dtos;

use Spatie\DataTransferObject\FlexibleDataTransferObject;

/**
 * PutRideService Class.
 *
 * @OA\Schema(schema="PutRideService",
 * title="Put ride service Dto",
 * required={"ip", "pickUp","dropOff","vehicleType"})
 */
class PutRideServiceDto extends FlexibleDataTransferObject
{
    /**
     * @OA\Property(
     * 	property="id",
     * 	type="string",
     * 	example="uuid"
     * )
     */
    public string $id;

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
