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
namespace webbeds\hotel_api_sdk\messages\search;

use webbeds\hotel_api_sdk\messages\baseClass\ApiResponse;
use webbeds\hotel_api_sdk\model\search\HotelIterator;

/**
 * Class HotelResp
 * @package webbeds\hotel_api_sdk\messages
 * @property Hotels roomNoteTypes used for hotel content
 */
class GetHotelsResp extends ApiResponse
{
    /**
     * @param array $rsData Array of data response for roomNoteTypes
     */
    public function __construct(array $rsData)
    {
        parent::__construct($rsData);
        //print_r($this->hotels['hotel']);
        //echo ( isset($this->hotels['hotel'])? "hotels isset:yes".PHP_EOL : "hotels isset:no".PHP_EOL);
        //echo ( is_null($this->hotels['hotel'])? "hotels is_null:yes".PHP_EOL : "hotels is_null:no".PHP_EOL);
        //echo ( empty($this->hotels['hotel'])? "hotels empty:yes".PHP_EOL : "hotels empty:no".PHP_EOL);

        if (array_key_exists("hotels", $rsData)) {
            if ( isset($this->hotels['hotel'])) {
                if (array_key_exists("0", $this->hotels['hotel'])) {
                    //echo 'hotel:multiple';
                    $this->hotels = $rsData['hotels']['hotel'];
                } else {
                    $this->hotels= [];
                    $item = $rsData['hotels']['hotel'];
                    array_push($this->hotels, $item);
                    //echo 'hotel:single';
                }
                
            } else {
                $this->hotels = [];
            }
        }
    }
    /**
     * @return bool Returns True when response roomNoteType list is empty. False otherwise.
     */
    public function isEmpty()
    {
        if (array_key_exists("0", $this->hotels)) {
            return false;
        } else {
            return true;
        }
    }

    public function iterator()
    {
        if ($this->hotels !== null)
            
            return new HotelIterator($this->hotels);
        return new HotelIterator([]);
    }

    /**
     * @return AuditData Return class of audit
     */
    public function auditData()
    {
        return new AuditData($this->auditData);
    }

}