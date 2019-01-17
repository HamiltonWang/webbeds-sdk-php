<?php
/**
 * Created by PhpStorm.
 * User: Tomeu
 * Date: 11/4/2015
 * Time: 8:43 PM
 */
namespace webbeds\hotel_api_sdk\model\common;

use webbeds\hotel_api_sdk\model\ApiModel;

/**
 * Class CancellationPolicy
 * @package webbeds\hotel_api_sdk\model
 * @property string userName User Name to use webBeds API
 * @property string password Password to use webBeds API
 */
class CancellationPolicy extends ApiModel
{
    /**
     * CancellationPolicy constructor.
     * @property string userName User Name to use webBeds API
     * @property string password Password to use webBeds API
     */
    public function __construct(array $data=null)
    {
        $this->validFields =
            [   "deadline" => "integer",
                "percentage" => "integer",
                "text" => "string"
            ];
             
            if ($data !== null)
            {
                $this->fields['deadline'] = empty($data['deadline']) ? 0: $data['deadline'];
                $this->fields['percentage'] = empty($data['percentage']) ? 100: $data['percentage'];
                $this->fields['text'] = isset($data['text']) ? '': empty($data['text'])? '': $data['text'];

            }
    }
}