<?php
/**
 * Created by PhpStorm.
 * User: xortiz
 * Date: 07/09/2016
 * Time: 06:21 PM
 */
namespace webbeds\hotel_api_sdk\model\common;

use webbeds\hotel_api_sdk\model\ApiModel;

class PriceIterator implements \Iterator
{
    private $Prices, $position = 0;
    public function __construct(array $Prices)
    {
        $this->Prices = $Prices;
        
    }
    public function current()
    {
        //print_r($this->Prices);
        return new Price($this->Prices[$this->position]);
    }
    public function next()
    {
        ++$this->position;
    }
    public function key()
    {
        return $this->Prices[$this->position]{'currency'}.$this->Prices[$this->position]{'paymentMethods'};
    }
    public function valid()
    {
        return ( $this->position < count($this->Prices) );
    }
    public function rewind()
    {
        $this->position = 0;
    }
}