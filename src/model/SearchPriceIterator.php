<?php
/**
 * Created by PhpStorm.
 * User: xortiz
 * Date: 07/09/2016
 * Time: 06:21 PM
 */
namespace webbeds\hotel_api_sdk\model;

use webbeds\hotel_api_sdk\model\SearchPrice;

class SearchPriceIterator implements \Iterator
{
    private $searchPrices, $position = 0;
    public function __construct(array $searchPrices)
    {
        $this->searchPrices = $searchPrices;
        
    }
    public function current()
    {
        //print_r($this->searchPrices);
        return new SearchPrice($this->searchPrices[$this->position]);
    }
    public function next()
    {
        ++$this->position;
    }
    public function key()
    {
        return $this->searchPrices[$this->position]{'paymentMethods'};
    }
    public function valid()
    {
        return ( $this->position < count($this->searchPrices) );
    }
    public function rewind()
    {
        $this->position = 0;
    }
}