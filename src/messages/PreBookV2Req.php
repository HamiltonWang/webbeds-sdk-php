<?php
/**
 * User: Hamilton
 * Date: 12/12/2018
 * Time: 01:12 PM
 */
namespace webbeds\hotel_api_sdk\messages;

use webbeds\hotel_api_sdk\types\ApiUri;
use webbeds\hotel_api_sdk\helpers\PreBookV2;
use Zend\Http\Request;


/**
 * Class LanguageReq
 * @package webbeds\hotel_api_sdk\messages
 */
class PreBookV2Req extends ApiRequest
{
    /**
     * LanguageReq constructor.
     * @param ApiUri $baseUri
     * @param PreBookV2 $PreBookV2Req
     */
    public function __construct(ApiUri $baseUri, PreBookV2 $preBookV2Req)
    {
        parent::__construct($baseUri, self::PREBOOKV2);
        $this->request->setMethod(Request::METHOD_POST);
        $this->setDataRequest($preBookV2Req);
    }
}