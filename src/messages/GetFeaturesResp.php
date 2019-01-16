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

//use webbeds\hotel_api_sdk\model\Features;
use webbeds\hotel_api_sdk\model\FeatureIterator;

/**
 * Class FeatureResp
 * @package webbeds\hotel_api_sdk\messages
 * @property Features features used for hotel content
 */
class GetFeaturesResp extends ApiResponse
{
    /**
     * @param array $rsData Array of data response for features
     */
    public function __construct(array $rsData)
    {
        parent::__construct($rsData);
        if (array_key_exists("features", $rsData)) {
            $this->features = $rsData['features']['feature'];
        }
    }
    /**
     * @return bool Returns True when response feature list is empty. False otherwise.
     */
    public function isEmpty()
    {
        return (count( $this->features)=== 0);
    }

    public function iterator()
    {
        if ($this->features !== null)
            return new FeatureIterator($this->features);
        return new FeatureIterator([]);
    }

    /**
     * @return AuditData Return class of audit
     */
    public function auditData()
    {
        return new AuditData($this->auditData);
    }

}