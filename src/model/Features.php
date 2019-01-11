<?php
/**
 * Created by PhpStorm.
 * User: Tomeu
 * Date: 11/12/2015
 * Time: 1:33 AM
 */
namespace webbeds\hotel_api_sdk\model;
/**
 * Class Features
 * @package webbeds\hotel_api_sdk\model
 * @property integer total Total number of Features
 */
class Features extends ApiModel
{
    public function __construct(array $data = null)
    {
        $this->validFields = [
            "feature" => "array",
        ];

        if ($data !== null) {
            $this->fields = $data;
        }
    }
    /**
     * @return FeatureIterator For iterate Features list
     */
    public function iterator()
    {
        /*
        if ( isset($this->features['hotel'])) {
            echo 'xx count:' . count( $this->hotels['hotel']). ' x';
        } else {
            echo 'xx count:0 xx' ;
        }*/
        
        /*
        echo ( isset($this->fields['feature'])? "feature isset:yes\r\n" : "feature isset:no\r\n");
        echo ( is_null($this->fields['feature'])? "feature is_null:yes\r\n" : "feature is_null:no\r\n");
        echo ( empty($this->fields['feature'])? "feature empty:yes\r\n" : "feature empty:no\r\n");
        */
        //print_r($this->feature);

        if (isset($this->fields['feature']) )
        {
            // make sure there is more than one item
            if (array_key_exists("0", $this->fields['feature'])) {
                return new FeatureIterator($this->fields['feature']);
            } else {
                $item = $this->fields['feature'];
                $this->fields['feature'] = [];
                array_push($this->fields['feature'], $item);
                return new FeatureIterator($this->fields['feature']);
            }
            
        }
            
        return new FeatureIterator([]);
    }
}