<?php

namespace App\Dtos;

use Spatie\DataTransferObject\FlexibleDataTransferObject;

/**
 * GetRideService Class.
 *
 *
 * @OA\Schema(schema="GetRideService",
 * title="Get ride service Dto")
 */
class GetRideServiceDto extends FlexibleDataTransferObject
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
     * 	example="uuid"
     * )
     */
    public string $vehicleTypeId;

    /**
     * @OA\Property(
     * 	property="createdAt",
     * 	type="string",
     *	format="date",
     *	example="2020-12-10"
     * )
     */
    public string $createdAt;
}
