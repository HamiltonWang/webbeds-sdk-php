<?php
/**
 * Created by PhpStorm.
 * User: Tomeu
 * Date: 11/12/2015
 * Time: 2:21 AM
 */
namespace webbeds\hotel_api_sdk\model;
class SearchRoomIterator implements \Iterator
{
    private $searchRooms, $position = 0;
    public function __construct(array $searchRooms)
    {
        $this->searchRooms = $searchRooms;

    }
    public function current()
    {
        return new SearchRoom($this->searchRooms[$this->position]);
    }
    public function next()
    {
        ++$this->position;
    }
    public function key()
    {
        return $this->searchRooms[$this->position]['id'];
    }
    public function valid()
    {
        return ( $this->position < count($this->searchRooms) );
    }
    public function rewind()
    {
        $this->position = 0;
    }
}