<?php
/**
 * User: Hamilton
 * Date: 12/12/2018
 * Time: 01:09 PM
 */
namespace webbeds\hotel_api_sdk\helpers\book;

use webbeds\hotel_api_sdk\helpers\ApiHelper;
/**
 * Class Book
 * @package webbeds\hotel_api_sdk\helpers
*/
class Book extends ApiHelper
{
    /**
     * Book constructor.
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
            "createdDateTo" => "integer",
            "arrivalDateFrom" => "string",
            "arrivalDateTo" => "integer"
        ];
    }
}