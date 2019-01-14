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
use webbeds\hotel_api_sdk\messages\GetHotelsResp;
use webbeds\hotel_api_sdk\model\Hotel;
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
     * @var string destination Destination parameter
     */
    private $destination;
    /**
     * @var string hotelIds hotelIds to specify a hotel
     */
    private $hotelIds;
    /**
     * @var string resortIds resortIds to specify a resrt
     */
    private $resortIds;
    /**
     * @var string accommodationTypes accommodationTypes to specify an accommodation type
     */
    private $accommodationTypes;
    /**
     * @var string sortBy SortBy to sort your data
     */
    private $sortBy;
    /**
     * @var string sortOrder sortOrder to order your data
     */
    private $sortOrder;
    /**
     * @var string exactDestinationMatch ExactHotelMatch to specify a precise hotel code match
     */
    private $exactDestinationMatch;
    
    protected function setUp()
    {
        $reader = new Zend\Config\Reader\Ini();
        $commonConfig   = $reader->fromFile(__DIR__ . '\config\Common.ini');
        $currentEnvironment = $commonConfig["environment"]? $commonConfig["environment"]: "DEFAULT";
        $environmentConfig   = $reader->fromFile(__DIR__ . '\config\Environment.' . strtoupper($currentEnvironment) . '.ini');
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

        $this->language = 'en';
        $this->destination = '2327';
        $this->hotelIds = ''; //'126267';
        $this->resortIds ='';
        $this->accommodationTypes ='';
        $this->sortBy = '';
        $this->sortOrder = '';
        $this->exactDestinationMatch = '';
    }

    /**
     * API Hotel Method test
     */
    public function testHotelsReq()
    {
        $reqData = new \webbeds\hotel_api_sdk\helpers\GetHotels();
        
        $reqData->userName = $this->userName;
        $reqData->password = $this->password;
        $reqData->language = $this->language;
        $reqData->destination = $this->destination;
        $reqData->hotelIds = $this->hotelIds;
        $reqData->resortIds = $this->resortIds;
        $reqData->accommodationTypes = $this->accommodationTypes;
        $reqData->sortBy = $this->sortBy;
        $reqData->sortOrder = $this->sortOrder;
        $reqData->exactDestinationMatch = $this->exactDestinationMatch;


        $resp = $this->apiClient->GetHotels($reqData);
        
        $this->assertNotEmpty($resp);
        return $resp;
    }

    /**
     * Testing GetHotelsResp results of GetHotels method
     *
     * @depends testHotelsReq
     */
    public function testHotelXMLResp(SimpleXMLElement $xmlResp)
    {
        //print_r( $this->apiClient->ConvertXMLToArray($xmlResp) );
        //print_r( $this->apiClient->ConvertXMLToNative($resp, "GetHotels") );
        //print_r($xmlResp);

        //$this->assertEquals((string)$xmlResp->hotels->hotel[0]->name, "6 Wilkes Barre Motel");
        $native = $this->apiClient->ConvertXMLToNative($xmlResp, "GetHotels");

        $this->assertEquals(get_class($native), "webbeds\hotel_api_sdk\messages\GetHotelsResp");
        return $native;
    }

    /**
     * Testing GetHotelsResp results of GetHotels method
     *
     * @depends testHotelXMLResp
     */
    public function testHotelResp(GetHotelsResp $getHotelsResp)
    {
        // Check is response is empty or not
        $this->assertFalse($getHotelsResp->isEmpty(), "Response is empty!");
        
        foreach ($getHotelsResp->iterator() as $hotel_id => $hotelData) {
            echo "\r\n->" . $hotelData->hotelId . ', '.$hotelData->destinationId . ', '.$hotelData->name . "\r\n";
            echo '->' . $hotelData->latitude .  ', ' . $hotelData->longitude . "\r\n";
            foreach($hotelData->images->iterator() as $id => $imageData) {
                echo "-->images:" . $imageData->id . ', ' . $imageData->fullSizeImageUrl . "\r\n";
            }

            foreach($hotelData->features->iterator() as $id => $featureData) {
                echo "-->features:" . $featureData->id . ', ' . $featureData->name . "\r\n";
            }

            foreach($hotelData->hotelRoomType->iterator() as $id => $hotelRoomTypeData) {
                echo "-->hotelRoomType:" . $hotelRoomTypeData->id . ', ' . $hotelRoomTypeData->roomType . "\r\n";

                foreach($hotelRoomTypeData->rooms->iterator() as $id => $roomData) {
                    echo "--->rooms:" . $roomData->id . ', ' . $roomData->beds . "\r\n";

                    foreach($roomData->paymentMethods->iterator() as $id => $paymentMethodData) {
                        echo "---->paymentMethods:" . $paymentMethodData->id . ', ' . $paymentMethodData->name . "\r\n";
                    }
                }
            }
        }
        
    }
}