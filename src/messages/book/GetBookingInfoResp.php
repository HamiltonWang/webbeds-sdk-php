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
// use webbeds\hotel_api_sdk\model\book\Bookings;

/**
 * Class GetBookingInfoResp
 * @package webbeds\hotel_api_sdk\messages
 * @property Book book used for hotel content
 */
class GetBookingInfoResp extends ApiResponse
{
    /**
     * @param array $rsData Array of data response for book
     */
    public function __construct(\SimpleXMLElement $rsData)
    {
        //simplexml_tree($rsData, true);
        if (!isset($rsData[0]['ErrorType'])){
            $this->bookings = $rsData->bookings->booking;
            $this->error = NULL;
        } else {
            $this->error = $rsData[0]['Message'];
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
     * @return bool Returns True when response language list is empty. False otherwise.
     */
    public function isEmpty()
    {
        return (count($this->bookings)=== 0);
    }
    
    /**
     * @return bool Returns True when response language list is empty. False otherwise.
     */
    public function RowCount()
    {
        return count( $this->bookings->booking);
    }

    /**
     * @return AuditData Return class of audit
     */
    public function auditData()
    {
        return new AuditData($this->auditData);
    }

}