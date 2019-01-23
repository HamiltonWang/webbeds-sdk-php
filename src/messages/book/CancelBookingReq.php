<?php
/**
 * User: Hamilton
 * Date: 12/12/2018
 * Time: 01:12 PM
 */
namespace webbeds\hotel_api_sdk\messages\book;

use webbeds\hotel_api_sdk\messages\baseClass\ApiRequest;
use webbeds\hotel_api_sdk\types\ApiUri;
use webbeds\hotel_api_sdk\helpers\book\CancelBooking;
use Zend\Http\Request;


/**
 * Class LanguageReq
 * @package webbeds\hotel_api_sdk\messages
 */
class CancelBookingReq extends ApiRequest
{
    /**
     * LanguageReq constructor.
     * @param ApiUri $baseUri
     * @param CancelBooking $CancelBookingReq
     */
    public function __construct(ApiUri $baseUri, CancelBooking $cancelBookingReq)
    {
        parent::__construct($baseUri, self::CANCEL_BOOKING);
        $this->request->setMethod(Request::METHOD_POST);
        $this->setDataRequest($cancelBookingReq);
    }
}