<?php
/**
 * User: Hamilton
 * Date: 12/11/2018
 * Time: 11:15 AM
 */
namespace webbeds\hotel_api_sdk\utility;

class UtilityHelper 
{
    public static function XMLtoArray(\SimpleXMLElement $xml) {
        $result = [];
        foreach($xml as $item){
            $newItem = [];
            
            $child =$item->children();
            //simplexml_tree($child, true);
            foreach ( $child as $key => $value ) {
                $newItem[(string)$key] = empty($value) ? '' : $value;
    
            }
            $result[] = $newItem;
        }
        return $result;
    }

    /**
     * @return array ConvertXMLToArray2 convert XMl Object to Array format
     */
    public function ConvertXMLToArray2($xml_string)
    {
        $json = json_encode( $xml_string );
        $array = json_decode($json, TRUE);
        //echo $xml_string;

        return $array;
    }
}