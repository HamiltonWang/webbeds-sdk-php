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
 * Class SearchRooms
 * @package webbeds\hotel_api_sdk\model
 * @property string userName User Name to use webBeds API
 * @property string password Password to use webBeds API
 */
class SearchRoom extends ApiModel
{
    /**
     * SearchRooms constructor.
     * @property string userName User Name to use webBeds API
     * @property string password Password to use webBeds API
     */
    public function __construct(array $data=null)
    {
        $this->validFields =
            [   "id" => "string",
                "beds" => "string",
                "extrabeds" => "integer",
                "meals" => "string",
                "cancellationPolicies" => "array",
                "notes" => "string",
                "isSuperDeal" => "boolean",
                "isBestBuy" => "boolean",
                "paymentMethods" => "array"
            ];
             
            if ($data !== null)
            {
                $this->fields['id'] = $data['id'];
                $this->fields['beds'] = empty($data['beds']) ? '': $data['beds'];
                $this->fields['extrabeds'] = empty($data['extrabeds']) ? '': $data['extrabeds'];
                // TODO: meals array: no sample data, seems not in use
                $this->fields['meals'] = empty($data['meals']) ? new SearchMeals([]): new SearchMeals($data['meals']);
                // TODO: cancellation_policies array: no sample data
                $this->fields['cancellationPolicies'] = empty($data['cancellation_policies']) ? new CancellationPolicies([]): new CancellationPolicies($data['cancellation_policies']);
                // TODO: note array: no sample data, seems not in use
                $this->fields['notes'] = empty($data['notes']) ? []: $data['notes'];
                // TODO: paymentMethods array: need more sample for multiple payment metods
                $this->fields['paymentMethods'] = empty($data['paymentMethods']) ? new PaymentMethods([]): new PaymentMethods($data['paymentMethods']);
                $this->fields['isSuperDeal'] = empty($data['isSuperDeal']) ? '': $data['isSuperDeal'];
                $this->fields['isBestBuy'] = empty($data['isBestBuy']) ? '': $data['isBestBuy'];
            }
    }
}