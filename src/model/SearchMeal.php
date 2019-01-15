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
 * Class SearchMeal
 * @package webbeds\hotel_api_sdk\model
 * @property string userName User Name to use webBeds API
 * @property string password Password to use webBeds API
 */
class SearchMeal extends ApiModel
{
    /**
     * SearchMeals constructor.
     * @property string userName User Name to use webBeds API
     * @property string password Password to use webBeds API
     */
    public function __construct(array $data=null)
    {
        $this->validFields =
            [
                "id" => "integer",
                "price" => "string",
                "prices" => "array"
            ];

    
            if ($data !== null)
            {
                $this->fields['id'] = $data['id'];
                $this->fields['price'] = $data['prices']['price'];
                // TODO: price node cannot display attribute, and not an array
                //$this->fields['prices'] = empty($data['prices']) ? new SearchPrices([]): new SearchPrices($data['prices']);
            }
    }
}