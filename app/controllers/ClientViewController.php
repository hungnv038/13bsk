<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 3/26/15
 * Time: 15:49
 */

class ClientViewController extends BaseController{
    public function getMatchsView() {
        $matchs=Match::getInstance()->getAllMatchsInTime();
        return View::make('client.matchs',array('matchs'=>$matchs));
    }
    public function getSettingView() {
        return View::make('client.settings');
    }

}