<?php
/**
 * Created by PhpStorm.
 * User: xortiz
 * Date: 07/09/2016
 * Time: 06:21 PM
 */
namespace webbeds\hotel_api_sdk\model;

use webbeds\hotel_api_sdk\model\Hotel;
use webbeds\hotel_api_sdk\model\Images;
use webbeds\hotel_api_sdk\model\Features;


class HotelIterator implements \Iterator
{
    private $hotels, $position = 0;
    public function __construct(array $hotels)
    {
        $this->hotels = $hotels;    
    }
    public function current()
    {
        $data = [];
        $data['hotelId'] = $this->hotels[$this->position]{'hotel.id'};
        $data['destinationId'] = $this->hotels[$this->position]['destination_id'];
        $data['resortId'] = $this->hotels[$this->position]['resort_id'];
        $data['transfer'] = $this->hotels[$this->position]['transfer'];
        $data['notes'] = $this->hotels[$this->position]['notes'];
        $data['notes'] = gettype($data['notes'])=="array" ? null : $data['notes'];
        $data['codes'] = $this->hotels[$this->position]['codes'];
        $data['codes'] = gettype($data['codes'])=="array" ? null : $data['codes'];
        $data['type'] = (string)$this->hotels[$this->position]['type'];
        $data['name'] = $this->hotels[$this->position]['name'];

        $data['hotelAddr1'] = $this->hotels[$this->position]{'hotel.addr.1'};
        $data['hotelAddr1'] = gettype($data['hotelAddr1'])=="array" ? null : $data['hotelAddr1'];
        $data['hotelAddr2'] = $this->hotels[$this->position]{'hotel.addr.2'};
        $data['hotelAddr2'] = gettype($data['hotelAddr2'])=="array" ? null : $data['hotelAddr2'];
        $data['hotelAddrZip'] = $this->hotels[$this->position]{'hotel.addr.zip'};
        $data['hotelAddrZip'] = gettype($data['hotelAddrZip'])=="array" ? null : $data['hotelAddrZip'];
        $data['hotelAddrCity'] = $this->hotels[$this->position]{'hotel.addr.city'};
        $data['hotelAddrCity'] = gettype($data['hotelAddrCity'])=="array" ? null : $data['hotelAddrCity'];
        $data['hotelAddrState'] = $this->hotels[$this->position]{'hotel.addr.state'};
        $data['hotelAddrState'] = gettype($data['hotelAddrState'])=="array" ? null : $data['hotelAddrState'];
        $data['hotelAddrCountry'] = $this->hotels[$this->position]{'hotel.addr.country'};
        $data['hotelAddrCountry'] = gettype($data['hotelAddrCountry'])=="array" ? null : $data['hotelAddrCountry'];
        $data['hotelAddrCountryCode'] = $this->hotels[$this->position]{'hotel.addr.countrycode'};
        $data['hotelAddrCountryCode'] = gettype($data['hotelAddrCountryCode'])=="array" ? null : $data['hotelAddrCountryCode'];
        $data['hotelAddress'] = $this->hotels[$this->position]{'hotel.address'};
        $data['hotelAddress'] = gettype($data['hotelAddress'])=="array" ? null : $data['hotelAddress'];
        $data['hotelMapUrl'] = $this->hotels[$this->position]{'hotel.mapurl'};
        $data['hotelMapUrl'] = gettype($data['hotelMapUrl'])=="array" ? null : $data['hotelMapUrl'];
        $data['headline'] = $this->hotels[$this->position]['headline'];
        $data['headline'] = gettype($data['headline'])=="array" ? null : $data['headline'];
        $data['description'] = $this->hotels[$this->position]['description'];
        $data['description'] = gettype($data['description'])=="array" ? null : $data['description'];
        // theme skipped
        // images
        $data['images'] = new Images($this->hotels[$this->position]['images']);
        // features
        $data['features'] = new Features($this->hotels[$this->position]['features']);
        //roomtypes
        $data['hotelRoomType'] = new GetHotelRoomTypes($this->hotels[$this->position]['roomtypes']);

        $data['classification'] = $this->hotels[$this->position]['classification'];
        $data['latitude'] = $this->hotels[$this->position]['coordinates']['latitude'];
        $data['longitude'] = $this->hotels[$this->position]['coordinates']['longitude'];
        $data['distanceTypes'] = $this->hotels[$this->position]['distanceTypes'];
        $data['distanceTypes'] = gettype($data['distanceTypes'])=="array" ? null : $data['distanceTypes'];



        $data['timeZone'] = (string)$this->hotels[$this->position]['timeZone'];
        $data['isBestBuy'] = (string)$this->hotels[$this->position]['isBestBuy'];

        return new Hotel($data);    
    }
    public function next()
    {
        ++$this->position;
    }
    public function key()
    {
        return $this->hotels[$this->position]{'hotel.id'};;
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