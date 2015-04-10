<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 4/3/15
 * Time: 22:42
 */

class SettingController extends BaseController{
    public function getSettingView() {

        $cnts=Rules::getInstance()->getRuleCount();
        return View::make("client.setting",array('cnts'=>$cnts));
    }
    public function getSettingRules($type) {
        $rules=Rules::getInstance()->getObjectsByField(array('data_type'=>$type));
        return View::make("client.ruledata",array('rules'=>$rules));
    }
    public function getEditRuleView($rule_id) {
        $rule=Rules::getInstance()->getOneObjectByField(array('id'=>$rule_id));
        if($rule!=null) {
            return View::make('client.edit_rule',array('rule'=>$rule));
        }
    }
}