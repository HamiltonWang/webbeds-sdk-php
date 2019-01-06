<?php
/**
 * User: Hamilton
 * Date: 12/12/2018
 * Time: 01:12 PM
 */
namespace webbeds\hotel_api_sdk\messages;

use webbeds\hotel_api_sdk\types\ApiUri;
use webbeds\hotel_api_sdk\helpers\GetRoomNoteTypes;
use Zend\Http\Request;


/**
 * Class GetRoomNoteTypeReq
 * @package webbeds\hotel_api_sdk\messages
 */
class GetRoomNoteTypesReq extends ApiRequest
{
    /**
     * GetRoomNoteTypesReq constructor.
     * @param ApiUri $baseUri
     * @param GetRoomNoteTypes $getRoomNoteTypesReq
     */
    public function __construct(ApiUri $baseUri, GetRoomNoteTypes $getRoomNoteTypesReq)
    {
        parent::__construct($baseUri, self::GET_ROOM_NOTE_TYPES);
        $this->request->setMethod(Request::METHOD_POST);
        $this->setDataRequest($getRoomNoteTypesReq);
    }
}