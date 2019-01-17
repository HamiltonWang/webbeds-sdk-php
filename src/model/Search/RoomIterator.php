<?php
/**
 * Created by PhpStorm.
 * User: Tomeu
 * Date: 11/12/2015
 * Time: 2:21 AM
 */
namespace webbeds\hotel_api_sdk\model;
class RoomIterator implements \Iterator
{
    private $rooms, $position = 0;
    public function __construct(array $rooms)
    {
        $this->rooms = $rooms;

    }
    public function current()
    {
        return new Room($this->rooms[$this->position]);
    }
    public function next()
    {
        ++$this->position;
    }
    public function key()
    {
        return $this->rooms[$this->position]['id'];
    }
    public function valid()
    {
        return ( $this->position < count($this->rooms) );
    }
    public function rewind()
    {
        $this->position = 0;
    }
}