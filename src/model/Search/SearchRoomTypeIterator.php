<?php
/**
 * Created by PhpStorm.
 * User: xortiz
 * Date: 07/09/2016
 * Time: 06:21 PM
 */
namespace webbeds\hotel_api_sdk\model\search;

use webbeds\hotel_api_sdk\model\ApiModel;

class SearchRoomTypeIterator implements \Iterator
{
    private $searchRoomTypes, $position = 0;
    public function __construct(array $searchRoomTypes)
    {
        $this->searchRoomTypes = $searchRoomTypes;
        
    }
    public function current()
    {
        //print_r($this->searchRoomTypes);
        return new SearchRoomType($this->searchRoomTypes[$this->position]);
    }
    public function next()
    {
        ++$this->position;
    }
    public function key()
    {
        return $this->searchRoomTypes[$this->position]{"roomtype.ID"};
    }
    public function valid()
    {
        return ( $this->position < count($this->searchRoomTypes) );
    }
    public function rewind()
    {
        $this->position = 0;
    }
}