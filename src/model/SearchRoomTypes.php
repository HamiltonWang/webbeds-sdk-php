<?php
/**
 * Created by PhpStorm.
 * User: Tomeu
 * Date: 11/12/2015
 * Time: 1:33 AM
 */
namespace webbeds\hotel_api_sdk\model;
/**
 * Class SearchRoomTypes
 * @package webbeds\hotel_api_sdk\model
 * @property integer total Total number of SearchRoomTypes
 */
class SearchRoomTypes extends ApiModel
{
    public function __construct(array $data = null)
    {
        $this->validFields = [
            "roomtype" => "array"
        ];

        if ($data !== null) {
            $this->fields = $data;
        }
    }
    /**
     * @return SearchRoomtypeIterator For iterate SearchRoomtypes list
     */
    public function iterator()
    {
        if (isset($this->fields['roomtype']) )
        {
            // make sure there is more than one item
            if (array_key_exists("0", $this->fields['roomtype'])) {
                return new SearchRoomTypeIterator($this->fields['roomtype']);
            } else {
                $item = $this->fields['roomtype'];
                $this->fields['roomtype'] = [];
                array_push($this->fields['roomtype'], $item);
                return new SearchRoomtypeIterator($this->fields['roomtype']);
            }
            
        }
            
        return new SearchRoomtypeIterator([]);
    }
}