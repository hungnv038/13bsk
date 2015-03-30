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
        $match_status=Match::getInstance()->getMatchStatus();
        echo  View::make('client.matchlist',array('matchs'=>$matchs,'status'=>$match_status));
    }
    public function getSettingView() {
        return View::make('client.settings');
    }

}