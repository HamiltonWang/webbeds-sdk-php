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
 * Class Images
 * @package webbeds\hotel_api_sdk\model
 * @property string userName User Name to use webBeds API
 * @property string password Password to use webBeds API
 */
class Image extends ApiModel
{
    /**
     * Images constructor.
     * @property string userName User Name to use webBeds API
     * @property string password Password to use webBeds API
     */
    public function __construct(array $data=null)
    {
        $this->validFields =
            [   "id" => "string",
                "fullSizeImageUrl" => "string",
                "fullSizeImageHeight" => "string",
                "fullSizeImageWidth" => "string",
                "smallImageUrl" => "string",
                "smallImageHeight" => "string",
                "smallImageWidth" => "string",
            ];
             
            if ($data !== null)
            {
                $this->fields['id'] = $data['@attributes']['id'];
                if (isset($data['fullSizeImage'])){
                    $this->fields['fullSizeImageUrl'] = $data['fullSizeImage']{'@attributes'}['url'];
                    $this->fields['fullSizeImageHeight'] = $data['fullSizeImage']{'@attributes'}['height'];
                    $this->fields['fullSizeImageWidth'] = $data['fullSizeImage']{'@attributes'}['width'];    
                } else {
                    $this->fields['fullSizeImageUrl'] = NULL;
                    $this->fields['fullSizeImageHeight'] = NULL;
                    $this->fields['fullSizeImageWidth'] = NULL;    
 
                }

                if (isset($data['smallImage'])){
                    $this->fields['smallImageUrl'] = $data['smallImage']{'@attributes'}['url'];
                    $this->fields['smallImageHeight'] = $data['smallImage']{'@attributes'}['height'];
                    $this->fields['smallImageWidth'] = $data['smallImage']{'@attributes'}['width'];
                } else {
                    $this->fields['smallImageUrl'] = NULL;
                    $this->fields['smallImageHeight'] = NULL;
                    $this->fields['smallImageWidth'] = NULL;
           
                }

            }
    }
}