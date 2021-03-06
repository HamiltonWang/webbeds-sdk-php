<?php
/**
 * User: Hamilton
 * Date: 12/12/2018
 * Time: 01:12 PM
 */
namespace webbeds\hotel_api_sdk\messages\book;

use webbeds\hotel_api_sdk\messages\baseClass\ApiRequest;
use webbeds\hotel_api_sdk\types\ApiUri;
use webbeds\hotel_api_sdk\helpers\book\Book;
use Zend\Http\Request;


/**
 * Class LanguageReq
 * @package webbeds\hotel_api_sdk\messages
 */
class BookReq extends ApiRequest
{
    /**
     * LanguageReq constructor.
     * @param ApiUri $baseUri
     * @param Book $BookReq
     */
    public function __construct(ApiUri $baseUri, Book $bookReq)
    {
        parent::__construct($baseUri, self::BOOK);
        $this->request->setMethod(Request::METHOD_POST);
        $this->setDataRequest($bookReq);
    }
}