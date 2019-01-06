<?php
/**
 * User: Hamilton
 * Date: 12/12/2018
 * Time: 01:12 PM
 */
namespace webbeds\hotel_api_sdk\messages;

use webbeds\hotel_api_sdk\types\ApiUri;
use webbeds\hotel_api_sdk\helpers\GetHotelNoteTypes;
use Zend\Http\Request;


/**
 * Class GetHotelNoteTypeReq
 * @package webbeds\hotel_api_sdk\messages
 */
class GetHotelNoteTypesReq extends ApiRequest
{
    /**
     * GetHotelNoteTypesReq constructor.
     * @param ApiUri $baseUri
     * @param GetHotelNoteTypes $getHotelNoteTypesReq
     */
    public function __construct(ApiUri $baseUri, GetHotelNoteTypes $getHotelNoteTypesReq)
    {
        parent::__construct($baseUri, self::GET_HOTEL_NOTE_TYPES);
        $this->request->setMethod(Request::METHOD_POST);
        $this->setDataRequest($getHotelNoteTypesReq);
    }
}