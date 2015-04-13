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
        $existing_data=Odd::getInstance()->getMatchExistingOdd();

        return  View::make('client.matchlist',array('matchs'=>$matchs,'status'=>$match_status,'exist_odds'=>$existing_data));
    }
    public function getSettingView() {
        return View::make('client.settings');
    }
    public function getMatchOddView($match_id) {
        try {
            $match=Match::getInstance()->getOneObjectByField(array('id'=>$match_id));
            if($match==null) {
                throw new Exception("Match not found");
            }
            return View::make('client.oddinfo',array('match_id'=>$match_id,'title'=>$match->h_team." - ".$match->g_team));
        } catch(Exception $e) {
            return View::make("client.errorpage",array('error_text'=>$e->getMessage()));
        }

    }
    public function getMatchOdddata($match_id) {
        try {
            $table1=Odd::getInstance()->getObjectsByField(array('type'=>1,'match_id'=>$match_id),array('id desc'));
            $table2=Odd::getInstance()->getObjectsByField(array('type'=>2,'match_id'=>$match_id),array('id desc'));
            $table3=Odd::getInstance()->getObjectsByField(array('type'=>3,'match_id'=>$match_id),array('id desc'));
            echo  View::make('client.odddata',array('table1'=>$table1,'table2'=>$table2,'table3'=>$table3));
        } catch(Exception $e) {
            echo  View::make("client.error_content",array('error_text'=>$e->getMessage()));
        }
    }

}