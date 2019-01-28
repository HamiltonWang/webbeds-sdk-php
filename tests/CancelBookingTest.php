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
        $this->bookingId = 'SH6981556'; //SH6920416
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

        file_put_contents(__DIR__ . '/cancelResp.xml', $resp->asXML());
        //file_put_contents(__DIR__ . '/cancelResp_cancelled.xml', $resp->asXML());
        $resp = simplexml_load_string( file_get_contents(__DIR__ . '/cancelResp.xml'));

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
        return $cancelBookingResp;
    }

    /**
     * Testing CancelBookingResp results of CancelBooking method
     *
     * @depends testError
     */
    public function testCancelBookingResp(CancelBookingResp $cancelBookResp)
    {   
        $cancelBooking = $cancelBookResp->result;
        //simplexml_tree($cancelBooking, true);
        $this->assertNotEmpty($cancelBooking);
        echo PHP_EOL.'======================== Cancellation result ===================='.PHP_EOL;
        echo "->Code:" . $cancelBooking->Code .PHP_EOL;
        $cancellationPaymentMethod = $cancelBooking->CancellationPaymentMethod;
        foreach ($cancellationPaymentMethod as $Id => $cancellationPaymentMethodData) {
            $cancellationfee = $cancellationPaymentMethodData->cancellationfee;
            foreach ($cancellationfee as $Id => $cxlFeeData) {
                echo "-->fee:" . $cxlFeeData['currency'] . $cxlFeeData.PHP_EOL;
            }

            $cancellationPolicy = $cancellationPaymentMethodData->cancellation;
            simplexml_tree($cancellationPolicy);
            echo "-->cancellation Type:" . $cancellationPolicy->cancellation['type'] .PHP_EOL;
            foreach ($cancellationPaymentMethodData->activecancellationpolicy as $Id => $activecancellationpolicyData) {
                echo "--->deadline:" . $activecancellationpolicyData->deadline .", percentage:". $activecancellationpolicyData->percentage .PHP_EOL;
            }
    
            echo '======================== END ===================='.PHP_EOL;
    
        }

    }
}