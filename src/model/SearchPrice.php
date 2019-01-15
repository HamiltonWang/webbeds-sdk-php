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
 * Class SearchPrice
 * @package webbeds\hotel_api_sdk\model
 * @property string userName User Name to use webBeds API
 * @property string password Password to use webBeds API
 */
class SearchPrice extends ApiModel
{
    /**
     * SearchPrices constructor.
     * @property string userName User Name to use webBeds API
     * @property string password Password to use webBeds API
     */
    public function __construct(array $data=null)
    {
        $this->validFields =
            [
                "price" => "string",
                "currency" => "string",
                "paymentMethods" => "integer"
            ];

            if ($data !== null)
            {
                $this->fields['price'] = $data['price'];
                $this->fields['currency'] = $data{'currency'};
                $this->fields['paymentMethods'] = $data{'paymentMethods'};
            }
    }
}