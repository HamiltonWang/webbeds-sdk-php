<?php
/**
 * Created by PhpStorm.
 * User: Tomeu
 * Date: 11/4/2015
 * Time: 8:43 PM
 */
namespace webbeds\hotel_api_sdk\model\search;

use webbeds\hotel_api_sdk\model\ApiModel;

/**
 * Class Hotels
 * @package webbeds\hotel_api_sdk\model
 * @property string userName User Name to use webBeds API
 * @property string password Password to use webBeds API
 */
class Hotel extends ApiModel
{
    /**
     * Hotels constructor.
     * @property string userName User Name to use webBeds API
     * @property string password Password to use webBeds API
     */
    public function __construct(array $data=null)
    {
        $this->validFields =
            [   "hotelId" => "string",
                "destinationId" => "string",
                "resortId" => "string",
                "transfer" => "string",
                "notes" => "string",
                "codes" => "string",
                "type" => "string",
                "name" => "string",
                "hotelAddr1" => "string",
                "hotelAddr2" => "string",
                "hotelAddrZip" => "string",
                "hotelAddrCity" => "string",
                "hotelAddrState" => "string",
                "hotelAddrCountry" => "string",
                "hotelAddress" => "string",
                "hotelMapUrl" => "string",
                "headline" => "string",
                "description" => "string",
                "resort" => "string",
                "images" => "array",
                "hotelRoomType" => "array",
                "features" => "array",
                "classification" => "string",
                "latitude" => "string",
                "longitude" => "string",
                "distanceTypes" => "string",
                "roomtypes" => "array",
                "timeZone" => "string",
                "isBestBuy" => "string"

            ];
             
            if ($data !== null)
            {
                $this->fields = $data;
            }
    }
}