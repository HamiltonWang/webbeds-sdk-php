<?php
/**
 * Created by PhpStorm.
 * User: Tomeu
 * Date: 11/12/2015
 * Time: 1:33 AM
 */
namespace webbeds\hotel_api_sdk\model;
/**
 * Class Images
 * @package webbeds\hotel_api_sdk\model
 * @property integer total Total number of Images
 */
class Images extends ApiModel
{
    public function __construct(array $data = null)
    {
        $this->validFields = [
            "image" => "array",
        ];

        if ($data !== null) {
            $this->fields = $data;
        }
    }
    /**
     * @return ImageIterator For iterate Images list
     */
    public function iterator()
    {
        /*
        if ( isset($this->images['hotel'])) {
            echo 'xx count:' . count( $this->hotels['hotel']). ' x';
        } else {
            echo 'xx count:0 xx' ;
        }*/
        
        /*
        echo ( isset($this->fields['image'])? "image isset:yes\r\n" : "image isset:no\r\n");
        echo ( is_null($this->fields['image'])? "image is_null:yes\r\n" : "image is_null:no\r\n");
        echo ( empty($this->fields['image'])? "image empty:yes\r\n" : "image empty:no\r\n");
        */
        //print_r($this->image);

        if (isset($this->fields['image']) )
        {
            // make sure there is more than one item
            if (array_key_exists("0", $this->fields['image'])) {
                return new ImageIterator($this->fields['image']);
            } else {
                $item = $this->fields['image'];
                $this->fields['image'] = [];
                array_push($this->fields['image'], $item);
                return new ImageIterator($this->fields['image']);
            }
            
        }
            
        return new ImageIterator([]);
    }
}