<?php
/**
 * User: Hamilton
 * Date: 12/12/2018
 * Time: 01:12 PM
 */
namespace webbeds\hotel_api_sdk\messages\search;

use webbeds\hotel_api_sdk\messages\baseClass\ApiRequest;
use webbeds\hotel_api_sdk\types\ApiUri;
use webbeds\hotel_api_sdk\helpers\search\GetTransferTypes;
use Zend\Http\Request;


/**
 * Class GetTransferTypeReq
 * @package webbeds\hotel_api_sdk\messages
 */
class GetTransferTypesReq extends ApiRequest
{
    /**
     * GetTransferTypesReq constructor.
     * @param ApiUri $baseUri
     * @param GetTransferTypes $getTransferTypesReq
     */
    public function __construct(ApiUri $baseUri, GetTransferTypes $getTransferTypesReq)
    {
        parent::__construct($baseUri, self::GET_TRANSFER_TYPES);
        $this->request->setMethod(Request::METHOD_POST);
        $this->setDataRequest($getTransferTypesReq);
    }
}