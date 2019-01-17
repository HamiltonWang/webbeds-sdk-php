<?php
/**
 * Created by PhpStorm.
 * User: xortiz
 * Date: 07/09/2016
 * Time: 06:21 PM
 */
namespace webbeds\hotel_api_sdk\model;

use webbeds\hotel_api_sdk\model\Language;

class LanguageIterator implements \Iterator
{
    private $languages, $position = 0;
    public function __construct(array $languages)
    {
        $this->languages = $languages;
        
    }
    public function current()
    {
        //print_r($this->languages);
        return new Language($this->languages[$this->position]);
    }
    public function next()
    {
        ++$this->position;
    }
    public function key()
    {
        return $this->languages[$this->position]["isoCode"];
    }
    public function valid()
    {
        return ( $this->position < count($this->languages) );
    }
    public function rewind()
    {
        $this->position = 0;
    }
}