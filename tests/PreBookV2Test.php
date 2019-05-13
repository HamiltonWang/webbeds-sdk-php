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
use webbeds\hotel_api_sdk\messages\book\PreBookV2Resp;
use webbeds\hotel_api_sdk\model\Book;
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
     * @var string currency Currency parameter
     */
    private $currency;
    /**
     * @var string language language to retrieve your data
     */
    private $language;
    /**
     * @var string checkInDate checkInDate to start checking-in
     */
    private $checkInDate;
    /**
     * @var string checkOutDate checkInDate to start checking-out
     */
    private $checkOutDate;
    /**
     * @var string roomId RoomId to specify a Room ID, it is the unique key to book
     */
    private $roomId;
    /**
     * @var integer rooms Number of rooms for this booking
     */
    private $rooms;
    /**
     * @var integer adults REQUIRED Adults is the number of adults
     */
    private $adults;
    /**
     * @var integer children REQUIRED Children is the number of children
     */
    private $children;
    /**
     * @var string childrenAges childrenAges is children's age if children is not zero
     */
    private $childrenAges;
    /**
     * @var integer infant REQUIRED Infant is number of infant
     */
    private $infant;
    /**
     * @var string mealId MealId to specify a certain meal type
     */
    private $mealId;
    /**
     * @var string customerCountry A 2 letter country code representing the nationality of the client
     */
    private $customerCountry;
    /**
     * @var boolean b2c Whether or not the client derives from a B2C/non-package point of sales.
     */
    private $b2c;
    /**
     * @var string searchPrice SearchPrice is the price obtained from previous Search
     */
    private $searchPrice;
    /**
     * @var string hotelId HotelIds is webbeds's hotelId, such as 48747, 19614, 29065 
     */
    private $hotelId;
    /**
     * @var string roomtypeId Only enter either "roomId" or "hotelId, roomtypeId and blockSuperDeal using PreBookV2"
     */
    private $roomtypeId;
    /**
     * @var boolean blockSuperDeal blockSuperDeal is to prevent showing super deal
     */
    private $blockSuperDeal;
    /**
     * @var string showPriceBreakdown showPriceBreakdown to order your data
     */
    private $showPriceBreakdown;
     /**
     * @var bool lib using static or nonStatic, default to true
     */
    private $nonStatic;

    protected function setUp()
    {
        $this->nonStatic = true;
        $reader = new Zend\Config\Reader\Ini();
        $commonConfig   = $reader->fromFile(__DIR__ . '/config/Common.ini');
        $currentEnvironment = $commonConfig["environment"]? $commonConfig["environment"]: "DEFAULT";
        $environmentConfig   = $reader->fromFile(__DIR__ . '/config/Environment.' . strtoupper($currentEnvironment) . '.ini');
        $cfgUri = $commonConfig["url"];
        $cfgApi = $environmentConfig["apiclient"];
        $this->userName = $cfgApi["userName"];
        $this->password = $cfgApi["password"];
        $this->apiClient = new HotelApiClient($cfgUri["book"],
            $cfgApi["userName"],
            $cfgApi["password"],
            new ApiVersion(ApiVersions::V1_0),
            "book",
            $this->nonStatic,
            $cfgUri["timeout"],
            null);

        $this->language = 'en';
        $this->currency = 'TWD';        
        $this->checkInDate ='2019-06-01';
        $this->checkOutDate ='2019-06-03';
        $this->roomId = '15148113';
        $this->rooms = 1;
        $this->adults = 2;
        $this->children = 0;
        $this->childrenAges = '';
        $this->infant = 0;
        $this->mealId = 1;
        $this->customerCountry = 'tw';
        $this->b2c = false;
        $this->searchPrice ='4661';

        $this->hotelId = ''; //'126267';
        $this->roomtypeId ='';
        $this->blockSuperDeal = '';
        $this->showPriceBreakdown = '1';        
    }

    /**
     * API Hotel Method test
     */
    public function testPreBookV2Req()
    {
        $reqData = new \webbeds\hotel_api_sdk\helpers\book\PreBookV2();
        
        $reqData->userName = $this->userName;
        $reqData->password = $this->password;
        $reqData->language = $this->language;     
        $reqData->currency = $this->currency;   
        $reqData->checkInDate = $this->checkInDate;
        $reqData->checkOutDate = $this->checkOutDate;
        $reqData->roomId = $this->roomId;
        $reqData->rooms = $this->rooms;
        $reqData->adults = $this->adults;
        $reqData->children = $this->children;
        $reqData->childrenAges = $this->childrenAges;
        $reqData->infant = $this->infant;
        $reqData->mealId = $this->mealId;
        $reqData->customerCountry = $this->customerCountry;
        $reqData->b2c = $this->b2c;
        $reqData->searchPrice = $this->searchPrice;

        $reqData->hotelId = $this->hotelId;
        $reqData->roomtypeId = $this->roomtypeId;
        $reqData->blockSuperDeal = $this->blockSuperDeal;
        $reqData->showPriceBreakdown = $this->showPriceBreakdown; 

        $resp = $this->apiClient->PreBookV2($reqData);

        $this->assertNotEmpty($resp);
        return $resp;
    }

    /**
     * Testing PreBookV2Resp results of Search method
     *
     * @depends testPreBookV2Req
     */
    public function testpreBookV2RespType(SimpleXMLElement $xmlResp)
    {
        $native = $this->apiClient->ConvertXMLToNative($xmlResp, "PreBookV2");

        $this->assertEquals(get_class($native), "webbeds\hotel_api_sdk\messages\book\PreBookV2Resp");
       
        return $native;
    }

    /**
     * Testing PreBookV2Resp results of Search method
     *
     * @depends testpreBookV2RespType
     */
    public function testPreBookV2Resp(PreBookV2Resp $preBookV2Resp)
    {
        // Check is response is empty or not
        //print_r($preBookV2Resp);
        $this->assertFalse($preBookV2Resp->isError(), "Response has error! $preBookV2Resp->error");
        
        echo PHP_EOL." ===== This information can be used for testing Book Api: ======".PHP_EOL;
        echo "CheckIn/Out Date: $this->checkInDate~$this->checkOutDate RoomId:$this->roomId, Rooms:$this->rooms".PHP_EOL;
        echo "adults:$this->adults, children:$this->children, childrenAges:$this->childrenAges, infant:$this->infant ".PHP_EOL;
        echo "mealId:$this->mealId, customerCountry:$this->customerCountry, b2c:" . ($this->b2c ? 1:0) .", searchPrice:$this->searchPrice ".PHP_EOL;
        echo "Response Output:";
        echo "->preBookCode: '".$preBookV2Resp->preBookCode ."', price: $preBookV2Resp->price $preBookV2Resp->currency ".PHP_EOL;
        $priceBreakdown = $preBookV2Resp->priceBreakdowns;

        $this->assertNotEmpty($priceBreakdown);
        foreach ($priceBreakdown->iterator() as $Id => $priceBreakdownData) {
            echo "-->priceBreakdown: totalPrice:$priceBreakdownData->totalPrice , type:$priceBreakdownData->type  price:$priceBreakdownData->price  breakdown:$priceBreakdownData->breakdown  ".PHP_EOL;
        }
        echo "=================================================================";

    }
}