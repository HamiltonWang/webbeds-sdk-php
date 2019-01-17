<?php
/**
 * User: Hamilton
 * Date: 12/12/2018
 * Time: 01:09 PM
 */
namespace webbeds\hotel_api_sdk\helpers;


/**
 * Class GetLanguages
 * @package webbeds\hotel_api_sdk\helpers
*/
class GetLanguages extends ApiHelper
{
    /**
     * GetLanguages constructor.
     */
    public function __construct()
    {
        $this->validFields = [
            "userName" => "string",
            "password" => "string"
        ];
    }
}