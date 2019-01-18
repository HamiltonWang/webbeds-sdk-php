<?php
/**
 * #%L
 * hotel-api-sdk
 * %%
 * Copyright (C) 2019 Hamilton
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
namespace webbeds\hotel_api_sdk\messages\book;

use webbeds\hotel_api_sdk\messages\baseClass\ApiResponse;
use webbeds\hotel_api_sdk\model\common\PriceBreakdowns;
use webbeds\hotel_api_sdk\model\common\CancellationPolicyIterator;
use webbeds\hotel_api_sdk\model\common\Prices;
use webbeds\hotel_api_sdk\model\book\Notes;


/**
 * Class BookResp
 * @package webbeds\hotel_api_sdk\messages
 * @property Book search used for hotel content
 */
class BookResp extends ApiResponse
{
    /**
     * @var string bookingNumber
     */
    public $bookingNumber;
    /**
     * @var integer hotelId 
     */
    public $hotelId;
    /**
     * @var string hotelName
     */
    public $hotelName;
    /**
     * @var string hotelAddress
     */
    public $hotelAddress;
    /**
     * @var string hotelPhone
     */
    public $hotelPhone;
    /**
     * @var integer numberOfRooms
     */
    public $numberOfRooms;
    /**
     * @var string roomType
     */
    public $roomType;
    /**
     * @var string roomEnglishType
     */
    public $roomEnglishType;
    /**
     * @var integer mealId
     */
    public $mealId;
    /**
     * @var string meal
     */
    public $meal;
    /**
     * @var string mealLabel
     */
    public $mealLabel;
    /**
     * @var string englishMeal
     */
    public $englishMeal;
    /**
     * @var string englishMealLabel
     */
    public $englishMealLabel;
    /**
     * @var string checkinDate
     */
    public $checkinDate;
    /**
     * @var string checkoutDate
     */
    public $checkoutDate;
    /**
     * @var string prices
     */
    public $prices;
    /**
     * @var string currency
     */
    public $currency;
    /**
     * @var string bookingDate
     */
    public $bookingDate;
    /**
     * @var string bookingdateTimezone
     */
    public $bookingdateTimezone;
    /**
     * @var array cancellationPolicies
     */
    public $cancellationPolicies;
    /**
     * @var string earliestNonFreeCancellationDateLocal
     */
    public $earliestNonFreeCancellationDateLocal;
    /**
     * @var string earliestNonFreeCancellationDateCet
     */
    public $earliestNonFreeCancellationDateCet;
    /**
     * @var string yourRef
     */
    public $yourRef;
    /**
     * @var string voucher
     */
    public $voucher;
    /**
     * @var string bookedBy
     */
    public $bookedBy;
    /**
     * @var integer paymentmethodId
     */
    public $paymentmethodId;
    /**
     * @var string paymentmethodName
     */
    public $paymentmethodName;
    /**
     * @var array hotelNotes
     */
    public $hotelNotes;
    /**
     * @var array englishHotelNotes
     */
    public $englishHotelNotes;
    /**
     * @var array roomNotes
     */
    public $roomNotes;
    /**
     * @var array englishRoomNotes
     */
    public $englishRoomNotes;
    /**
     * @var string invoiceRef
     */
    public $invoiceRef;
    /**
     * @var string error
     */
    public $error;


