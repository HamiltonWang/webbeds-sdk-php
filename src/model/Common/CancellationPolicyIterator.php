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
    private $cxls, $position = 0;
    public function __construct(array $cxls)
    {
        $this->cxls = $cxls;
        //print_r($cxls);
        
    }
    public function current()
    {
        //print_r($this->cxls);
        return new CancellationPolicy($this->cxls[$this->position]);
    }
    public function next()
    {
        ++$this->position;
    }
    public function key()
    {
        return $this->cxls[$this->position]['id'];
    }
    public function valid()
    {
        return ( $this->position < count($this->cxls) );
    }
    public function rewind()
    {
        $this->position = 0;
    }
}