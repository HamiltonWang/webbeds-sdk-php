<?php
/**
 * Created by PhpStorm.
 * User: Tomeu
 * Date: 11/12/2015
 * Time: 2:21 AM
 */
namespace webbeds\hotel_api_sdk\model\search;

use webbeds\hotel_api_sdk\model\ApiModel;

class PaymentMethodIterator implements \Iterator
{
    private $paymentMethods, $position = 0;
    public function __construct(array $paymentMethods)
    {
        $this->paymentMethods = $paymentMethods;

    }
    public function current()
    {
        return new PaymentMethod($this->paymentMethods[$this->position]);
    }
    public function next()
    {
        ++$this->position;
    }
    public function key()
    {
        return $this->paymentMethods[$this->position]{'@attributes'}['id'];
    }
    public function valid()
    {
        return ( $this->position < count($this->paymentMethods) );
    }
    public function rewind()
    {
        $this->position = 0;
    }
}