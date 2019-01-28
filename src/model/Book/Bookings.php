<?php
/**
 * Created by PhpStorm.
 * User: Tomeu
 * Date: 11/12/2015
 * Time: 1:33 AM
 */
namespace webbeds\hotel_api_sdk\model\book;

use webbeds\hotel_api_sdk\model\ApiModel;
use webbeds\hotel_api_sdk\utility\UtilityHelper;

/**
 * Class Bookings
 * @package webbeds\hotel_api_sdk\model
 * @property integer total Total number of Bookings
 */
class Bookings extends ApiModel
{
    public function __construct(\SimpleXMLElement $bookings = null)
    {
        //print_r(UtilityHelper::XMLtoArray($bookings));
        //simplexml_tree($bookings[0], true);   
        
        $this->validFields = [
            "bookings" => "array",
        ];

        if ($bookings !== null) {
            $this->fields['bookings'] = $bookings;
        }
    }
    /**
     * @return BookingIterator For iterate Bookings list
     */
    public function iterator()
    {
        if (isset($this->fields['bookings']) )
        {
            // make sure there is more than one item
            if (array_key_exists("0", $this->fields['bookings'])) {
                return new BookingIterator($this->fields['bookings']);
            } else {
                $item = $this->fields['bookings'];
                $this->fields['bookings'] = [];
                array_push($this->fields['bookings'], $item);
                return new BookingIterator($this->fields['bookings']);
            }
            
        }
            
        return new BookingIterator([]);
    }
}