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
use webbeds\hotel_api_sdk\messages\book\BookResp;
//use webbeds\hotel_api_sdk\model\Book;
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
     * @var integer numberOfRooms NumberOfRooms for this book
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
     * @var boolean exactDestinationMatch ExactDestinationMatch is good for more precise book when using iso code.
     */
    private $exactDestinationMatch;
    /**
     * @var boolean blockSuperdeal BlockSuperdeal is to prevent showing super deal
     */
    private $blockSuperdeal;
    /**
     * @var integer mealId mealId to specify a certain meal type
     */
    private $mealId;
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
     * @var string prioritizedHotelIds PrioritizedHotelIds is Id of a hotel that should be prioritized in the book results.
     */
    private $prioritizedHotelIds;
    /**
     * @var string totalRoomsInBatch TotalRoomsInBatch total number of rooms requested
     */
    private $totalRoomsInBatch;
    /**
     * @var integer paymentMethodId PaymentMethodId The payment method id the result must have
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
    /**
     * @var string lib search api or book api
     */
    private $lib;

    protected function setUp()
    {
        $this->lib = 'book';
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

        $this->currency = 'TWD';    
        $this->language = 'en';
        $this->email = 'hamilton@aiart.io';
        $this->checkInDate ='2019-03-01';
        $this->checkOutDate ='2019-03-03';
        $this->roomId = 12306181;
        $this->rooms = 1;
        $this->adults = 2;
        $this->children = 0;
        $this->infant = 0;
        $this->yourRef = 'test';
        $this->specialRequest = 'specialRequest';
        $this->mealId = 1;

        $this->adultGuest1FirstName = 'Hamilton';
        $this->adultGuest1LastName = 'Wang';
        $this->adultGuest2FirstName = 'Melisa';
        $this->adultGuest2LastName = 'Wang';
        $this->adultGuest3FirstName = '';
        $this->adultGuest3LastName = '';
        $this->adultGuest4FirstName = '';
        $this->adultGuest4LastName = '';
        $this->adultGuest5FirstName = '';
        $this->adultGuest5LastName = '';
        $this->adultGuest6FirstName = '';
        $this->adultGuest6LastName = '';
        $this->adultGuest7FirstName = '';
        $this->adultGuest7LastName = '';
        $this->adultGuest8FirstName = '';
        $this->adultGuest8LastName = '';
        $this->adultGuest9FirstName = '';
        $this->adultGuest9LastName = '';
        $this->childrenGuest1FirstName = '';
        $this->childrenGuest1LastName = '';
        $this->childrenGuestAge1 = '';
        $this->childrenGuest2FirstName = '';
        $this->childrenGuest2LastName = '';
        $this->childrenGuestAge2 = '';
        $this->childrenGuest3FirstName = '';
        $this->childrenGuest3LastName = '';
        $this->childrenGuestAge3 = '';
        $this->childrenGuest4FirstName = '';
        $this->childrenGuest4LastName = '';
        $this->childrenGuestAge4 = '';
        $this->childrenGuest5FirstName = '';
        $this->childrenGuest5LastName = '';
        $this->childrenGuestAge5 = '';
        $this->childrenGuest6FirstName = '';
        $this->childrenGuest6LastName = '';
        $this->childrenGuestAge6 = '';
        $this->childrenGuest7FirstName = '';
        $this->childrenGuest7LastName = '';
        $this->childrenGuestAge7 = '';
        $this->childrenGuest8FirstName = '';
        $this->childrenGuest8LastName = '';
        $this->childrenGuestAge8 = '';
        $this->childrenGuest9FirstName = '';
        $this->childrenGuest9LastName = '';
        $this->childrenGuestAge9 = '';

        $this->paymentMethodId = 1;
        $this->creditCardType = '';
        $this->creditCardNumber = '';
        $this->creditCardHolder = '';
        $this->creditCardCVV2 = '';
        $this->creditCardExpYear = '';
        $this->creditCardExpMonth = '';
        $this->customerEmail = '';
        $this->invoiceRef = 'invoiceRef';
        $this->commissionAmountInHotelCurrency = '';
        $this->customerCountry = 'tw';
        $this->b2c = '0';
        $this->preBookCode = '33463ad4-9228-4f57-974a-e75fed3e4b2c';
    }

    /**
     * API Hotel Method test
     */
    public function testBookReq()
    {
        $reqData = new \webbeds\hotel_api_sdk\helpers\book\Book();
        
        $reqData->userName = $this->userName;
        $reqData->password = $this->password;
        $reqData->language = $this->language;           
        $reqData->currency = $this->currency;   
        $reqData->language = $this->language;
        $reqData->email = $this->email;
        $reqData->checkInDate = $this->checkInDate;
        $reqData->checkOutDate = $this->checkOutDate;
        $reqData->roomId = $this->roomId;
        $reqData->rooms = $this->rooms;
        $reqData->adults = $this->adults;
        $reqData->children = $this->children;
        $reqData->infant = $this->infant;
        $reqData->yourRef = $this->yourRef;
        $reqData->specialRequest = $this->specialRequest;
        $reqData->mealId = $this->mealId;

        $reqData->adultGuest1FirstName = $this->adultGuest1FirstName;
        $reqData->adultGuest1LastName = $this->adultGuest1LastName;
        $reqData->adultGuest2FirstName = $this->adultGuest2FirstName;
        $reqData->adultGuest2LastName = $this->adultGuest2LastName;
        $reqData->adultGuest3FirstName = $this->adultGuest3FirstName;
        $reqData->adultGuest3LastName = $this->adultGuest3LastName;
        $reqData->adultGuest4FirstName = $this->adultGuest4FirstName;
        $reqData->adultGuest4LastName = $this->adultGuest4LastName;
        $reqData->adultGuest5FirstName = $this->adultGuest5FirstName;
        $reqData->adultGuest5LastName = $this->adultGuest5LastName;
        $reqData->adultGuest6FirstName = $this->adultGuest6FirstName;
        $reqData->adultGuest6LastName = $this->adultGuest6LastName;
        $reqData->adultGuest7FirstName = $this->adultGuest7FirstName;
        $reqData->adultGuest7LastName = $this->adultGuest7LastName;
        $reqData->adultGuest8FirstName = $this->adultGuest8FirstName;
        $reqData->adultGuest8LastName = $this->adultGuest8LastName;
        $reqData->adultGuest9FirstName = $this->adultGuest9FirstName;
        $reqData->adultGuest9LastName = $this->adultGuest9LastName;
        $reqData->childrenGuest1FirstName = $this->childrenGuest1FirstName;
        $reqData->childrenGuest1LastName = $this->childrenGuest1LastName;
        $reqData->childrenGuestAge1 = $this->childrenGuestAge1;
        $reqData->childrenGuest2FirstName = $this->childrenGuest2FirstName;
        $reqData->childrenGuest2LastName = $this->childrenGuest2LastName;
        $reqData->childrenGuestAge2 = $this->childrenGuestAge2;
        $reqData->childrenGuest3FirstName = $this->childrenGuest3FirstName;
        $reqData->childrenGuest3LastName = $this->childrenGuest3LastName;
        $reqData->childrenGuestAge3 = $this->childrenGuestAge3;
        $reqData->childrenGuest4FirstName = $this->childrenGuest4FirstName;
        $reqData->childrenGuest4LastName = $this->childrenGuest4LastName;
        $reqData->childrenGuestAge4 = $this->childrenGuestAge4;
        $reqData->childrenGuest5FirstName = $this->childrenGuest5FirstName;
        $reqData->childrenGuest5LastName = $this->childrenGuest5LastName;
        $reqData->childrenGuestAge5 = $this->childrenGuestAge5;
        $reqData->childrenGuest6FirstName = $this->childrenGuest6FirstName;
        $reqData->childrenGuest6LastName = $this->childrenGuest6LastName;
        $reqData->childrenGuestAge6 = $this->childrenGuestAge6;
        $reqData->childrenGuest7FirstName = $this->childrenGuest7FirstName;
        $reqData->childrenGuest7LastName = $this->childrenGuest7LastName;
        $reqData->childrenGuestAge7 = $this->childrenGuestAge7;
        $reqData->childrenGuest8FirstName = $this->childrenGuest8FirstName;
        $reqData->childrenGuest8LastName = $this->childrenGuest8LastName;
        $reqData->childrenGuestAge8 = $this->childrenGuestAge8;
        $reqData->childrenGuest9FirstName = $this->childrenGuest9FirstName;
        $reqData->childrenGuest9LastName = $this->childrenGuest9LastName;
        $reqData->childrenGuestAge9 = $this->childrenGuestAge9;

        $reqData->paymentMethodId = $this->paymentMethodId;
        $reqData->creditCardType = $this->creditCardType;
        $reqData->creditCardNumber = $this->creditCardNumber;
        $reqData->creditCardHolder = $this->creditCardHolder;
        $reqData->creditCardCVV2 = $this->creditCardCVV2;
        $reqData->creditCardExpYear = $this->creditCardExpYear;
        $reqData->creditCardExpMonth = $this->creditCardExpMonth;
        $reqData->customerEmail = $this->customerEmail;
        $reqData->invoiceRef = $this->invoiceRef;
        $reqData->commissionAmountInHotelCurrency = $this->commissionAmountInHotelCurrency;
        $reqData->customerCountry = $this->customerCountry;
        $reqData->b2c = $this->b2c;
        $reqData->preBookCode = $this->preBookCode;

        $resp = $this->apiClient->Book($reqData);

        $this->assertNotEmpty($resp);
        //simplexml_tree($resp, true);
        return $resp;
    }

    /**
     * Testing BookResp results of Book method
     *
     * @depends testBookReq
     */
    public function testBookXMLResp(SimpleXMLElement $xmlResp)
    {
        // TODO: parsing prices have oroblem with attribute missing 
        $native = $this->apiClient->ConvertXMLToNative($xmlResp, "Book");
        $this->assertEquals(get_class($native), "webbeds\\hotel_api_sdk\\messages\\$this->lib\\BookResp");
        
        return $native;
    }

    /**
     * Testing BookResp results of Book method
     *
     * @depends testBookXMLResp
     */
    public function testBookResp(BookResp $bookResp)
    {
        // Check is response is empty or not
        $this->assertFalse($bookResp->isError(), "Response is empty! Message: $bookResp->error");
        
        echo PHP_EOL."bookingnumber: $bookResp->bookingNumber, $bookResp->hotelName, $bookResp->roomEnglishType" . PHP_EOL;
        echo "voucher: $bookResp->voucher, paymentmethodName:$bookResp->paymentmethodName ".PHP_EOL;
        echo "bookedBy: $bookResp->bookedBy ".PHP_EOL;
        echo "prices: $bookResp->prices, $bookResp->currency".PHP_EOL;
        echo "invoiceRef: $bookResp->invoiceRef".PHP_EOL;
        
        echo "checkin/out: $bookResp->checkinDate ~ $bookResp->checkoutDate ".PHP_EOL;
        echo "earliestNonFreeCancellationDateLocal: $bookResp->earliestNonFreeCancellationDateLocal ".PHP_EOL;
        echo "earliestNonFreeCancellationDateCet: $bookResp->earliestNonFreeCancellationDateCet ".PHP_EOL;

        
        /*
        //TODO: problem with capturing price's attributes
        foreach ($bookResp->prices->iterator() as $Id => $priceData) {
            echo "\r\n ->prices: $priceData->price $priceData->currency, paymentMethod:$priceData->paymentMethods ".PHP_EOL;
        }*/
        
        foreach ($bookResp->cancellationPoliciesIterator() as $Id => $cxlPolicyData) {
            echo "->cxlPolicy: deadline:$cxlPolicyData->deadline, percentage:$cxlPolicyData->percentage, text:$cxlPolicyData->text ".PHP_EOL;
        }
        foreach ($bookResp->hotelNotes->iterator() as $Id => $data) {
            echo "->hotelNotes: startDate:$data->startDate, endDate:$data->endDate, text:$data->text ".PHP_EOL;
        }
        foreach ($bookResp->englishHotelNotes->iterator() as $Id => $data) {
            echo "->englishHotelNotes: startDate:$data->startDate, endDate:$data->endDate, text:$data->text ".PHP_EOL;
        }
        foreach ($bookResp->roomNotes->iterator() as $Id => $data) {
            echo "->roomNotes: startDate:$data->startDate, endDate:$data->endDate, text:$data->text ".PHP_EOL;
        }
        foreach ($bookResp->englishRoomNotes->iterator() as $Id => $data) {
            echo "->englishRoomNotes: startDate:$data->startDate, endDate:$data->endDate, text:$data->text ".PHP_EOL;
        }
    }
}