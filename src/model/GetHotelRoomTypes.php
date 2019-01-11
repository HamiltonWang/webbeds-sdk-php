<?php
/**
 * Created by PhpStorm.
 * User: Tomeu
 * Date: 11/12/2015
 * Time: 1:33 AM
 */
namespace webbeds\hotel_api_sdk\model;
/**
 * Class GetHotelRoomTypes
 * @package webbeds\hotel_api_sdk\model
 * @property integer total Total number of GetHotelRoomTypes
 */
class GetHotelRoomTypes extends ApiModel
{
    public function __construct(array $data = null)
    {
        $this->validFields = [
            "roomtype" => "array",
        ];

        if ($data !== null) {
            $this->fields = $data;
        }
    }
    /**
     * @return GetHotelRoomtypeIterator For iterate GetHotelRoomtypes list
     */
    public function iterator()
    {
        /*
        if ( isset($this->roomtypes['hotel'])) {
            echo 'xx count:' . count( $this->hotels['hotel']). ' x';
        } else {
            echo 'xx count:0 xx' ;
        }*/
        
        /*
        echo ( isset($this->fields['roomtype'])? "roomtype isset:yes\r\n" : "roomtype isset:no\r\n");
        echo ( is_null($this->fields['roomtype'])? "roomtype is_null:yes\r\n" : "roomtype is_null:no\r\n");
        echo ( empty($this->fields['roomtype'])? "roomtype empty:yes\r\n" : "roomtype empty:no\r\n");
        */
        //print_r($this->roomtype);

        if (isset($this->fields['roomtype']) )
        {
            // make sure there is more than one item
            if (array_key_exists("0", $this->fields['roomtype'])) {
                return new GetHotelRoomTypeIterator($this->fields['roomtype']);
            } else {
                $item = $this->fields['roomtype'];
                $this->fields['roomtype'] = [];
                array_push($this->fields['roomtype'], $item);
                return new GetHotelRoomtypeIterator($this->fields['roomtype']);
            }
            
        }
            
        return new GetHotelRoomtypeIterator([]);
    }
}