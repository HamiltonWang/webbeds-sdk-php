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
use webbeds\hotel_api_sdk\messages\book\GetBookingInfoResp;

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
     * @var string bookingId is the booked order's ID
     */
    private $bookingId;
    /**
     * @var string reference is your reference from yoiur system
     */
    private $reference;
    /**
     * @var string createdDateFrom createdDateFrom to start checking-in
     */
    private $createdDateFrom;
    /**
     * @var string createdDateTo createdDateTo is the range to when order were created
     */
    private $createdDateTo;
    /**
     * @var string arrivalDateFrom 
     */
    private $arrivalDateFrom;
    /**
     * @var string arrivalDateTo
     */
    private $arrivalDateTo;

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
 
        $this->language = 'en';
        $this->bookingId = ''; //SH6920416
        $this->reference = '';
        $this->createdDateFrom = '';
        $this->createdDateTo = '';
        
        $this->arrivalDateFrom = '2019-06-01';
        $this->arrivalDateTo = '2019-06-03';
    }

    /**
     * API Hotel Method test
     */
    public function testGetBookingInfoReq()
    {
        $reqData = new \webbeds\hotel_api_sdk\helpers\book\GetBookingInfo();
        
        $reqData->userName = $this->userName;
        $reqData->password = $this->password;
        $reqData->language = $this->language;           
        $reqData->bookingID = $this->bookingId;   
        $reqData->reference = $this->reference;
        $reqData->createdDateFrom = $this->createdDateFrom;
        $reqData->createdDateTo = $this->createdDateTo;
        $reqData->arrivalDateFrom = $this->arrivalDateFrom;
        $reqData->arrivalDateTo = $this->arrivalDateTo;

        $resp = $this->apiClient->GetBookingInfo($reqData);

        $this->assertNotEmpty($resp);
        
        return $resp;
    }

    /**
     * Testing BookResp results of Book method
     *
     * @depends testGetBookingInfoReq
     */
    public function testGetBookingInfoXMLResp(\SimpleXMLElement $xmlResp)
    {
        //simplexml_tree($xmlResp, true);
        $native = $this->apiClient->ConvertSimpleXMLToArray($xmlResp, "GetBookingInfo");
        $this->assertEquals(get_class($native), "webbeds\\hotel_api_sdk\\messages\\$this->lib\\GetBookingInfoResp");
        return $native;
    }
    /**
     * Testing Error 
     *
     * @depends testGetBookingInfoXMLResp
     */
    public function testError(GetBookingInfoResp $getBookingInfoResp)
    {
        $this->assertFalse($getBookingInfoResp->isError(), "Response has error! Message: $getBookingInfoResp->error");
        $this->assertFalse($getBookingInfoResp->isEmpty(), "Response is empty! Message: $getBookingInfoResp->error");

        //simplexml_tree($getBookingInfoResp->bookings, true);
        return $getBookingInfoResp;
    }

    /**
     * Testing Error 
     *
     * @depends testError
     */
    public function testMisc(GetBookingInfoResp $resp)
    {
        $price = ($resp->bookings[0]->prices->price);
        //simplexml_tree($resp->bookings[0]->prices, true);
        foreach($price as $item)
        {
            echo PHP_EOL.'currency:' .(string)$item['currency'] .PHP_EOL;
            echo 'paymentMethods:' .(string)$item['paymentMethods'] .PHP_EOL;
            echo 'price:' .(string)$item .PHP_EOL;
        }

        $this->assertNotEmpty($price);
        return $resp;
    }

    /**
     * Testing GetBookingInfoResp results of GetBookingInfo method
     *
     * @depends testError
     */
    public function testGetBookingInfoResp(GetBookingInfoResp $bookResp)
    {   
        $bookings = $bookResp->bookings;
        simplexml_tree($bookings, true);

        foreach ($bookings as $Id => $bookingData) {
            echo PHP_EOL.'======================== Booking result ===================='.PHP_EOL;
            $this->assertNotEmpty($bookingData->bookingnumber);

            echo "->bookingNumber:$bookingData->bookingnumber, hotelName:". $bookingData->{'hotel.name'} .", meal:$bookingData->meal ".PHP_EOL;
            echo "->checkinDate:$bookingData->checkindate, checkoutDate:$bookingData->checkoutdate".PHP_EOL;
            echo "->currency:$bookingData->currency, bookedBy:$bookingData->bookedBy".PHP_EOL;
            echo "->meal:$bookingData->meal, mealLabel:". (string)$bookingData->mealLabel.PHP_EOL;
            echo "->bookingdate:$bookingData->bookingdate, bookingdate.timezone:". (string)$bookingData->{'bookingdate.timezone'}.PHP_EOL;

            foreach ($bookingData->prices as $Id => $data) {
                echo "-->price:$data->price, currency:". $data->price['currency']." , paymentMethods:". $data->price['paymentMethods'] .PHP_EOL;
            }
            foreach ($bookingData->cancellationpolicies as $Id => $cxlPolicyData) {
                echo "-->cxlPolicy: deadline:$cxlPolicyData->deadline, percentage:$cxlPolicyData->percentage, text:$cxlPolicyData->text ".PHP_EOL;
            }
            foreach ($bookingData->hotelNotes->hotelNote as $Id => $data) {
                echo "->hotelNotes: startDate:".$data->attributes()->start_date.", endDate:".$data->attributes()->end_date.", text:$data->text ".PHP_EOL;
            }
            foreach ($bookingData->englishHotelNotes->englishHotelNote as $Id => $data) {
                echo "->englishHotelNotes: startDate:".$data->attributes()->start_date.", endDate:".$data->attributes()->end_date.", text:$data->text ".PHP_EOL;
            }
            foreach ($bookingData->roomNotes->roomNotes as $Id => $data) {
                echo "->roomNotes: startDate:".$data->attributes()->start_date.", endDate:".$data->attributes()->end_date.", text:$data->text ".PHP_EOL;
            }
            foreach ($bookingData->englishRoomNotes->englishRoomNote as $Id => $data) {
                echo "->englishRoomNotes: startDate:".$data->attributes()->start_date.", endDate:".$data->attributes()->end_date.", text:$data->text ".PHP_EOL;
            }
            foreach ($bookingData->currentCancellationPolicyDeadline as $Id => $cxlPolicyData) {
                echo "-->currentCancellationPolicyDeadline: deadline:".$cxlPolicyData .PHP_EOL;
            }
            foreach ($bookingData->currentCancellationPolicyFee as $Id => $data) {
                echo "-->Cancellation fee: :$data->fee, currency:". $data->fee['currency'] .PHP_EOL;
            }
            echo "->invoiceref:$bookingData->invoiceref, bookingStatus:". (string)$bookingData->bookingStatus.PHP_EOL;
            echo '======================== END ===================='.PHP_EOL;
        }
    }
}