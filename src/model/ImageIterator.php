<?php
/**
 * Created by PhpStorm.
 * User: Tomeu
 * Date: 11/12/2015
 * Time: 2:21 AM
 */
namespace webbeds\hotel_api_sdk\model;
class ImageIterator implements \Iterator
{
    private $images, $position = 0;
    public function __construct(array $images)
    {
        $this->images = $images;

    }
    public function current()
    {
        return new Image($this->images[$this->position]);
    }
    public function next()
    {
        ++$this->position;
    }
    public function key()
    {
        return $this->images[$this->position]{'@attributes'}['id'];
    }
    public function valid()
    {
        return ( $this->position < count($this->images) );
    }
    public function rewind()
    {
        $this->position = 0;
    }
}