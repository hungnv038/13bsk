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
        $rule_type=InputHelper::getInput('rule_type',true);
        $rule=Rules::getInstance()->getOneObjectByField(array('id'=>$rule_id));
        if($rule!=null) {
            return View::make('client.edit_rule',array('rule'=>$rule,'rule_type'=>$rule_type));
        }
    }
    public function getAddRuleView() {
        $rule_type=InputHelper::getInput('rule_type',true);
        return  View::make('client.add_rule',array('rule_type'=>$rule_type));
    }
}