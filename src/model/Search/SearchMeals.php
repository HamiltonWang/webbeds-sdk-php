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
 * Class SearchMeals
 * @package webbeds\hotel_api_sdk\model
 * @property integer total Total number of SearchMeals
 */
class SearchMeals extends ApiModel
{
    public function __construct(array $data = null)
    {
        $this->validFields = [
            "meal" => "array",
        ];

        if ($data !== null) {
            $this->fields = $data;
        }
    }
    /**
     * @return SearchMealIterator For iterate SearchMeals list
     */
    public function iterator()
    {
        if (isset($this->fields['meal']) )
        {
            // make sure there is more than one item
            if (array_key_exists("0", $this->fields['meal'])) {
                return new SearchMealIterator($this->fields['meal']);
            } else {
                $item = $this->fields['meal'];
                $this->fields['meal'] = [];
                array_push($this->fields['meal'], $item);
                return new SearchMealIterator($this->fields['meal']);
            }
            
        }
            
        return new SearchMealIterator([]);
    }
}