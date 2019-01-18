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
use webbeds\hotel_api_sdk\model\common\CancellationPolicies;

/**
 * Class PreBookV2Resp
 * @package webbeds\hotel_api_sdk\messages
 * @property PreBookV2 search used for hotel content
 */
class PreBookV2Resp extends ApiResponse
{
    /**
     * @param array $rsData Array of data response for search
     */
    public function __construct(array $rsData)
    {
        parent::__construct($rsData);

        //if (array_key_exists("PreBookCode", $rsData)) {
        if (!isset($rsData['Error'])){
            $this->preBookCode = $this->PreBookCode;
            $this->price =  $this->Price;
            $this->currency =  $this->PriceBreakdown{'@attributes'}['currency'];
            $this->from =  $this->PriceBreakdown{'@attributes'}['from'];
            $this->to =  $this->PriceBreakdown{'@attributes'}['to'];
            $this->total =  $this->PriceBreakdown{'@attributes'}['total'];
            $this->priceBreakdowns = new PriceBreakdowns($this->PriceBreakdown);
            $this->cancellationPolicies = new CancellationPolicies($this->CancellationPolicies);
            $this->error = NULL;
        } else {
            $this->error = $this->Error['Message'];
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