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
 * Class TransferTypes
 * @package webbeds\hotel_api_sdk\model
 * @property string userName User Name to use webBeds API
 * @property string password Password to use webBeds API
 */
class TransferType extends ApiModel
{
    /**
     * TransferTypes constructor.
     * @property string userName User Name to use webBeds API
     * @property string password Password to use webBeds API
     */
    public function __construct(string $id=null, string $name=null)
    {
        $this->validFields =
            [   "id" => "string",
                "name" => "string",
            ];
             
        if ($id !== null)
            $this->id = $id;

        if ($name !== null)
            $this->name = $name;
    }
}