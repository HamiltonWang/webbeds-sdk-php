<?php
/**
 * Created by PhpStorm.
 * User: Tomeu
 * Date: 11/12/2015
 * Time: 1:33 AM
 */
namespace webbeds\hotel_api_sdk\model\search;

use webbeds\hotel_api_sdk\model\ApiModel;

/**
 * Class PaymentMethods
 * @package webbeds\hotel_api_sdk\model
 * @property integer total Total number of PaymentMethods
 */
class PaymentMethods extends ApiModel
{
    public function __construct(array $data = null)
    {
        $this->validFields = [
            "paymentMethod" => "array",
        ];

        if ($data !== null) {
            $this->fields = $data;
        }
    }
    /**
     * @return PaymentMethodIterator For iterate PaymentMethods list
     */
    public function iterator()
    {
        if (isset($this->fields['paymentMethod']) )
        {
            // make sure there is more than one item
            if (array_key_exists("0", $this->fields['paymentMethod'])) {
                return new PaymentMethodIterator($this->fields['paymentMethod']);
            } else {
                $item = $this->fields['paymentMethod'];
                $this->fields['paymentMethod'] = [];
                array_push($this->fields['paymentMethod'], $item);
                return new PaymentMethodIterator($this->fields['paymentMethod']);
            }
            
        }
            
        return new PaymentMethodIterator([]);
    }
}