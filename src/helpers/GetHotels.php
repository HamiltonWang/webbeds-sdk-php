<?php
/**
 * User: Hamilton
 * Date: 12/12/2018
 * Time: 01:09 PM
 */
namespace webbeds\hotel_api_sdk\helpers;


/**
 * Class GetHotels
 * @package webbeds\hotel_api_sdk\helpers
*/
class GetHotels extends ApiHelper
{
    /**
     * GetHotels constructor.
     */
    public function __construct()
    {
        $this->validFields = [
            "userName" => "string",
            "password" => "string",
            "language" => "string",
            "destination" => "string",
            "hotelIds" => "string",
            "resortIds" => "string",
            "accommodationTypes" => "string",
            "sortBy" => "string",
            "sortOrder" => "string",
            "exactDestinationMatch" => "string"
        ];
    }
}