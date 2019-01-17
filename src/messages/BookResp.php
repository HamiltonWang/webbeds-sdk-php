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
namespace webbeds\hotel_api_sdk\messages;

use webbeds\hotel_api_sdk\model\PriceBreakdowns;
use webbeds\hotel_api_sdk\model\CancellationPolicies;

/**
 * Class BookResp
 * @package webbeds\hotel_api_sdk\messages
 * @property Book search used for hotel content
 */
class BookResp extends ApiResponse
{
    /**
     * @param array $rsData Array of data response for search
     */
    public function __construct(array $rsData)
    {
        parent::__construct($rsData);

        //if (array_key_exists("PreBookCode", $rsData)) {
        if (!isset($this->Error)){
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
            $this->prices = new Prices ($this->booking['prices']);
            $this->currency = $this->booking['currency'];
            $this->bookingDate = $this->booking['bookingdate'];
            $this->bookingdateTimezone = $this->booking{'bookingdate.timezone'};
            $this->cancellationPolicies = $this->booking['cancellationpolicies'];
            echo 'Cancellation Policy:';
            print_r($this->booking{'earliestNonFreeCancellationDate.Local'});
            $this->earliestNonFreeCancellationDateLocal = $this->booking{'earliestNonFreeCancellationDate.Local'};
            $this->yourRef = empty($this->booking['yourref']) ? '' : $this->booking['yourref'];
            $this->voucher = empty($this->booking['voucher']) ? '' : $this->booking['voucher'];
            $this->bookedBy = empty($this->booking['bookedBy']) ? '' : $this->booking['bookedBy'];
            $this->transferBooked = empty($this->booking['transferbooked']) ? '' : $this->booking['transferbooked'];
            $this->paymentmethodId = empty($this->booking['paymentmethod']{'@attributes'}['id']) ? '' : $this->booking['paymentmethod']{'@attributes'}['id'];
            $this->paymentmethodName = empty($this->booking['paymentmethod']{'@attributes'}['name']) ? '' : $this->booking['paymentmethod']{'@attributes'}['name'];
            $this->hotelNotes = empty($this->booking['hotelNotes']) ? '' : $this->booking['hotelNotes'];
            $this->englishHotelNotes = empty($this->booking['englishHotelNotes']) ? '' : $this->booking['englishHotelNotes'];
            $this->roomNotes = empty($this->booking['roomNotes']) ? '' : $this->booking['roomNotes'];
            $this->invoiceRef = empty($this->booking['invoiceref']) ? '' : $this->booking['invoiceref'];
        } else {
            $this->error = isset($this->Error['Message']) ? $this->Error['Message']: NULL;
        }
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