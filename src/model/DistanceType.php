<?php
/**
 * Created by PhpStorm.
 * User: Tomeu
 * Date: 11/4/2015
 * Time: 8:43 PM
 */
namespace webbeds\hotel_api_sdk\model;

use webbeds\hotel_api_sdk\model\ApiModel;

/**
 * Class Features
 * @package webbeds\hotel_api_sdk\model
 * @property string userName User Name to use webBeds API
 * @property string password Password to use webBeds API
 */
class Feature extends ApiModel
{
    /**
     * Features constructor.
     * @property string userName User Name to use webBeds API
     * @property string password Password to use webBeds API
     */
    public function __construct(array $data=null)
    {
        $this->validFields =
        [
            "hotelDistanceTypeId" => "string",
            "description" => "string",
            "distances" => "array"
        ];

        if ($data !== null)
        {
            $this->fields['hotelDistanceTypeId'] = $data['hotelDistanceTypeId'];
            $this->fields['description'] = empty($data['description']) ? '': $data['description'];
            // Store as json as there is no key to iterate and it is not affecting struture
            $this->fields['distances'] = empty($data['distances']) ? array_to_json([]): array_to_json($data['distances']);
        }
    }

    function array_to_json(array $sel_array){
        foreach($sel_array as $key => $value){
            if(is_string($key) || is_string($value)) {
                $new_array[urlencode($key)] = urlencode($value);
            }
        }
       
        return urldecode(json_encode($new_array));
    }
}