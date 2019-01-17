<?php
/**
 * Created by PhpStorm.
 * User: Tomeu
 * Date: 11/12/2015
 * Time: 2:21 AM
 */
namespace webbeds\hotel_api_sdk\model\search;

use webbeds\hotel_api_sdk\model\ApiModel;

class GetHotelRoomTypeIterator implements \Iterator
{
    private $roomTypes, $position = 0;
    public function __construct(array $roomTypes)
    {
        $this->roomTypes = $roomTypes;

    }
    public function current()
    {
        return new GetHotelRoomType($this->roomTypes[$this->position]);
    }
    public function next()
    {
        ++$this->position;
    }
    public function key()
    {
        return $this->roomTypes[$this->position]{'roomtype.ID'};
    }
    public function valid()
    {
        return ( $this->position < count($this->roomTypes) );
    }
    public function rewind()
    {
        $this->position = 0;
    }
}