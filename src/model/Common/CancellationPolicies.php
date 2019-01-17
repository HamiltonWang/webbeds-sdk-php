<?php
/**
 * Created by PhpStorm.
 * User: Tomeu
 * Date: 11/12/2015
 * Time: 1:33 AM
 */
namespace webbeds\hotel_api_sdk\model;
/**
 * Class CancellationPolicies
 * @package webbeds\hotel_api_sdk\model
 * @property integer total Total number of CancellationPolicies
 */
class CancellationPolicies extends ApiModel
{
    public function __construct(array $data = null)
    {
        $this->validFields = [
            "cancellationPolicy" => "array",
        ];

        if ($data !== null) {
            $this->fields = $data;
        }
    }
    /**
     * @return CancellationPolicyIterator For iterate CancellationPolicies list
     */
    public function iterator()
    {
        if (isset($this->fields['cancellation_policy']) )
        {
            // make sure there is more than one item
            if (array_key_exists("0", $this->fields['cancellation_policy'])) {
                return new CancellationPolicyIterator($this->fields['cancellation_policy']);
            } else {
                $item = $this->fields['cancellation_policy'];
                $this->fields['cancellation_policy'] = [];
                array_push($this->fields['cancellation_policy'], $item);
                return new CancellationPolicyIterator($this->fields['cancellation_policy']);
            }
            
        }
            
        return new CancellationPolicyIterator([]);
    }
}