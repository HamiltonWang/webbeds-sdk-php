<?php
/**
 * User: Hamilton
 * Date: 12/11/2018
 * Time: 11:15 AM
 */
namespace webbeds\hotel_api_sdk\helpers;

use hotelbeds\hotel_api_sdk\generic\DataContainer;
use Zend\Json\Json;
abstract class ApiHelper extends DataContainer
{
    public function __toString()
    {
        return Json::encode($this->toArray());
    }
}