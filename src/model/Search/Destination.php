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
 * Class Destinations
 * @package webbeds\hotel_api_sdk\model
 * @property string userName User Name to use webBeds API
 * @property string password Password to use webBeds API
 */
class Destination extends ApiModel
{
    /**
     * Destinations constructor.
     * @property string userName User Name to use webBeds API
     * @property string password Password to use webBeds API
     */
    public function __construct(string $destination_id=null, string $destinationCode=null, string $destinationCode2=null, 
                                string $destinationCode3=null, string $destinationCode4=null, string $destinationName=null, 
                                string $countryId=null, string $countryName=null, string $countryCode=null, string $timeZone=null)
    {
        $this->validFields =
            [   "destination_id" => "string",
                "destinationCode" => "string",
                "destinationCode2" => "string",
                "destinationCode3" => "string",
                "destinationCode4" => "string",
                "destinationName" => "string",
                "countryId" => "string",
                "countryName" => "string",
                "countryCode" => "string",
                "timeZone" => "string",
            ];
             
        if ($destination_id !== null)
            $this->destination_id = $destination_id;

        if ($destinationCode !== null)
            $this->destinationCode = $destinationCode;
        if ($destinationCode2 !== null)
            $this->destinationCode2 = $destinationCode2;
        if ($destinationCode3 !== null)
            $this->destinationCode3 = $destinationCode3;
        if ($destinationCode4 !== null)
            $this->destinationCode4 = $destinationCode4;

        if ($destinationName !== null)
            $this->destinationName = $destinationName;

        if ($countryId !== null)
            $this->countryId = $countryId;
        if ($countryName !== null)
            $this->countryName = $countryName;
        if ($countryCode !== null)
            $this->countryCode = $countryCode;

        if ($timeZone !== null)
            $this->timeZone = $timeZone;
    }
}