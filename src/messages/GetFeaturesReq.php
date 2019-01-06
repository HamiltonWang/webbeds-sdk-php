<?php
/**
 * User: Hamilton
 * Date: 12/12/2018
 * Time: 01:12 PM
 */
namespace webbeds\hotel_api_sdk\messages;

use webbeds\hotel_api_sdk\types\ApiUri;
use webbeds\hotel_api_sdk\helpers\GetFeatures;
use Zend\Http\Request;


/**
 * Class GetFeatureReq
 * @package webbeds\hotel_api_sdk\messages
 */
class GetFeaturesReq extends ApiRequest
{
    /**
     * GetFeaturesReq constructor.
     * @param ApiUri $baseUri
     * @param GetFeatures $getFeaturesReq
     */
    public function __construct(ApiUri $baseUri, GetFeatures $getFeaturesReq)
    {
        parent::__construct($baseUri, self::GET_FEATURES);
        $this->request->setMethod(Request::METHOD_POST);
        $this->setDataRequest($getFeaturesReq);
    }
}