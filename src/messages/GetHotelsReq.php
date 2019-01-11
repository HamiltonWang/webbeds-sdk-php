<?php
/**
 * User: Hamilton
 * Date: 12/12/2018
 * Time: 01:12 PM
 */
namespace webbeds\hotel_api_sdk\messages;

use webbeds\hotel_api_sdk\types\ApiUri;
use webbeds\hotel_api_sdk\helpers\GetHotels;
use Zend\Http\Request;


/**
 * Class GetHotelReq
 * @package webbeds\hotel_api_sdk\messages
 */
class GetHotelsReq extends ApiRequest
{
    /**
     * GetHotelsReq constructor.
     * @param ApiUri $baseUri
     * @param GetHotels $getHotelsReq
     */
    public function __construct(ApiUri $baseUri, GetHotels $getHotelsReq)
    {
        parent::__construct($baseUri, self::GET_STATIC_HOTELS_AND_ROOMS);
        $this->request->setMethod(Request::METHOD_POST);
        $this->setDataRequest($getHotelsReq);
    }
}