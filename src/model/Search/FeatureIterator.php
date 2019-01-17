<?php
/**
 * Created by PhpStorm.
 * User: xortiz
 * Date: 07/09/2016
 * Time: 06:21 PM
 */
namespace webbeds\hotel_api_sdk\model;

use webbeds\hotel_api_sdk\model\Feature;

class FeatureIterator implements \Iterator
{
    private $features, $position = 0;
    public function __construct(array $features)
    {
        $this->features = $features;        
    }
    public function current()
    {
        $name = $this->features[$this->position]{'@attributes'}['name'];
        $id = $this->features[$this->position]{'@attributes'}['id'];
        return new Feature($id, $name);
    }
    public function next()
    {
        ++$this->position;
    }
    public function key()
    {
        return $this->features[$this->position]{'@attributes'}['id'];
    }
    public function valid()
    {
        return ( $this->position < count($this->features) );
    }
    public function rewind()
    {
        $this->position = 0;
    }
}