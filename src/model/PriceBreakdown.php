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
 * Class PriceBreakdowns
 * @package webbeds\hotel_api_sdk\model
 * @property string userName User Name to use webBeds API
 * @property string password Password to use webBeds API
 */
class PriceBreakdown extends ApiModel
{
    /**
     * PriceBreakdowns constructor.
     * @property string userName User Name to use webBeds API
     * @property string password Password to use webBeds API
     */
    public function __construct(array $data=null)
    {
        $this->validFields =
            [   "id" => "string",
                "totalPrice" => "string",
                "price" => "string",
                "type" => "string",
                "breakdown" => "string"
            ];
             
            if ($data !== null)
            {
                $this->fields['id'] = $data['id'];
                $this->fields['totalPrice'] = $data{'@attributes'}['total'];
                $this->fields['price'] = $data['price']{'@attributes'}['value'];
                $this->fields['type'] = $data['price']{'@attributes'}['type'];
                $this->fields['breakdown'] = $data['price']{'@attributes'}['breakdown'];
            }
    }
}