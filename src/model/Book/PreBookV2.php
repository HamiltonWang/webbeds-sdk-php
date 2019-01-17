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
 * Class PreBookV2s
 * @package webbeds\hotel_api_sdk\model
 * @property string userName User Name to use webBeds API
 * @property string password Password to use webBeds API
 */
class PreBookV2 extends ApiModel
{
    /**
     * PreBookV2s constructor.
     * @property string userName User Name to use webBeds API
     * @property string password Password to use webBeds API
     */
    public function __construct(array $data=null)
    {
        $this->validFields =
            [   "preBookCode" => "string",
                "price" => "string",
                "currency" => "string",
                "priceBreakdowns" => "array",
                "totalPrice" => "string",
                "from" => "string",
                "to" => "string",
                "cancellationPolicies" => "array",
                "error" => "string"
            ];
             echo '1111';
            print_r($data);
            if ($data !== null)
            {
                $this->fields['error'] = isset($data['Error']['Message']) ? $data['Error']['Message']: NULL;
                if (!is_null($this->fields['error'])){
                    $this->fields['preBookCode'] = $data['PreBookCode'];
                    $this->fields['price'] =  $data['Price'];
                    $this->fields['currency'] =  $data['Price']{'@attributes'}['currency'];
                    $this->fields['from'] =  $data['PriceBreakdown']['from'];
                    $this->fields['to'] =  $data['PriceBreakdown']['to'];
                    $this->fields['total'] =  $data['PriceBreakdown']['total'];
                    $this->fields['priceBreakdowns'] = new PriceBreakdowns($data['PriceBreakdown']);
                    $this->fields['cancellationPolicies'] = new CancellationPolicies($data['CancellationPolicies']);
                } else {

                }
            }
    }
}