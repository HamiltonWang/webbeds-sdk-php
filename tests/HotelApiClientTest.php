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
use webbeds\hotel_api_sdk\messages\search\GetLanguagesResp;
use webbeds\hotel_api_sdk\model\Language;
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


    protected function setUp()
    {
        $reader = new Zend\Config\Reader\Ini();
        $commonConfig   = $reader->fromFile(__DIR__ . '/config/Common.ini');
        $currentEnvironment = $commonConfig["environment"]? $commonConfig["environment"]: "DEFAULT";
        $environmentConfig   = $reader->fromFile(__DIR__ . '/config/Environment.' . strtoupper($currentEnvironment) . '.ini');
        $cfgUri = $commonConfig["url"];
        $cfgApi = $environmentConfig["apiclient"];
        $this->userName = $cfgApi["userName"];
        $this->password = $cfgApi["password"];
        $this->apiClient = new HotelApiClient($cfgUri["search"],
            $cfgApi["userName"],
            $cfgApi["password"],
            new ApiVersion(ApiVersions::V1_0),
            "search",
            $cfgUri["timeout"],
            null);
    }

    /**
     * API Language Method test
     */
    public function testLanguagesReq()
    {
        $reqData = new \webbeds\hotel_api_sdk\helpers\search\GetLanguages();
        
        $reqData->userName = $this->userName;
        $reqData->password = $this->password;
        
        $resp = $this->apiClient->GetLanguages($reqData);
        //echo '--> testLanguagesReq:';
        //print_r( $resp);
        
        $this->assertNotEmpty($resp);
        return $resp;
    }

    /**
     * Testing GetLanguagesResp results of GetLanguages method
     *
     * @depends testLanguagesReq
     */
    public function testLanguageXMLResp(SimpleXMLElement $xmlResp)
    {
        //print_r( $this->apiClient->ConvertXMLToArray($xmlResp) );
        //print_r( $this->apiClient->ConvertXMLToNative($resp, "GetLanguages") );
        //print_r($xmlResp);

        $this->assertEquals((string)$xmlResp->languages->language[0]->name, "English");
        $native = $this->apiClient->ConvertXMLToNative($xmlResp, "GetLanguages");

        $this->assertEquals(get_class($native), "webbeds\hotel_api_sdk\messages\search\GetLanguagesResp");
        return $native;
    }

    /**
     * Testing GetLanguagesResp results of GetLanguages method
     *
     * @depends testLanguageXMLResp
     */
    public function testLanguageResp(GetLanguagesResp $getLanguagesResp)
    {
        // Check is response is empty or not
        $this->assertFalse($getLanguagesResp->isEmpty(), "Response is empty!");
        foreach ($getLanguagesResp->iterator() as $isoCode => $languageData) {
            echo $languageData->isoCode . ', '.$languageData->name. "".PHP_EOL;
        }
    }
}