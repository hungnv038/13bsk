<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 4/3/15
 * Time: 22:42
 */

class SettingController extends BaseController{
    public function getSettingView() {
        return View::make("client.setting");
    }
}