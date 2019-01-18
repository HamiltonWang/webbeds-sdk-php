<?php
/**
 * Created by PhpStorm.
 * User: Tomeu
 * Date: 11/12/2015
 * Time: 1:33 AM
 */
namespace webbeds\hotel_api_sdk\model\book;

use webbeds\hotel_api_sdk\model\ApiModel;

/**
 * Class Notes
 * @package webbeds\hotel_api_sdk\model\book
 * @property string node name
 * @property array field value
 */
class Notes extends ApiModel
{
    /**
     * @var string nodeName REQUIRE, node to capture
     */
    private $nodeName;

    public function __construct(string $nodeName, array $data = null)
    {
        $this->nodeName = $nodeName;

        $this->validFields = [
            $nodeName => "array",
        ];

        if ($data !== null) {
            $this->fields = $data;
        }
    }
    /**
     * @return NoteIterator For iterate Notes list
     */
    public function iterator()
    {
        if (isset($this->fields[$this->nodeName]) )
        {
            $key = 1;
            // make sure there is more than one item
            //if (gettype($this->fields[$this->nodeName])=='array' ) { 
            if (array_key_exists("0", $this->fields[$this->nodeName])) {
                foreach($this->fields[$this->nodeName] as &$item){
                    $item['id'] = $key;
                    $key++;
                }
                return new NoteIterator($this->fields[$this->nodeName]);
            } else {
                $item = $this->fields[$this->nodeName];
                $item['id'] = $key;
                $array = [];
                array_push($array, $item);
                return new NoteIterator($array);
            }
            
        }
            
        return new NoteIterator([]);
    }
}