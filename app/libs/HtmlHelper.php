<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 4/10/15
 * Time: 17:46
 */

class HtmlHelper {
    public static function makeSelection($max = 5, $extra = false, $selected = 100)
    {

        if ($extra) {
            echo "<option value='-99'>Tăng chấp</option>";
        }
        for ($index = -$max; $index <= $max; $index += 0.25) {
            if ($index == $selected) {
                echo "<option value='" . $index . "' selected >" . $index . "</option>";
            } else {
                echo "<option value='" . $index . "'>" . $index . "</option>";
            }

        }
    }

}