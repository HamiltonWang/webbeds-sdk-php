<?php
/**
 * Created by PhpStorm.
 * User: xortiz
 * Date: 07/09/2016
 * Time: 06:21 PM
 */
namespace webbeds\hotel_api_sdk\model\search;

use webbeds\hotel_api_sdk\model\ApiModel;

class RoomNoteTypeIterator implements \Iterator
{
    private $roomNoteTypes, $position = 0;
    public function __construct(array $noteTypes)
    {
        $this->noteTypes = $noteTypes;        
    }
    public function current()
    {
        $name = $this->noteTypes[$this->position]{'@attributes'}['text'];
        $id = $this->noteTypes[$this->position]{'@attributes'}['id'];
        return new RoomNoteType($id, $name);
    }
    public function next()
    {
        ++$this->position;
    }
    public function key()
    {
        return $this->noteTypes[$this->position]{'@attributes'}['id'];
    }
    public function valid()
    {
        return ( $this->position < count($this->noteTypes) );
    }
    public function rewind()
    {
        $this->position = 0;
    }
}