    /**
     * @param array $rsData Array of data response for search
     */
    public function __construct(array $rsData)
    {
        parent::__construct($rsData);

        //if (array_key_exists("PreBookCode", $rsData)) {
        if (!isset($rsData['Error'])){
            $this->bookingNumber = $this->booking['bookingnumber'];
            $this->hotelId = $this->booking{'hotel.id'};
            $this->hotelName = $this->booking{'hotel.name'};
            $this->hotelAddress = $this->booking{'hotel.address'};
            $this->hotelPhone = $this->booking{'hotel.phone'};
            $this->numberOfRooms = $this->booking['numberofrooms'];
            $this->roomType = $this->booking{'room.type'};
            $this->roomEnglishType = $this->booking{'room.englishType'};
            $this->mealId = $this->booking['mealId'];
            $this->meal = $this->booking['meal'];
            $this->mealLabel = empty($this->booking['mealLabel']) ? '' : $this->booking['mealLabel'];
            $this->englishMeal = $this->booking['englishMeal'];
            $this->englishMealLabel = empty($this->booking['englishMealLabel']) ? '' : $this->booking['englishMealLabel'];
            $this->checkinDate = $this->booking['checkindate'];
            $this->checkoutDate = $this->booking['checkoutdate'];
            // TODO: enable to be parsed properly
            //$this->prices = new Prices ($this->booking['prices']['price']);
            $this->prices = json_encode($this->booking['prices']['price']);

            $this->currency = $this->booking['currency'];
            $this->bookingDate = $this->booking['bookingdate'];
            $this->bookingdateTimezone = $this->booking{'bookingdate.timezone'};
            $this->cancellationPolicies = $this->booking['cancellationpolicies'];
            $this->earliestNonFreeCancellationDateLocal = $this->booking{'earliestNonFreeCancellationDate.Local'};
            $this->earliestNonFreeCancellationDateCet = $this->booking{'earliestNonFreeCancellationDate.CET'};
            $this->yourRef = empty($this->booking['yourref']) ? '' : $this->booking['yourref'];
            $this->voucher = empty($this->booking['voucher']) ? '' : $this->booking['voucher'];
            $this->bookedBy = empty($this->booking['bookedBy']) ? '' : $this->booking['bookedBy'];
            $this->transferBooked = empty($this->booking['transferbooked']) ? '' : $this->booking['transferbooked'];
            $this->paymentmethodId = empty($this->booking['paymentmethod']{'@attributes'}['id']) ? '' : $this->booking['paymentmethod']{'@attributes'}['id'];
            $this->paymentmethodName = empty($this->booking['paymentmethod']{'@attributes'}['name']) ? '' : $this->booking['paymentmethod']{'@attributes'}['name'];
            $this->hotelNotes = empty($this->booking['hotelNotes']) ? new Notes('hotelNote', []) : new Notes('hotelNote', $this->booking['hotelNotes']);
            $this->englishHotelNotes = empty($this->booking['englishHotelNotes']) ? new Notes('englishHotelNote', []) : new Notes('englishHotelNote', $this->booking['englishHotelNotes']);
            $this->roomNotes = empty($this->booking['roomNotes']) ? new Notes('roomNote', []) : new Notes('roomNote', $this->booking['roomNotes']);
            $this->englishRoomNotes = empty($this->booking['englishRoomNotes']) ? new Notes('roomNote', []) : new Notes('roomNote', $this->booking['englishRoomNotes']);
            $this->invoiceRef = empty($this->booking['invoiceref']) ? '' : $this->booking['invoiceref'];
            $this->error = NULL;
            $this->booking = NULL;
            unset($this->booking);
        } else {
            $this->error = $this->Error['Message'];
        }
    }

    /**
     * @return CancellationPolicyIterator For iterate CancellationPolicies list
     */
    public function cancellationPoliciesIterator()
    {   
        if (isset($this->cancellationPolicies)){
            $key = 1;
            // make sure there is more than one item
            if (array_key_exists("0", $this->cancellationPolicies)) {
                foreach($this->cancellationPolicies as &$item){
                    $item['id'] = $key;
                    $key++;
                }
                return new CancellationPolicyIterator($this->cancellationPolicies);
            } else {
                $item = $this->cancellationPolicies;
                $item['id'] = $key;
                $item = [];
                array_push($item, $item);
                return new CancellationPolicyIterator($item);
            }
        }
            
        return new CancellationPolicyIterator([]);
    }
    /**
     * @return bool Returns True when response language list is empty. False otherwise.
     */
    public function isError()
    {
        return (!is_null($this->error));
    }

    /**
     * @return AuditData Return class of audit
     */
    public function auditData()
    {
        return new AuditData($this->auditData);
    }

}