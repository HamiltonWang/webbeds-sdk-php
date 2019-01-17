<?php
/**
 * Created by PhpStorm.
 * User: Tomeu
 * Date: 11/4/2015
 * Time: 8:43 PM
 */
namespace webbeds\hotel_api_sdk\model\search;

use webbeds\hotel_api_sdk\model\ApiModel;

/**
 * Class SearchRoomType
 * @package webbeds\hotel_api_sdk\model
 * @property array data paramters
 */
class SearchRoomType extends ApiModel
{
    /**
     * SearchRoomTypes constructor.
     * @property array data paramters
     */
    public function __construct(array $data=null)
    {
        $this->validFields =
            [
                "roomTypeId" => "string",
                "rooms" => "array"
            ];

            if ($data !== null)
            {
                $this->fields['roomTypeId'] = $data{'roomtype.ID'};
                $this->fields['rooms'] = empty($data['rooms']) ? new SearchRooms([]): new SearchRooms($data['rooms']);
            }
    }
}