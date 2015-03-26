<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 3/26/15
 * Time: 12:01
 */

class StringHelper {
    public static function getStringdata( $string, $firstCharactor, $secondCharactor) {
        $firt_post=strpos($string,$firstCharactor);
        $second_post=strpos($string,$secondCharactor);
        $result=substr($string,$firt_post+1,$second_post-$firt_post-1);

        return $result;
    }
    public static function getData( $string, $firstCharactor, $secondCharactor) {
        $main_data=self::getStringdata($string,$firstCharactor,$secondCharactor);
        $main_data=str_replace("'","",$main_data);
        $main_data=str_replace("[","",$main_data);
        $main_data=str_replace("]","",$main_data);
        $data_array=explode(",",$main_data);
        return $data_array;
    }
}