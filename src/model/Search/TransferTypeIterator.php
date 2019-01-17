<?php
/**
 * Created by PhpStorm.
 * User: xortiz
 * Date: 07/09/2016
 * Time: 06:21 PM
 */
namespace webbeds\hotel_api_sdk\model;

use webbeds\hotel_api_sdk\model\TransferType;

class TransferTypeIterator implements \Iterator
{
    private $transferTypes, $position = 0;
    public function __construct(array $transferType)
    {
        $this->transferType = $transferType;        
    }
    public function current()
    {
        $name = $this->transferType[$this->position]['name'];
        $id = $this->transferType[$this->position]['id'];
        
        return new TransferType($id, $name);
    }
    public function next()
    {
        ++$this->position;
    }
    public function key()
    {
        return $this->transferType[$this->position]['id'];
    }
    public function valid()
    {
        return ( $this->position < count($this->transferType) );
    }
    public function rewind()
    {
        $this->position = 0;
    }
}