<?php
/**
 * User: Hamilton
 * Date: 12/12/2018
 * Time: 01:09 PM
 */
namespace webbeds\hotel_api_sdk\helpers\book;

use webbeds\hotel_api_sdk\helpers\ApiHelper;
/**
 * Class Book
 * @package webbeds\hotel_api_sdk\helpers
*/
class Book extends ApiHelper
{
    /**
     * Book constructor.
     */
    public function __construct()
    {
        $this->validFields = [
            "userName" => "string",
            "password" => "string",
            "currency" => "string",
            "language" => "string",
            "email" => "string",
            "checkInDate" => "string",
            "checkOutDate" => "string",
            "roomId" => "integer",
            "rooms" => "integer",
            "adults" => "integer",
            "children" => "integer",
            "infant" => "integer",
            "yourRef" => "string",
            "specialRequest" => "string",
            "mealId" => "integer",
            "adultGuest1FirstName" => "string",
            "adultGuest1LastName" => "string",
            "adultGuest2FirstName" => "string",
            "adultGuest2LastName" => "string",
            "adultGuest3FirstName" => "string",
            "adultGuest3LastName" => "string",
            "adultGuest4FirstName" => "string",
            "adultGuest4LastName" => "string",
            "adultGuest5FirstName" => "string",
            "adultGuest5LastName" => "string",
            "adultGuest6FirstName" => "string",
            "adultGuest6LastName" => "string",
            "adultGuest7FirstName" => "string",
            "adultGuest7LastName" => "string",
            "adultGuest8FirstName" => "string",
            "adultGuest8LastName" => "string",
            "adultGuest9FirstName" => "string",
            "adultGuest9LastName" => "string",
            "childrenGuest1FirstName" => "string",
            "childrenGuest1LastName" => "string",
            "childrenGuestAge1" => "string",
            "childrenGuest2FirstName" => "string",
            "childrenGuest2LastName" => "string",
            "childrenGuestAge2" => "string",
            "childrenGuest3FirstName" => "string",
            "childrenGuest3LastName" => "string",
            "childrenGuestAge3" => "string",
            "childrenGuest4FirstName" => "string",
            "childrenGuest4LastName" => "string",
            "childrenGuestAge4" => "string",
            "childrenGuest5FirstName" => "string",
            "childrenGuest5LastName" => "string",
            "childrenGuestAge5" => "string",
            "childrenGuest6FirstName" => "string",
            "childrenGuest6LastName" => "string",
            "childrenGuestAge6" => "string",
            "childrenGuest7FirstName" => "string",
            "childrenGuest7LastName" => "string",
            "childrenGuestAge7" => "string",
            "childrenGuest8FirstName" => "string",
            "childrenGuest8LastName" => "string",
            "childrenGuestAge8" => "string",
            "childrenGuest9FirstName" => "string",
            "childrenGuest9LastName" => "string",
            "childrenGuestAge9" => "string",
            "paymentMethodId" => "integer",
            "creditCardType" => "string",
            "creditCardNumber" => "string",
            "creditCardHolder" => "string",
            "creditCardCVV2" => "string",
            "creditCardExpYear" => "string",
            "creditCardExpMonth" => "string",
            "customerEmail" => "string",
            "invoiceRef" => "string",
            "commissionAmountInHotelCurrency" => "string",
            "customerCountry" => "string",
            "b2c" => "string",
            "preBookCode" => "string"
        ];
    }
}