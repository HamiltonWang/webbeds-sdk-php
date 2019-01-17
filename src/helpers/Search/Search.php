<?php
/**
 * User: Hamilton
 * Date: 12/12/2018
 * Time: 01:09 PM
 */
namespace webbeds\hotel_api_sdk\helpers\search;

use webbeds\hotel_api_sdk\helpers\ApiHelper;
/**
 * Class Search
 * @package webbeds\hotel_api_sdk\helpers
*/
class Search extends ApiHelper
{
    /**
     * Search constructor.
     */
    public function __construct()
    {
        $this->validFields = [
            "userName" => "string",
            "password" => "string",
            "language" => "string",
            "currencies" => "string",
            "checkInDate" => "string",
            "checkOutDate" => "string",
            "numberOfRooms" => "integer",
            "destination" => "string",
            "destinationId" => "integer",
            "hotelIds" => "string",
            "resortIds" => "string",
            "accommodationTypes" => "string",
            "numberOfAdults" => "integer",
            "numberOfChildren" => "integer",
            "childrenAges" => "string",
            "infant" => "integer",
            "sortBy" => "string",
            "sortOrder" => "string",
            "exactDestinationMatch" => "boolean",
            "blockSuperdeal" => "boolean",
            "mealIds" => "string",
            "showCoordinates" => "string",
            "showReviews" => "string",
            "referencePointLatitude" => "string",
            "referencePointLongitude" => "string",
            "maxDistanceFromReferencePoint" => "string",
            "minStarRating" => "string",
            "maxStarRating" => "string",
            "featureIds" => "string",
            "minPrice" => "string",
            "maxPrice" => "string",
            "themeIds" => "string",
            "excludeSharedRooms" => "boolean",
            "excludeSharedFacilities" => "string",
            "prioritizedHotelIds" => "string",
            "totalRoomsInBatch" => "string",
            "paymentMethodId" => "string",
            "customerCountry" => "string",
            "b2c" => "boolean"
        ];
    }
}