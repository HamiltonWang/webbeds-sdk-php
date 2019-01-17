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
    private $cancellationPolicies, $position = 0;
    public function __construct(array $cancellationPolicies)
    {
        $this->cancellationPolicies = $cancellationPolicies;
        
    }
    public function current()
    {
        //print_r($this->cancellationPolicies);
        return new CancellationPolicy($this->cancellationPolicies[$this->position]);
    }
    public function next()
    {
        ++$this->position;
    }
    public function key()
    {
        return $this->cancellationPolicies[$this->position]['deadline'];
    }
    public function valid()
    {
        return ( $this->position < count($this->cancellationPolicies) );
    }
    public function rewind()
    {
        $this->position = 0;
    }
}