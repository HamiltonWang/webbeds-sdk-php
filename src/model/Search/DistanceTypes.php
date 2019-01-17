<?php
/**
 * Created by PhpStorm.
 * User: Tomeu
 * Date: 11/12/2015
 * Time: 1:33 AM
 */
namespace webbeds\hotel_api_sdk\model\search;

use webbeds\hotel_api_sdk\model\ApiModel;

/**
 * Class DistanceTypes
 * @package webbeds\hotel_api_sdk\model
 * @property integer total Total number of DistanceTypes
 */
class DistanceTypes extends ApiModel
{
    public function __construct(array $data = null)
    {
        $this->validFields = [
            "distanceType" => "array",
        ];

        if ($data !== null) {
            $this->fields = $data;
        }
    }
    /**
     * @return DistanceTypeIterator For iterate DistanceTypes list
     */
    public function iterator()
    {
        if (isset($this->fields['distanceType']) )
        {
            // make sure there is more than one item
            if (array_key_exists("0", $this->fields['distanceType'])) {
                return new DistanceTypeIterator($this->fields['distanceType']);
            } else {
                $item = $this->fields['distanceType'];
                $this->fields['distanceType'] = [];
                array_push($this->fields['distanceType'], $item);
                return new DistanceTypeIterator($this->fields['distanceType']);
            }
            
        }
            
        return new DistanceTypeIterator([]);
    }
}