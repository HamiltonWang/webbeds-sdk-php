<?php

/**
 * #%L
 * hotel-api-sdk
 * %%
 * Copyright (C) 2018 Hamilton
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

use webbeds\hotel_api_sdk\HotelApiClient;
use webbeds\hotel_api_sdk\types\ApiVersion;
use webbeds\hotel_api_sdk\types\ApiVersions;
use webbeds\hotel_api_sdk\messages\search\GetFeaturesResp;
use webbeds\hotel_api_sdk\model\Feature;
use PHPUnit\Framework\TestCase;

class HotelApiClientTest extends TestCase
{
    /**
     * @var HotelApiClient
     */
    private $apiClient;
    /**
     * @var string userName User Name to use webBeds API
     */
    private $userName;
    /**
     * @var string password Password to use webBeds API
     */
    private $password;
    /**
     * @var string language language to retrieve your data
     */
    private $language;
    /**
     * @var string lib search api or book api
     */
    private $lib;

    protected function setUp()
    {
        $this->lib = 'search';
        $reader = new Zend\Config\Reader\Ini();
        $commonConfig   = $reader->fromFile(__DIR__ . '/config/Common.ini');
        $currentEnvironment = $commonConfig["environment"]? $commonConfig["environment"]: "DEFAULT";
        $environmentConfig   = $reader->fromFile(__DIR__ . '/config/Environment.' . strtoupper($currentEnvironment) . '.ini');
        $cfgUri = $commonConfig["url"];
        $cfgApi = $environmentConfig["apiclient"];
        $this->userName = $cfgApi["userName"];
        $this->password = $cfgApi["password"];
        $this->apiClient = new HotelApiClient($cfgUri[$this->lib],
            $cfgApi["userName"],
            $cfgApi["password"],
            new ApiVersion(ApiVersions::V1_0),
            $this->lib,
            $cfgUri["timeout"],
            null);

        $this->language = 'en';
    }

    /**
     * API Feature Method test
     */
    public function testFeaturesReq()
    {
        $reqData = new \webbeds\hotel_api_sdk\helpers\search\GetFeatures();
        
        $reqData->userName = $this->userName;
        $reqData->password = $this->password;
        $reqData->language = $this->language;
        
        $resp = $this->apiClient->GetFeatures($reqData);
        //echo '--> testFeaturesReq:';
        //print_r( $resp);
        
        $this->assertNotEmpty($resp);
        return $resp;
    }

    /**
     * Testing GetFeaturesResp results of GetFeatures method
     *
     * @depends testFeaturesReq
     */
    public function testFeatureXMLResp(SimpleXMLElement $xmlResp)
    {
        //print_r( $this->apiClient->ConvertXMLToArray($xmlResp) );
        //print_r( $this->apiClient->ConvertXMLToNative($resp, "GetFeatures") );
        //print_r($xmlResp);

        $this->assertEquals((string)$xmlResp->features->feature[0]->attributes()->name, "Air Conditioning");
        $native = $this->apiClient->ConvertXMLToNative($xmlResp, "GetFeatures");

        $this->assertEquals(get_class($native), "webbeds\\hotel_api_sdk\\messages\\$this->lib\\GetFeaturesResp");
        return $native;
    }

    /**
     * Testing GetFeaturesResp results of GetFeatures method
     *
     * @depends testFeatureXMLResp
     */
    public function testFeatureResp(GetFeaturesResp $getFeaturesResp)
    {
        // Check is response is empty or not
        $this->assertFalse($getFeaturesResp->isEmpty(), "Response is empty!");
        $this->assertEquals($getFeaturesResp->iterator()->current()->name, "Air Conditioning");
        
        foreach ($getFeaturesResp->iterator() as $id => $featureData) {
            echo $featureData->id . ', '.$featureData->name .PHP_EOL;
        }
    }
}