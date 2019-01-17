<?php
/**
 * Created by PhpStorm.
 * User: xortiz
 * Date: 07/09/2016
 * Time: 06:21 PM
 */
namespace webbeds\hotel_api_sdk\model\search;

use webbeds\hotel_api_sdk\model\ApiModel;

class SearchMealIterator implements \Iterator
{
    private $searchMeals, $position = 0;
    public function __construct(array $searchMeals)
    {
        $this->searchMeals = $searchMeals;
        
    }
    public function current()
    {
        //print_r($this->searchMeals);
        return new SearchMeal($this->searchMeals[$this->position]);
    }
    public function next()
    {
        ++$this->position;
    }
    public function key()
    {
        return $this->searchMeals[$this->position]['id'];
    }
    public function valid()
    {
        return ( $this->position < count($this->searchMeals) );
    }
    public function rewind()
    {
        $this->position = 0;
    }
}