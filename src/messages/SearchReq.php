<?php
/**
 * User: Hamilton
 * Date: 12/12/2018
 * Time: 01:12 PM
 */
namespace webbeds\hotel_api_sdk\messages;

use webbeds\hotel_api_sdk\types\ApiUri;
use webbeds\hotel_api_sdk\helpers\Search;
use Zend\Http\Request;


/**
 * Class LanguageReq
 * @package webbeds\hotel_api_sdk\messages
 */
class SearchReq extends ApiRequest
{
    /**
     * LanguageReq constructor.
     * @param ApiUri $baseUri
     * @param Search $SearchReq
     */
    public function __construct(ApiUri $baseUri, Search $searchReq)
    {
        parent::__construct($baseUri, self::SEARCH);
        $this->request->setMethod(Request::METHOD_POST);
        $this->setDataRequest($searchReq);
    }
}