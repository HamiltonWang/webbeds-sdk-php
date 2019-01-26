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
use webbeds\hotel_api_sdk\messages\book\CancelBookingResp;

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
        $this->bookingId = 'SH6956578'; //SH6920416
    }

    /**
     * API Hotel Method test
     */
    public function testCancelBookingReq()
    {
        $reqData = new \webbeds\hotel_api_sdk\helpers\book\CancelBooking();
        
        $reqData->userName = $this->userName;
        $reqData->password = $this->password;
        $reqData->language = $this->language;           
        $reqData->bookingID = $this->bookingId;   

        $resp = $this->apiClient->CancelBooking($reqData);

        $this->assertNotEmpty($resp);
        
        return $resp;
    }

    /**
     * Testing BookResp results of Book method
     *
     * @depends testCancelBookingReq
     */
    public function testCancelBookingXMLResp(\SimpleXMLElement $xmlResp)
    {
        $native = $this->apiClient->ConvertSimpleXMLToArray($xmlResp, "CancelBooking");
        $this->assertEquals(get_class($native), "webbeds\\hotel_api_sdk\\messages\\$this->lib\\CancelBookingResp");
        return $native;
    }
    /**
     * Testing Error 
     *
     * @depends testCancelBookingXMLResp
     */
    public function testError(CancelBookingResp $cancelBookingResp)
    {
        $this->assertFalse($cancelBookingResp->isError(), "Response has error! Message: $cancelBookingResp->error");

        simplexml_tree($cancelBookingResp->result, true);
        return $cancelBookingResp;
    }

    /**
     * Testing CancelBookingResp results of CancelBooking method
     *
     * @depends testError
     */
    public function testCancelBookingResp(CancelBookingResp $bookResp)
    {   
        $bookings = $bookResp->bookings;
        //simplexml_tree($bookings, true);

        foreach ($bookings as $Id => $bookingData) {
            echo PHP_EOL.'======================== Booking result ===================='.PHP_EOL;
            $this->assertNotEmpty($bookingData->bookingnumber);

            echo "->bookingNumber:$bookingData->bookingnumber, hotelName:". $bookingData->{'hotel.name'} .", meal:$bookingData->meal ".PHP_EOL;
            echo "->checkinDate:$bookingData->checkindate, checkoutDate:$bookingData->checkoutdate".PHP_EOL;
            echo "->currency:$bookingData->currency, bookedBy:$bookingData->bookedBy".PHP_EOL;
            echo "->meal:$bookingData->meal, mealLabel:". (string)$bookingData->mealLabel.PHP_EOL;

            foreach ($bookingData->prices as $Id => $data) {
                echo "-->price: :$data->price, currency:". $data->price['currency']." , paymentMethods:". $data->price['paymentMethods'] .PHP_EOL;
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
            foreach ($bookingData->currentCancellationPolicyFee as $Id => $data) {
                echo "-->fee: :$data->fee, currency:". $data->fee['currency'] .PHP_EOL;
            }
            echo "->invoiceref:$bookingData->invoiceref, bookingStatus:". (string)$bookingData->bookingStatus.PHP_EOL;
            echo '======================== END ===================='.PHP_EOL;
        }
    }
}