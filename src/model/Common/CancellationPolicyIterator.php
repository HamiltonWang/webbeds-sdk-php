<?php
/**
 * Created by PhpStorm.
 * User: xortiz
 * Date: 07/09/2016
 * Time: 06:21 PM
 */
namespace webbeds\hotel_api_sdk\model\common;

use webbeds\hotel_api_sdk\model\ApiModel;

class CancellationPolicyIterator implements \Iterator
{
    private $cxl, $position = 0;
    public function __construct(array $cxl)
    {
        $this->cxl = $cxl;
        //print_r($cxl);
        
    }
    public function current()
    {
        //print_r($this->cxl);
        return new CancellationPolicy($this->cxl[$this->position]);
    }
    public function next()
    {
        ++$this->position;
    }
    public function key()
    {
        return $this->cxl[$this->position]['id'];
    }
    public function valid()
    {
        return ( $this->position < count($this->cxl) );
    }
    public function rewind()
    {
        $this->position = 0;
    }
}