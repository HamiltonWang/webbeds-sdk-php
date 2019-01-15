<?php
/**
 * Created by PhpStorm.
 * User: Tomeu
 * Date: 11/12/2015
 * Time: 1:33 AM
 */
namespace webbeds\hotel_api_sdk\model;
/**
 * Class SearchPrices
 * @package webbeds\hotel_api_sdk\model
 * @property integer total Total number of SearchPrices
 */
class SearchPrices extends ApiModel
{
    public function __construct(array $data = null)
    {
        $this->validFields = [
            "price" => "array",
        ];
   
        if ($data !== null) {
            $this->fields = $data;
        }
    }
    /**
     * @return SearchPriceIterator For iterate SearchPrices list
     */
    public function iterator()
    {
        if (isset($this->fields['price']) )
        {
            // make sure there is more than one item
            if (gettype($this->fields['price'])=='array' ) {  //array_key_exists("0", $this->fields['price']
                return new SearchPriceIterator($this->fields['price']);
            } else {
                $item = $this->fields['price'];
                $this->fields['price'] = [];
                array_push($this->fields['price'], $item);
                return new SearchPriceIterator($this->fields['price']);
            }
            
        }
            
        return new SearchPriceIterator([]);
    }
}