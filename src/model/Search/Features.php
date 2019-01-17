<?php
/**
 * Created by PhpStorm.
 * User: Tomeu
 * Date: 11/12/2015
 * Time: 1:33 AM
 */
namespace webbeds\hotel_api_sdk\model\search;

use webbeds\hotel_api_sdk\model\ApiModel;

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