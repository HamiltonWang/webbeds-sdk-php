<?php
/**
 * Created by PhpStorm.
 * User: Tomeu
 * Date: 11/4/2015
 * Time: 8:43 PM
 */
namespace webbeds\hotel_api_sdk\model\book;

use webbeds\hotel_api_sdk\model\ApiModel;

/**
 * Class Note
 * @package webbeds\hotel_api_sdk\model
 * @property string userName User Name to use webBeds API
 * @property string password Password to use webBeds API
 */
class Note extends ApiModel
{
    /**
     * Notes constructor.
     * @property string userName User Name to use webBeds API
     * @property string password Password to use webBeds API
     */
    public function __construct(array $data=null)
    {
        $this->validFields =
            [
                "id" => "integer",
                "startDate" => "string",
                "endDate" => "string",
                "text" => "string"
            ];

            if ($data !== null)
            {
                $this->fields['id'] = $data['id'];
                $this->fields['startDate'] = !isset($data{'@attributes'}['start_date'])? '': empty($data{'@attributes'}['start_date'])? '': $data{'@attributes'}['start_date'];
                $this->fields['endDate'] = !isset($data{'@attributes'}['end_date'])? '': empty($data{'@attributes'}['end_date'])? '': $data{'@attributes'}['end_date'];
                $this->fields['text'] = !isset($data['text'])? '': empty($data['text'])? '': $data['text'];
            }
    }
}