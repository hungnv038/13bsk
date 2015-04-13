<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 4/10/15
 * Time: 17:46
 */

class HtmlHelper {
    const TYPE_TWO_START=1;
    const TYPE_TWO_AFTER=2;
    const TYPE_THREE_START=3;
    const TYPE_THREE_AFTER=4;
    public static function makeSelection($max = 5, $type=HtmlHelper::TYPE_TWO_START, $selected = 100)
    {
        if($type==HtmlHelper::TYPE_TWO_START || $type==HtmlHelper::TYPE_TWO_AFTER) {
            $min=-$max;
        } else {
            $min=0;
        }

        if ($type==HtmlHelper::TYPE_TWO_AFTER) {
            echo "<option value='-99'>Tăng chấp</option>";
        }
        for ($index = $min; $index <= $max; $index += 0.25) {
            if ($index == $selected) {
                echo "<option value='" . $index . "' selected >" . $index . "</option>";
            } else {
                echo "<option value='" . $index . "'>" . $index . "</option>";
            }
            if($type==HtmlHelper::TYPE_THREE_AFTER) {
                $val=-$index;
                if ($val == $selected) {
                    echo "<option value='" . $val . "' selected >" . abs($val)  ." Trở lên </option>";
                } else {
                    echo "<option value='" . $val . "'>" . abs($val)  . " Trở lên </option>";
                }
            }

        }
    }

}