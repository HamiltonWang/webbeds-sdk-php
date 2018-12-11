<?php
/**
 * User: Hamilton
 * Date: 12/11/2018
 * Time: 12:49 PM
 */
namespace webbeds\hotel_api_sdk\types;

use Zend\Uri\Http;
use StringTemplate;

/**
 * Class ApiUri
 * @package webbeds\hotel_api_sdk\types
 */
class ApiUri extends Http
{
    const BASE_PATH='/PostGet/NonStaticXMLAPI.asmx';
    const API_URI_FORMAT = '{version}/{basepath}';
    /**
     * Prepare URL for the operation
     * @param ApiVersion $version Version of API used for client
     */
    public function prepare(ApiVersion $version)
    {
        $strSubs = new StringTemplate\Engine;
        $this->setPath($strSubs->render(self::API_URI_FORMAT,
            ["basepath"  => self::BASE_PATH,
             "version"   => $version->getVersion()]));
    }
}