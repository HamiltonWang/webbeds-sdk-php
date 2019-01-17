<?php
/**
 * User: Hamilton
 * Date: 12/12/2018
 * Time: 01:09 PM
 */
namespace webbeds\hotel_api_sdk\helpers;


/**
 * Class GetTransferTypes
 * @package webbeds\hotel_api_sdk\helpers
*/
class GetTransferTypes extends ApiHelper
{
    /**
     * GetTransferTypes constructor.
     */
    public function __construct()
    {
        $this->validFields = [
            "userName" => "string",
            "password" => "string",
            "language" => "string",
            "transferTypeCode" => "string"
        ];
    }
}