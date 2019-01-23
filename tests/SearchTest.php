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
use webbeds\hotel_api_sdk\messages\search\SearchResp;
use webbeds\hotel_api_sdk\model\Search;
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
     * @var string currencies Currencies parameter
     */
    private $currencies;
    /**
     * @var string checkInDate checkInDate to start checking-in
     */
    private $checkInDate;
    /**
     * @var string checkOutDate checkInDate to start checking-out
     */
    private $checkOutDate;
    /**
     * @var integer numberOfRooms NumberOfRooms for this search
     */
    private $numberOfRooms;
    /**
     * @var string destination Destination is iso airport code  
     */
    private $destination;
    /**
     * @var string destinationId DestinationId is webbeds's destinationId, such as 552 
     */
    private $destinationId;
    /**
     * @var string hotelIds HotelIds is webbeds's hotelIds, such as 48747, 19614, 29065 
     */
    private $hotelIds;
    /**
     * @var integer numberOfAdults REQUIRED NumberOfAdults is the number of adults
     */
    private $numberOfAdults;
    /**
     * @var integer numberOfChildren REQUIRED numberOfChildren is the number of children
     */
    private $numberOfChildren;
    /**
     * @var string childrenAges childrenAges is children's age if children is not zero
     */
    private $childrenAges;
    /**
     * @var integer infant REQUIRED Infant is number of infant
     */
    private $infant;
    /**
     * @var string sortBy SortBy is sorting by a particular field
     */
    private $sortBy;
    /**
     * @var string sortOrder sortOrder to order your data
     */
    private $sortOrder;
    /**
     * @var boolean exactDestinationMatch ExactDestinationMatch is good for more precise search when using iso code.
     */
    private $exactDestinationMatch;
    /**
     * @var boolean blockSuperdeal BlockSuperdeal is to prevent showing super deal
     */
    private $blockSuperdeal;
    /**
     * @var string mealIds MealIds to specify a certain meal type
     */
    private $mealIds;
    /**
     * @var string showCoordinates ShowCoordinates to specify a certain meal type. but it doesn't seem to be working
     */
    private $showCoordinates;
    /**
     * @var string showReviews ShowReviews is no longer supported
     */
    private $showReviews;
    /**
     * @var string referencePointLatitude ReferencePointLatitude is no longer supported
     */
    private $referencePointLatitude;
    /**
     * @var string referencePointLongitude ReferencePointLongitude is no longer supported
     */
    private $referencePointLongitude;
    /**
     * @var string maxDistanceFromReferencePoint MaxDistanceFromReferencePoint is no longer supported
     */
    private $maxDistanceFromReferencePoint;
    /**
     * @var string minStarRating MinStarRating is the minumum star rating for a hotel
     */
    private $minStarRating;
    /**
     * @var string maxStarRating MaxStarRating is the maximum star rating for a hotel
     */
    private $maxStarRating;
    /**
     * @var string featureIds FeatureIds to specify a certain feature, but there aren't many
     */
    private $featureIds;
    /**
     * @var string minPrice MinPrice is the minimum amount for a hotel to show up
     */
    private $minPrice;
    /**
     * @var string maxPrice MaxPrice is the maximum amount for a hotel to show up
     */
    private $maxPrice;
    /**
     * @var string themeIds ThemeIds limits the type of theme
     */
    private $themeIds;
    /**
     * @var string excludeSharedRooms ExcludeSharedRooms is to exclude shared room type of hotel or hostel
     */
    private $excludeSharedRooms;
    /**
     * @var string excludeSharedFacilities ExcludeSharedFacilities is to exclude shared facilities type of hotel or hostel
     */
    private $excludeSharedFacilities;
    /**
     * @var string prioritizedHotelIds PrioritizedHotelIds is Id of a hotel that should be prioritized in the search results.
     */
    private $prioritizedHotelIds;
    /**
     * @var string totalRoomsInBatch TotalRoomsInBatch total number of rooms requested
     */
    private $totalRoomsInBatch;
    /**
     * @var string paymentMethodId PaymentMethodId The payment method id the result must have
     */
    private $paymentMethodId;
    /**
     * @var string customerCountry A 2 letter country code representing the nationality of the client
     */
    private $customerCountry;
    /**
     * @var boolean b2c Whether or not the client derives from a B2C/non-package point of sales.
     */
    private $b2c;

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

        $this->language = 'en';
        $this->currencies = 'TWD';        
        $this->checkInDate ='2019-06-01';
        $this->checkOutDate ='2019-06-03';
        $this->numberOfRooms = 1;
        $this->destination = '';
        $this->destinationId = 552;
        $this->hotelIds = ''; //'126267';
        $this->resortIds = ''; //'126267';
        $this->accommodationTypes = '';
        
        $this->numberOfAdults = 2;
        $this->numberOfChildren = 0;
        $this->childrenAges = '';
        $this->infant = 0;
        $this->sortBy = 'Price';
        $this->sortOrder = 'Ascending';
        $this->exactDestinationMatch = true;
        $this->blockSuperdeal = false;
        $this->mealIds = '';
        $this->showCoordinates = '1';
        $this->showReviews = '';
        $this->referencePointLatitude = '';
        $this->referencePointLongitude = '';
        $this->maxDistanceFromReferencePoint ='';
        $this->minStarRating = '';
        $this->maxStarRating = '';
        $this->featureIds = '';
        $this->minPrice ='';
        $this->maxPrice = '';
        $this->themeIds = '';
        $this->excludeSharedRooms = true;
        $this->excludeSharedFacilities = '';
        $this->prioritizedHotelIds = '';
        $this->totalRoomsInBatch = '';
        $this->paymentMethodId ='1';
        $this->customerCountry = 'tw';
        $this->b2c = false;
    }

    /**
     * API Hotel Method test
     */
    public function testHotelsReq()
    {
        $reqData = new \webbeds\hotel_api_sdk\helpers\search\Search();
        
        $reqData->userName = $this->userName;
        $reqData->password = $this->password;
        $reqData->language = $this->language;     
        $reqData->currencies = $this->currencies;   
        $reqData->checkInDate = $this->checkInDate;
        $reqData->checkOutDate = $this->checkOutDate;
        $reqData->destination = $this->destination;
        $reqData->destinationId = $this->destinationId;
        $reqData->hotelIds = $this->hotelIds;
        $reqData->resortIds = $this->resortIds;
        $reqData->accommodationTypes = $this->accommodationTypes;
        $reqData->numberOfRooms = $this->numberOfRooms;
        $reqData->numberOfAdults = $this->numberOfAdults;
        $reqData->numberOfChildren = $this->numberOfChildren;
        $reqData->childrenAges = $this->childrenAges;
        $reqData->infant = $this->infant;
        $reqData->sortBy = $this->sortBy;
        $reqData->sortOrder = $this->sortOrder;
        $reqData->exactDestinationMatch = $this->exactDestinationMatch;
        $reqData->blockSuperdeal = $this->blockSuperdeal;
        $reqData->mealIds = $this->mealIds;
        $reqData->showCoordinates = $this->showCoordinates;
        $reqData->showReviews = $this->showReviews;
        $reqData->referencePointLatitude = $this->referencePointLatitude;
        $reqData->referencePointLongitude = $this->referencePointLongitude;
        $reqData->maxDistanceFromReferencePoint = $this->maxDistanceFromReferencePoint;
        $reqData->minStarRating = $this->minStarRating;
        $reqData->maxStarRating = $this->maxStarRating;
        $reqData->featureIds = $this->featureIds;
        $reqData->minPrice = $this->minPrice;
        $reqData->maxPrice = $this->maxPrice;
        $reqData->themeIds = $this->themeIds;
        $reqData->excludeSharedRooms = $this->excludeSharedRooms;
        $reqData->excludeSharedFacilities = $this->excludeSharedFacilities;
        $reqData->prioritizedHotelIds = $this->prioritizedHotelIds;
        $reqData->totalRoomsInBatch = $this->totalRoomsInBatch;
        $reqData->paymentMethodId = $this->paymentMethodId;
        $reqData->customerCountry = $this->customerCountry;
        $reqData->b2c = $this->b2c;

        $resp = $this->apiClient->Search($reqData);

        $this->assertNotEmpty($resp);
        return $resp;
    }

    /**
     * Testing SearchResp results of Search method
     *
     * @depends testHotelsReq
     */
    public function testHotelXMLResp(SimpleXMLElement $xmlResp)
    {
        //print_r( $this->apiClient->ConvertXMLToArray($xmlResp) );
        //print_r( $this->apiClient->ConvertXMLToNative($resp, "Search") );
        //print_r($xmlResp);

        //$this->assertEquals((string)$xmlResp->hotels->hotel[0]->name, "6 Wilkes Barre Motel");
        $native = $this->apiClient->ConvertXMLToNative($xmlResp, "Search");

        $this->assertEquals(get_class($native), "webbeds\hotel_api_sdk\messages\search\SearchResp");
        return $native;
    }

    /**
     * Testing SearchResp results of Search method
     *
     * @depends testHotelXMLResp
     */
    public function testHotelResp(SearchResp $searchResp)
    {
        // Check is response is empty or not
        $this->assertFalse($searchResp->isEmpty(), "Response is empty!");
        
        echo "Checkin Date: $this->checkInDate ~ $this->checkOutDate ".PHP_EOL;
        foreach ($searchResp->iterator() as $hotelId => $hotelData) {
            echo "\r\n ->hotel: $hotelData->hotelId , $hotelData->destinationId  ".PHP_EOL;

            foreach($hotelData->roomTypes->iterator() as $id => $hotelRoomTypeData) {
                echo "-->hotelRoomType:: $hotelRoomTypeData->roomTypeId ".PHP_EOL;
                
                foreach($hotelRoomTypeData->rooms->iterator() as $id => $roomData) {
                    echo "--->roomType:: id: $roomData->id , beds: $roomData->beds ".PHP_EOL;

                    foreach($roomData->meals->iterator() as $id => $mealData) {
                        echo "---->meals:: id: $mealData->id  ".PHP_EOL;
                        echo "----->price:: price: $mealData->price,  discount: $mealData->discount ".PHP_EOL;

                        //foreach($mealData->prices->iterator() as $id => $priceData) {
                        //    echo "----->prices:: price: $priceData->price  $priceData->currency (paymentMethods: $mealData->paymentMethods) ".PHP_EOL;
                        //}
                    }

                    foreach($roomData->cancellationPolicies->iterator() as $id => $cxlPolicyData) {
                        echo "---->cxlPolicy:: deadline: $cxlPolicyData->deadline, percentage: $cxlPolicyData->percentage ".PHP_EOL;
                    }

                    foreach($roomData->paymentMethods->iterator() as $id => $paymentMethodData) {
                        echo "---->paymentMethods:: id: $paymentMethodData->id ".PHP_EOL;
                    }
                }
            }
        }
        
    }
}