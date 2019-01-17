<?php
/**
 * User: Hamilton
 * Date: 12/12/2018
 * Time: 01:09 PM
 */
namespace webbeds\hotel_api_sdk\helpers;


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
            "mealIds" => "string",
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
            "childrenGuest1FirstName" => "string",
            "childrenGuest1LastName" => "string",
            "childrenGuestAge1" => "string",
            "childrenGuest1FirstName" => "string",
            "childrenGuest1LastName" => "string",
            "childrenGuestAge1" => "string",
            "childrenGuest1FirstName" => "string",
            "childrenGuest1LastName" => "string",
            "childrenGuestAge1" => "string",
            "childrenGuest1FirstName" => "string",
            "childrenGuest1LastName" => "string",
            "childrenGuestAge1" => "string",
            "childrenGuest1FirstName" => "string",
            "childrenGuest1LastName" => "string",
            "childrenGuestAge1" => "string",
            "childrenGuest1FirstName" => "string",
            "childrenGuest1LastName" => "string",
            "childrenGuestAge1" => "string",
            "childrenGuest1FirstName" => "string",
            "childrenGuest1LastName" => "string",
            "childrenGuestAge1" => "string",
            "childrenGuest1FirstName" => "string",
            "childrenGuest1LastName" => "string",
            "childrenGuestAge1" => "string",
            "paymentMethodId" => "string",
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