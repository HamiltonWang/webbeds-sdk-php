<?php
/**
 * User: Hamilton
 * Date: 12/12/2018
 * Time: 01:12 PM
 */
namespace webbeds\hotel_api_sdk\messages;

use webbeds\hotel_api_sdk\types\ApiUri;
use webbeds\hotel_api_sdk\helpers\GetDestinations;
use Zend\Http\Request;


/**
 * Class GetDestinationReq
 * @package webbeds\hotel_api_sdk\messages
 */
class GetDestinationsReq extends ApiRequest
{
    /**
     * GetDestinationsReq constructor.
     * @param ApiUri $baseUri
     * @param GetDestinations $getDestinationsReq
     */
    public function __construct(ApiUri $baseUri, GetDestinations $getDestinationsReq)
    {
        parent::__construct($baseUri, self::GET_DESTINATION);
        $this->request->setMethod(Request::METHOD_POST);
        $this->setDataRequest($getDestinationsReq);
    }
}