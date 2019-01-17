<?php
/**
 * Created by PhpStorm.
 * User: Tomeu
 * Date: 11/12/2015
 * Time: 1:33 AM
 */
namespace webbeds\hotel_api_sdk\model;
/**
 * Class Rooms
 * @package webbeds\hotel_api_sdk\model
 * @property integer total Total number of Rooms
 */
class Rooms extends ApiModel
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
     * @return RoomIterator For iterate Rooms list
     */
    public function iterator()
    {
        if (isset($this->fields['room']) )
        {
            // make sure there is more than one item
            if (array_key_exists("0", $this->fields['room'])) {
                return new RoomIterator($this->fields['room']);
            } else {
                $item = $this->fields['room'];
                $this->fields['room'] = [];
                array_push($this->fields['room'], $item);
                return new RoomIterator($this->fields['room']);
            }
            
        }
            
        return new RoomIterator([]);
    }
}