<?php
/**
 * User: Hamilton
 * Date: 12/12/2018
 * Time: 01:12 PM
 */
namespace webbeds\hotel_api_sdk\messages;

use webbeds\hotel_api_sdk\types\ApiUri;
use webbeds\hotel_api_sdk\helpers\Language;
use Zend\Http\Request;

/**
 * Class LanguageReq
 * @package webbeds\hotel_api_sdk\messages
 */
class LanguageReq extends ApiRequest
{
    /**
     * LanguageReq constructor.
     * @param ApiUri $baseUri
     * @param Language $languageDataReq
     */
    public function __construct(ApiUri $baseUri, Language $languageDataReq)
    {
        parent::__construct($baseUri, self::LANGUAGE);
        $this->request->setMethod(Request::METHOD_POST);
        $this->setDataRequest($languageDataReq);
    }
}