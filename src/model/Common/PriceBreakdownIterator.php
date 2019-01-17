<?php
/**
 * Created by PhpStorm.
 * User: Tomeu
 * Date: 11/12/2015
 * Time: 2:21 AM
 */
namespace webbeds\hotel_api_sdk\model\common;

use webbeds\hotel_api_sdk\model\ApiModel;

class PriceBreakdownIterator implements \Iterator
{
    private $priceBreakdowns, $position = 0;
    public function __construct(array $priceBreakdowns)
    {
        $this->priceBreakdowns = $priceBreakdowns;

    }
    public function current()
    {
        return new PriceBreakdown($this->priceBreakdowns[$this->position]);
    }
    public function next()
    {
        ++$this->position;
    }
    public function key()
    {
        return $this->priceBreakdowns[$this->position]['id'];
    }
    public function valid()
    {
        return ( $this->position < count($this->priceBreakdowns) );
    }
    public function rewind()
    {
        $this->position = 0;
    }
}