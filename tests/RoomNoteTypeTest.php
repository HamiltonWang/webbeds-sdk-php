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
use webbeds\hotel_api_sdk\messages\search\GetRoomNoteTypesResp;
use webbeds\hotel_api_sdk\model\RoomNoteType;
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
    /**
     * @var bool lib using static or nonStatic, default to true
     */
    private $nonStatic;

    protected function setUp()
    {
        $this->lib = 'search';
        $this->nonStatic = true;
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
            $this->nonStatic,
            $cfgUri["timeout"],
            null);

        $this->language = 'en';
    }

    /**
     * API RoomNoteType Method test
     */
    public function testRoomNoteTypesReq()
    {
        $reqData = new \webbeds\hotel_api_sdk\helpers\search\GetRoomNoteTypes();
        
        $reqData->userName = $this->userName;
        $reqData->password = $this->password;
        $reqData->language = $this->language;
        
        $resp = $this->apiClient->GetRoomNoteTypes($reqData);
        //echo '--> testRoomNoteTypesReq:';
        //print_r( $resp);
        
        $this->assertNotEmpty($resp);
        return $resp;
    }

    /**
     * Testing GetRoomNoteTypesResp results of GetRoomNoteTypes method
     *
     * @depends testRoomNoteTypesReq
     */
    public function testRoomNoteTypeXMLResp(SimpleXMLElement $xmlResp)
    {
        //print_r( $this->apiClient->ConvertXMLToArray($xmlResp) );
        //print_r( $this->apiClient->ConvertXMLToNative($resp, "GetRoomNoteTypes") );
        //print_r($xmlResp);

        $this->assertEquals((string)$xmlResp->noteTypes->noteType[0]->attributes()->text, "Gala Dinner included");
        $native = $this->apiClient->ConvertXMLToNative($xmlResp, "GetRoomNoteTypes");

        $this->assertEquals(get_class($native), "webbeds\hotel_api_sdk\messages\search\GetRoomNoteTypesResp");
        return $native;
    }

    /**
     * Testing GetRoomNoteTypesResp results of GetRoomNoteTypes method
     *
     * @depends testRoomNoteTypeXMLResp
     */
    public function testRoomNoteTypeResp(GetRoomNoteTypesResp $getRoomNoteTypesResp)
    {
        // Check is response is empty or not
        $this->assertFalse($getRoomNoteTypesResp->isEmpty(), "Response is empty!");
        $this->assertEquals($getRoomNoteTypesResp->iterator()->current()->text, "Gala Dinner included");
        /*
        foreach ($getRoomNoteTypesResp->iterator() as $id => $roomNoteTypeData) {
            echo $roomNoteTypeData->id . ', '.$roomNoteTypeData->text .PHP_EOL;
        }*/
    }
}