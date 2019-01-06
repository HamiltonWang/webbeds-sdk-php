<?php
/**
 * User: Hamilton
 * Date: 12/12/2018
 * Time: 01:12 PM
 */
namespace webbeds\hotel_api_sdk\messages;

use webbeds\hotel_api_sdk\types\ApiUri;
use webbeds\hotel_api_sdk\helpers\GetRoomTypes;
use Zend\Http\Request;


/**
 * Class GetRoomTypeReq
 * @package webbeds\hotel_api_sdk\messages
 */
class GetRoomTypesReq extends ApiRequest
{
    /**
     * GetRoomTypesReq constructor.
     * @param ApiUri $baseUri
     * @param GetRoomTypes $getRoomTypesReq
     */
    public function __construct(ApiUri $baseUri, GetRoomTypes $getRoomTypesReq)
    {
        parent::__construct($baseUri, self::GET_ROOM_TYPES);
        $this->request->setMethod(Request::METHOD_POST);
        $this->setDataRequest($getRoomTypesReq);
    }
}