<?php
/**
 * User: Hamilton
 * Date: 12/12/2018
 * Time: 01:09 PM
 */
namespace webbeds\hotel_api_sdk\helpers\book;

use webbeds\hotel_api_sdk\helpers\ApiHelper;
/**
 * Class GetBookingInfo
 * @package webbeds\hotel_api_sdk\helpers
*/
class GetBookingInfo extends ApiHelper
{
    /**
     * GetBookingInfo constructor.
     */
    public function __construct()
    {
        $this->validFields = [
            "userName" => "string",
            "password" => "string",
            "language" => "string",
            "bookingID" => "string",
            "reference" => "string",
            "createdDateFrom" => "string",
            "createdDateTo" => "string",
            "arrivalDateFrom" => "string",
            "arrivalDateTo" => "string"
        ];
    }
}