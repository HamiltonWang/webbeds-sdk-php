<?php
/**
 * User: Hamilton
 * Date: 12/12/2018
 * Time: 01:09 PM
 */
namespace webbeds\hotel_api_sdk\helpers\book;

use webbeds\hotel_api_sdk\helpers\ApiHelper;

/**
 * Class PreBookV2
 * @package webbeds\hotel_api_sdk\helpers\book
*/
class PreBookV2 extends ApiHelper
{
    /**
     * PreBookV2 constructor.
     */
    public function __construct()
    {
        $this->validFields = [
            "userName" => "string",
            "password" => "string",
            "language" => "string",
            "currency" => "string",
            "checkInDate" => "string",
            "checkOutDate" => "string",
            "numberOfRooms" => "integer",
            "roomId" => "string",
            "rooms" => "integer",
            "adults" => "integer",
            "children" => "integer",
            "childrenAges" => "string",
            "infant" => "integer",
            "mealId" => "integer",
            "customerCountry" => "string",
            "b2c" => "boolean",
            "searchPrice" => "string",
            "hotelId" => "string",
            "roomtypeId" => "string",
            "blockSuperDeal" => "string",
            "showPriceBreakdown" => "string"
        ];
    }
}