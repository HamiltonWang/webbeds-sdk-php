<?php
/**
 * Created by PhpStorm.
 * User: xortiz
 * Date: 07/09/2016
 * Time: 06:21 PM
 */
namespace webbeds\hotel_api_sdk\model\search;

use webbeds\hotel_api_sdk\model\ApiModel;

class RoomTypeIterator implements \Iterator
{
    private $roomTypes, $position = 0;
    public function __construct(array $roomType)
    {
        $this->roomType = $roomType;        
    }
    public function current()
    {
        $name = $this->roomType[$this->position]['name'];
        $id = $this->roomType[$this->position]['id'];
        $sharedRoom = (int)$this->roomType[$this->position]['sharedRoom'];
        $sharedFacilities = (int)$this->roomType[$this->position]['sharedFacilities'];
        
        return new RoomType($id, $name, $sharedRoom, $sharedFacilities);
    }
    public function next()
    {
        ++$this->position;
    }
    public function key()
    {
        return $this->roomType[$this->position]['id'];
    }
    public function valid()
    {
        return ( $this->position < count($this->roomType) );
    }
    public function rewind()
    {
        $this->position = 0;
    }
}