<?php
/**
 * User: Hamilton
 * Date: 12/12/2018
 * Time: 01:12 PM
 */
namespace webbeds\hotel_api_sdk\messages\book;

use webbeds\hotel_api_sdk\messages\baseClass\ApiRequest;
use webbeds\hotel_api_sdk\types\ApiUri;
use webbeds\hotel_api_sdk\helpers\book\GetBookingInfo;
use Zend\Http\Request;


/**
 * Class LanguageReq
 * @package webbeds\hotel_api_sdk\messages
 */
class GetBookingInfoReq extends ApiRequest
{
    /**
     * LanguageReq constructor.
     * @param ApiUri $baseUri
     * @param GetBookingInfo $GetBookingInfoReq
     */
    public function __construct(ApiUri $baseUri, GetBookingInfo $getBookingInfoReq)
    {
        parent::__construct($baseUri, self::GET_BOOKING_INFORMATION);
        $this->request->setMethod(Request::METHOD_POST);
        $this->setDataRequest($getBookingInfoReq);
    }
}