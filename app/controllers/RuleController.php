<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 4/8/15
 * Time: 13:50
 */

class RuleController extends BaseController{
    public function getRules($data_type) {
        $rules=Rules::getInstance()->getObjectsByField(array('data_type'=>$data_type));
        return $rules;
    }
    public function delete($rule_id) {
        try {
            Rules::getInstance()->delete(array('id'=>$rule_id));
            return ResponseBuilder::success(array('html'=>'success','error'=>0));
        } catch(Exception $e) {
            return ResponseBuilder::success(array('html'=>'error happened','error'=>1));
        }

    }
    public function edit($rule_id) {
        try {
            $start_odd=InputHelper::getInput('start_odd',true);
            $after_odd=InputHelper::getInput('after_odd',true);
            $rule_color=InputHelper::getInput('rule_color',true);
            $data_type=InputHelper::getInput('data_type',true);
            $type=$data_type;

            if($after_odd==-99) {
                if($data_type==2) {
                    $after_odd=$start_odd;
                    $type=4;
                } else {
                    $after_odd=$start_odd;
                    $type=5;
                }
            }
            Rules::getInstance()->update(
                array(  'start_odd' =>$start_odd,
                    'after_odd' =>$after_odd,
                    'type'      =>$type,
                    'data_type' =>$data_type,
                    'color'     =>$rule_color),
                array('id'=>$rule_id));
            return ResponseBuilder::success(array('html'=>'success','error'=>0));
        }
        catch(Exception $e) {
            return ResponseBuilder::success(array('html'=>'Error happen','error'=>1));
        }
    }
    public function add() {
        try {
            $start_odd=InputHelper::getInput('start_odd',true);
            $after_odd=InputHelper::getInput('after_odd',true);
            $rule_color=InputHelper::getInput('rule_color',true);
            $data_type=InputHelper::getInput('type',true);
            $type=$data_type;

            if($after_odd==-99) {
                if($data_type==2) {
                    $after_odd=$start_odd;
                    $type=4;
                } else {
                    $after_odd=$start_odd;
                    $type=5;
                }
            }
            Rules::getInstance()->insert(
                array(  'start_odd' =>$start_odd,
                    'after_odd' =>$after_odd,
                    'type'      =>$type,
                    'data_type' =>$data_type,
                    'color'     =>$rule_color,
                    'check_on_minute'=>45));
            return ResponseBuilder::success(array('html'=>'success','error'=>0));
        }
        catch(Exception $e) {
            return ResponseBuilder::success(array('html'=>'Error happen','error'=>1));
        }

    }
}