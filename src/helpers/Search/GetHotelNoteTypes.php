<?php
/**
 * User: Hamilton
 * Date: 12/12/2018
 * Time: 01:09 PM
 */
namespace webbeds\hotel_api_sdk\helpers\search;

use webbeds\hotel_api_sdk\helpers\ApiHelper;
/**
 * Class GetHotelNoteTypes
 * @package webbeds\hotel_api_sdk\helpers
*/
class GetHotelNoteTypes extends ApiHelper
{
    /**
     * GetHotelNoteTypes constructor.
     */
    public function __construct()
    {
        $this->validFields = [
            "userName" => "string",
            "password" => "string",
            "language" => "string"
        ];
    }
}