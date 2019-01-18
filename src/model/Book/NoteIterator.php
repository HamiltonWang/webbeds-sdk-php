<?php
/**
 * Created by PhpStorm.
 * User: xortiz
 * Date: 07/09/2016
 * Time: 06:21 PM
 */
namespace webbeds\hotel_api_sdk\model\book;

use webbeds\hotel_api_sdk\model\ApiModel;

class NoteIterator implements \Iterator
{
    private $notes, $position = 0;

    public function __construct(array $notes)
    {
        $this->notes = $notes;
    }
    public function current()
    {
        //print_r($this->notes);
        return new Note($this->notes[$this->position]);
    }
    public function next()
    {
        ++$this->position;
    }
    public function key()
    {
        return $this->notes[$this->position]['id'];
    }
    public function valid()
    {
        return ( $this->position < count($this->notes) );
    }
    public function rewind()
    {
        $this->position = 0;
    }
}