<?php
/**
 * Created by PhpStorm.
 * User: xortiz
 * Date: 07/09/2016
 * Time: 06:21 PM
 */
namespace webbeds\hotel_api_sdk\model\search;

class SearchHotelIterator implements \Iterator
{
    private $hotels, $position = 0;
    public function __construct(\SimpleXMLElement $hotels)
    {
        $this->hotels = $hotels->hotels->hotel;
        
    }
    public function current()
    {
        $data = [];
        //simplexml_tree($this->hotels, true);
        $data['hotelId'] = $this->hotels[$this->position]->{'hotel.id'};
        $data['destinationId'] = $this->hotels[$this->position]->destination_id;
        $data['resortId'] = $this->hotels[$this->position]->resort_id;
        $data['transfer'] = $this->hotels[$this->position]->transfer;
        $data['roomTypes'] = $this->hotels[$this->position]->roomtypes;
        $data['notes'] = empty($this->hotels[$this->position]->notes) ? $this->hotels[$this->position]->notes : '';
        $data['distance '] = empty($this->hotels[$this->position]->distance) ? $this->hotels[$this->position]->distance : '';
        $data['codes'] = empty($this->hotels[$this->position]->codes) ? $this->hotels[$this->position]->codes : '';

        return new SearchHotel($data);
    }
    public function next()
    {
        ++$this->position;
    }
    public function key()
    {
        return $this->hotels[$this->position]->{"hotel.id"};
    }
    public function valid()
    {
        return ( $this->position < count($this->hotels) );
    }
    public function rewind()
    {
        $this->position = 0;
    }
}