<?php
/**
 * Created by PhpStorm.
 * User: Tomeu
 * Date: 11/4/2015
 * Time: 8:43 PM
 */
namespace webbeds\hotel_api_sdk\model\book;

use webbeds\hotel_api_sdk\model\ApiModel;
use webbeds\hotel_api_sdk\model\book\Notes;
use webbeds\hotel_api_sdk\model\common\CancellationPolicies;



/**
 * Class Booking
 * @package webbeds\hotel_api_sdk\model
 * @property string userName User Name to use webBeds API
 * @property string password Password to use webBeds API
 */
class Booking extends ApiModel
{
    /**
     * Bookings constructor.
     * @property string userName User Name to use webBeds API
     * @property string password Password to use webBeds API
     */
    public function __construct(array $data=null)
    {
        $this->validFields =
            [
                "bookingNumber" => "string",
                "hotelId" => "string",
                "hotelName" => "string",
                "hotelAddress" => "string",
                "hotelPhone" => "string",
                "numberOfRoom" => "integer",
                "roomType" => "string",
                "roomEnglishType" => "string",
                "mealId" => "integer",
                "meal" => "string",
                "mealLabel" => "string",
                "englishMeal" => "string",
                "englishMealLabel" => "string",
                "checkinDate" => "string",
                "checkoutDate" => "string",
                "prices" => "string",
                "currency" => "string",
                "bookingDate" => "string",
                "bookingDateTimezone" => "string",
                "cancellationPolicies" => "array",
                "earliestNonFreeCancellationDateLocal" => "string",
                "earliestNonFreeCancellationDateCet" => "string",
                "yourRef" => "string",
                "voucher" => "string",
                "bookedBy" => "string",
                "transferbooked" => "boolean",
                "paymentmethodId" => "integer",
                "paymentmethodName" => "string",
                "hotelNotes" => "array",
                "englishHotelNotes" => "array",
                "roomNotes" => "array",
                "englishRoomNotes" => "array",
                "invoiceRef" => "string",
                "bookingStatus" => "string",
                "currentCancellationPolicyFee" => "array",
                "currentCancellationPolicyDeadline" => "string"
            ];
    
            if ($data !== null)
            {
                $this->fields['bookingNumber'] = $data['bookingnumber'];
                $this->fields['hotelId'] = $data{'hotel.id'};
                $this->fields['hotelName'] = $data{'hotel.name'};
                $this->fields['hotelAddress'] = $data{'hotel.address'};
                $this->fields['hotelPhone'] = $data{'hotel.phone'};
                $this->fields['numberOfRoom'] = $data['numberofrooms'];
                $this->fields['roomType'] = $data{'room.type'};
                $this->fields['roomEnglishType'] = $data{'room.englishType'};
                $this->fields['mealId'] = $data['mealId'];
                $this->fields['meal'] = $data['meal'];
                $this->fields['mealLabel'] = empty($data['mealLabel']) ? '' : $data['mealLabel'];
                $this->fields['englishMeal'] = empty($data['englishMeal']) ? '': $data['englishMeal'];
                $this->fields['englishMealLabel'] = empty($data['englishMealLabel']) ? '': $data['englishMealLabel'];
                $this->fields['checkinDate'] = $data['checkindate'];
                $this->fields['checkoutDate'] = $data['checkoutdate'];
                $this->fields['currency'] = $data['currency'];
                $this->fields['bookingDate'] = $data['bookingdate'];
                $this->fields['bookingDateTimezone'] = $data{'bookingdate.timezone'};
                $this->fields['checkinDate'] = $data['checkindate'];
                $this->fields['checkinDate'] = $data['checkindate'];

                $this->fields['paymentmethodId'] = empty($data['paymentmethod']{'@attributes'}['id']) ? '' : $data['paymentmethod']{'@attributes'}['id'];
                $this->fields['paymentmethodName'] = empty($data['paymentmethod']{'@attributes'}['name']) ? '' : $data['paymentmethod']{'@attributes'}['name'];
                $this->fields['earliestNonFreeCancellationDateLocal'] = $data{'earliestNonFreeCancellationDate.Local'};
                $this->fields['earliestNonFreeCancellationDateCet'] = $data{'earliestNonFreeCancellationDate.CET'};
                $this->fields['yourRef'] = empty($data['yourref']) ? '' : $data['yourref'];
                $this->fields['voucher'] = empty($data['voucher']) ? '' : $data['voucher'];
                $this->fields['bookedBy'] = empty($data['bookedBy']) ? '' : $data['bookedBy'];
                $this->fields['transferbooked'] = empty($data['transferbooked']) ? '' : $data['transferbooked'];
                $this->fields['paymentmethodId'] = empty($data['paymentmethod']{'@attributes'}['id']) ? '' : $data['paymentmethod']{'@attributes'}['id'];
                $this->fields['paymentmethodName'] = empty($data['paymentmethod']{'@attributes'}['name']) ? '' : $data['paymentmethod']{'@attributes'}['name'];

                // array
                //$this->fields['prices'] = empty($data['prices']) ? new CancellationPolicies([]) : new prices($data['prices']);
                $this->fields['cancellationPolicies'] = empty($data['cancellationpolicies']) ? new CancellationPolicies([]) : new CancellationPolicies($data['cancellationpolicies']);
                $this->fields['hotelNotes'] = empty($data['hotelNotes']) ? new Notes('hotelNote', []) : new Notes('hotelNote', $data['hotelNotes']);
                $this->fields['englishHotelNotes'] = empty($data['englishHotelNotes']) ? new Notes('englishHotelNote', []) : new Notes('englishHotelNote', $data['englishHotelNotes']);
                $this->fields['roomNotes'] = empty($data['roomNotes']) ? new Notes('roomNote', []) : new Notes('roomNote', $data['roomNotes']);
                $this->fields['englishRoomNotes'] = empty($data['englishRoomNotes']) ? new Notes('roomNote', []) : new Notes('roomNote', $data['englishRoomNotes']);
                //$this->fields['currentCancellationPolicyFee'] = empty($data['currentCancellationPolicyFee']) ? new CurrentCancellationPolicyFee([]) : new CurrentCancellationPolicyFee($data['currentCancellationPolicyFee']);

            }
    }
}