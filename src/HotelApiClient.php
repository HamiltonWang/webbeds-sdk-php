
<?php
/**
 * #%L
 * hotel-api-sdk
 * %%
 * Copyright (C) 2018-2019 Hamilton Wang
 * %%
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as
 * published by the Free Software Foundation, either version 2.1 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Lesser Public License for more details.
 *
 * You should have received a copy of the GNU General Lesser Public
 * License along with this program.  If not, see
 * <http://www.gnu.org/licenses/lgpl-2.1.html>.
 * #L%
 */

namespace webbeds\hotel_api_sdk;

use webbeds\hotel_api_sdk\model\AuditData;
use webbeds\hotel_api_sdk\types\ApiVersion;
use webbeds\hotel_api_sdk\types\ApiVersions;
use webbeds\hotel_api_sdk\types\HotelSDKException;

use Zend\Http\Client;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Uri\UriFactory;

class HotelApiClient
{
    /**
     * @var string Stores locally client password 
     */
    private $password;

    /**
     * @var string Stores locally client api key
     */
    private $userName;

    /**
     * @var Client HTTPClient object
     */
    private $httpClient;

    /**
     * @var Request Last sent request
     */
    private $lastRequest;
    /**
     * @var Response Last sent request
     */
    private $lastResponse;

    /**
     * HotelApiClient Constructor they initialize SDK Client.
     * @param string $url Base URL of hotel-api service.
     * @param string $userName Client userName
     * @param string $password
     * @param ApiVersion $version Version of Hotel API Interface
     * @param int $timeout HTTP Client timeout
     * @param string $adapter Customize adapter for http request
     */
    public function __construct($url, $userName, $password, ApiVersion $version, $timeout=30, $adapter=null)
    {
        $this->lastRequest = null;
        $this->userName = trim($userName);
        $this->password = trim($password);
        $this->httpClient = new Client();
        if($adapter!=null) {
            $this->httpClient->setOptions([
            		"adapter" => $adapter,
            		"timeout" => $timeout
            ]);
        }else{
            $this->httpClient->setOptions([
            		"timeout" => $timeout
            ]);
        }
        UriFactory::registerScheme("https","webbeds\\hotel_api_sdk\\types\\ApiUri");
        $this->apiUri = UriFactory::factory($url);
        $this->apiUri->prepare($version);
    }

    /**
     * @param $sdkMethod string Method request name.
     * @param $args array only specify a ApiHelper class type for encapsulate request arguments
     * @return ApiResponse Class of response. Each call type returns response class: For example BookingReq returns BookingResp
     * @throws HotelSDKException Specific exception of call
     */
    public function __call($sdkMethod, array $args=null)
    {
        $sdkClassReq = "webbeds\\hotel_api_sdk\\messages\\".$sdkMethod."Req";
        $sdkClassResp = "webbeds\\hotel_api_sdk\\messages\\".$sdkMethod."Resp";
        if (!class_exists($sdkClassReq) && !class_exists($sdkClassResp)){
            throw new HotelSDKException("$sdkClassReq or $sdkClassResp not implemented in SDK");
        }
        //if($sdkClassReq == "webbeds\\hotel_api_sdk\\messages\\BookingConfirmReq"){
        //	$req = new $sdkClassReq($this->apiUri, $this->apiPaymentUri, $args[0]);
        //}else{
	        if ($args !== null && count($args) > 0){
	            $req = new $sdkClassReq($this->apiUri, $args[0]);
	        } else {
	        	$req = new $sdkClassReq($this->apiUri);
	        }
        //}
        return new $sdkClassResp($this->callApi($req));
    }

    /**
     * Generic API Call, this is a internal used method for sending all requests to RESTful webservice 
     * XML response and transforms to PHP-Array object.
     * @param ApiRequest $request API Abstract request helper for construct request
     * @return array Response data into PHP Array structure
     * @throws HotelSDKException Calling exception, can capture remote server auditdata if exists.
     */
    private function callApi(ApiRequest $request)
    {
        try {
            $this->lastRequest = $request; // ->prepare($this->userName, $signature);
            $response = $this->httpClient->send($this->lastRequest);
            $this->lastResponse = $response;
        } catch (\Exception $e) {
            throw new HotelSDKException("Error accessing API: " . $e->getMessage());
        }
        if ($response->getStatusCode() !== 200) {
           $auditData = null;$message=''; $errorResponse = null;
           if ($response->getBody() !== null) {
               try {
                   $errorResponse = \Zend\Json\Json::decode($response->getBody(), \Zend\Json\Json::TYPE_ARRAY);
                   $auditData = new AuditData($errorResponse["auditData"]);
                   $message =$errorResponse["error"]["code"].' '.$errorResponse["error"]["message"];
               } catch (\Exception $e) {
                   throw new HotelSDKException($response->getReasonPhrase().': '.$response->getBody());
               }
           }
            throw new HotelSDKException($response->getReasonPhrase().': '.$message, $auditData);
        }
        return \Zend\XML\Json::decode(mb_convert_encoding($response->getBody(),'UTF-8'), \Zend\Json\Json::TYPE_ARRAY);
    }

    /**
     * @return Request getLastRequest Returns entire raw request
     */
    public function getLastRequest()
    {
        return $this->lastRequest;
    }
    /**
     * @return Response getLastResponse Returns entire raw response
     */
    public function getLastResponse()
    {
        return $this->lastResponse;
    }
}