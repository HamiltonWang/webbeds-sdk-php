<?php
/**
 * Created by PhpStorm.
 * User: xortiz
 * Date: 07/09/2016
 * Time: 06:21 PM
 */
namespace webbeds\hotel_api_sdk\model\search;

use webbeds\hotel_api_sdk\model\ApiModel;

class DestinationIterator implements \Iterator
{
    private $destinations, $position = 0;
    public function __construct(array $destination)
    {
        $this->destination = $destination;    
    }
    public function current()
    {
        $destination_id = (string)$this->destination[$this->position]['destination_id'];
        $destinationCode = $this->destination[$this->position]['DestinationCode'];
        $destinationCode = gettype($destinationCode)=="array" ? '' : $destinationCode;
        $destinationCode2 = $this->destination[$this->position]{'DestinationCode.2'};
        $destinationCode2 = gettype($destinationCode2)=="array" ? '' : $destinationCode2;
        $destinationCode3 = $this->destination[$this->position]{'DestinationCode.3'};
        $destinationCode3 = gettype($destinationCode3)=="array" ? '' : $destinationCode3;
        $destinationCode4 = $this->destination[$this->position]{'DestinationCode.4'};
        $destinationCode4 = gettype($destinationCode4)=="array" ? '' : $destinationCode4;

        $destinationName = (string)$this->destination[$this->position]['DestinationName'];
        $countryId = (string)$this->destination[$this->position]['CountryId'];
        $countryName = (string)$this->destination[$this->position]['CountryName'];
        $countryCode = (string)$this->destination[$this->position]['CountryCode'];
        $timeZone = (string)$this->destination[$this->position]['TimeZone'];

        return new Destination($destination_id, $destinationCode, $destinationCode2, 
                $destinationCode3, $destinationCode4, $destinationName, 
                $countryId, $countryName, $countryCode, $timeZone);    
    }
    public function next()
    {
        ++$this->position;
    }
    public function key()
    {
        return $this->destination[$this->position]['destination_id'];
    }
    public function valid()
    {
        return ( $this->position < count($this->destination) );
    }
    public function rewind()
    {
        $this->position = 0;
    }
}