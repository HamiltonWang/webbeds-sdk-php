<?php
/**
 * User: Hamilton
 * Date: 12/12/2018
 * Time: 01:12 PM
 */
namespace webbeds\hotel_api_sdk\messages\search;

use webbeds\hotel_api_sdk\messages\baseClass\ApiRequest;
use webbeds\hotel_api_sdk\types\ApiUri;
use webbeds\hotel_api_sdk\helpers\search\GetLanguages;
use Zend\Http\Request;


/**
 * Class LanguageReq
 * @package webbeds\hotel_api_sdk\messages
 */
class GetLanguagesReq extends ApiRequest
{
    /**
     * LanguageReq constructor.
     * @param ApiUri $baseUri
     * @param GetLanguages $getLanguagesReq
     */
    public function __construct(ApiUri $baseUri, GetLanguages $getLanguagesReq)
    {
        parent::__construct($baseUri, self::GET_LANGUAGES);
        $this->request->setMethod(Request::METHOD_POST);
        $this->setDataRequest($getLanguagesReq);
    }
}