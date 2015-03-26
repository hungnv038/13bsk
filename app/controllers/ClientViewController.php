<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 3/26/15
 * Time: 15:49
 */

class ClientViewController extends BaseController{
    public function getMatchsView() {
        return View::make('client.matchs');
    }
    public function getMatchsData() {
        $matchs=Match::getInstance()->getAllMatchsInTime();
        echo  View::make('client.matchlist',array('matchs'=>$matchs));
    }
    public function getSettingView() {
        return View::make('client.settings');
    }

}