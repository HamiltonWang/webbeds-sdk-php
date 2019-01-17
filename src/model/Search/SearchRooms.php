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
 * Class SearchRooms
 * @package webbeds\hotel_api_sdk\model
 * @property integer total Total number of SearchRooms
 */
class SearchRooms extends ApiModel
{
    public function __construct(array $data = null)
    {
        $this->validFields = [
            "room" => "array",
        ];

        if ($data !== null) {
            $this->fields = $data;
        }
    }
    /**
     * @return SearchRoomIterator For iterate SearchRooms list
     */
    public function iterator()
    {
        if (isset($this->fields['room']) )
        {
            // make sure there is more than one item
            if (array_key_exists("0", $this->fields['room'])) {
                return new SearchRoomIterator($this->fields['room']);
            } else {
                $item = $this->fields['room'];
                $this->fields['room'] = [];
                array_push($this->fields['room'], $item);
                return new SearchRoomIterator($this->fields['room']);
            }
            
        }
            
        return new SearchRoomIterator([]);
    }
}