<?php
/**
 * Created by PhpStorm.
 * User: xortiz
 * Date: 07/09/2016
 * Time: 06:21 PM
 */
namespace webbeds\hotel_api_sdk\model\book;

use webbeds\hotel_api_sdk\model\ApiModel;

class BookingIterator implements \Iterator
{
    private $bookings, $position = 0;
    public function __construct(array $bookings)
    {
        $this->bookings = $bookings;
        
    }
    public function current()
    {
        //print_r($this->bookings);
        return new Booking($this->bookings[$this->position]);
    }
    public function next()
    {
        ++$this->position;
    }
    public function key()
    {
        return $this->bookings[$this->position]['bookingnumber'];
    }
    public function valid()
    {
        return ( $this->position < count($this->bookings) );
    }
    public function rewind()
    {
        $this->position = 0;
    }
}