<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 3/24/15
 * Time: 09:41
 */

class OddController extends BaseController{
    public function updateOdd() {
        try {
            Log::info("Run background Odd");
            $match_id=InputHelper::getInput('match_id',true);

            $match_object=Match::getInstance()->getOneObjectByField(array('id'=>$match_id));
            if($match_object==null) {
                return;
            }

            if(time()-strtotime($match_object->time_1)>=180*60) {
                return;
            }

            $number_odd_h_rows=$match_object->number_odd_h_rows;
            $number_odd_l_rows=$match_object->number_odd_l_rows;
            $number_odd_d_rows=$match_object->number_odd_d_rows;

            $odd_link=InputHelper::getInput('odd_link',true);

            $html=new Htmldom($odd_link);

            $div_datas=array('#div_h','#div_l','#div_d');

            $type=1;$number_rows=1;

            $odd_data=array();

            $data_number_rows=array();

            foreach($div_datas as $div) {
                $result=$html->find($div);

                switch($div) {
                    case "#div_h":
                        {
                            $type=1;
                            $number_rows=$number_odd_h_rows;
                            break;
                        }
                    case "#div_l":
                        {
                            $type=2;
                            $number_rows=$number_odd_l_rows;
                            break;
                        }
                    case "#div_d":
                        {
                            $type=3;
                            $number_rows=$number_odd_d_rows;
                            break;
                        }
                }
                if(count($result)==0) {
                    return;
                }
                if(count($result[0]->children)==0) {
                    return;
                }

                $tabls=$result[0]->children[0];

                $data_number_rows[$type]=count($tabls->children)-2;

                $new_rows=0;

                if(count($tabls->children)<=$number_rows+2) {
                    continue;
                } else {
                    $new_rows=count($tabls->children)-$number_rows;
                }

                $data_number_rows[$type]=count($tabls->children)-2;

                for($i=2;$i<$new_rows;$i++) {
                    $odd=$tabls->children[$i];

                    $minute_tag=$odd->children[0];

                    if(count($minute_tag->nodes)==0) {
                        $minute=-1;
                    } else {
                        $minute=trim($minute_tag->nodes[0]->text());
                        if(strtoupper($minute)=="HT")
                        {
                            $minute=-2;
                        } elseif(strtoupper($minute)=="FT") {
                            $minute=-3;
                        } else {
                            $minute=intval($minute);
                        }
                    }

                    $score_tag=$odd->children[1];

                    if(count($score_tag->nodes)==0) {
                        $score1=0;$score2=0;
                    } else {
                        $score=$score_tag->nodes[0]->text();
                        if(strlen($score)>=3 && strpos($score,"-")!=false) {
                            $scores=explode("-",$score);
                            $score1=intval(trim($scores[0]));
                            $score2=intval(trim($scores[1]));
                        } else {
                            $score1=0;$score2=0;
                        }
                    }

                    $home_tag=$odd->children[2];

                    if(count($home_tag->nodes)==0) {
                        $home_odd=-999;
                    } else {
                        $home_odd=$home_tag->nodes[0]->text();
                        if(strtoupper($home_odd)=="CLOSED") {
                            $home_odd=-999;
                        } elseif(strpos($home_odd,'/')!=null) {
                            $strs=explode("/",$home_odd);
                            $home_odd=(doubleval($strs[0])+doubleval($strs[1]))/2;
                        } else {
                            $home_odd=doubleval($home_odd);
                        }
                    }
                    $draw_tag=$odd->children[3];

                    if(count($draw_tag->nodes)==0) {
                        $draw_odd=-999;
                    } else {
                        $draw_odd=$draw_tag->nodes[0]->text();
                        if(strtoupper($draw_odd)=="CLOSED") {
                            $draw_odd=-999;
                        }
                        elseif(strpos($draw_odd,'/')!=null) {
                            $strs=explode("/",$draw_odd);
                            $draw_odd=(doubleval($strs[0])+doubleval($strs[1]))/2;
                        } else {
                            $draw_odd=doubleval($draw_odd);
                        }
                    }

                    $alway_tag=$odd->children[4];

                    if(count($alway_tag->nodes)==0) {
                        $alway_odd=-999;
                    } else {
                        $alway_odd=$alway_tag->nodes[0]->text();
                        if(strtoupper($alway_odd)=="CLOSED") {
                            $alway_odd=-999;
                        } elseif(strpos($alway_odd,'/')!=null) {
                            $strs=explode("/",$alway_odd);
                            $alway_odd=(doubleval($strs[0])+doubleval($strs[1]))/2;
                        } else {
                            $alway_odd=doubleval($alway_odd);
                        }
                    }
                    $status_tag=$odd->children[6];

                    if(count($status_tag->nodes)==0) {
                        $status_odd="-";
                    } else {
                        $status_odd=$status_tag->nodes[0]->text();
                    }
                    $odd_data[]=array(
                        'match_id'=>$match_id,
                        'created_at'=>array('now()'),
                        'time'=>$minute,
                        'score1'=>$score1,
                        'score2'=>$score2,
                        'home'=>$home_odd,
                        'draw'=>$draw_odd,
                        'away'=>$alway_odd,
                        'status'=>trim($status_odd),
                        'type'=>$type
                    );
                }
            }
            // insert new data to DB
            if(count($odd_data)>0) {
                Odd::getInstance()->inserts(
                    array(
                        'match_id','created_at','time','score1','score2','home','draw','away','status','type'
                    ),$odd_data);

                Match::getInstance()->update(
                    array('number_odd_h_rows'=>$data_number_rows[1],
                        'number_odd_l_rows'=>$data_number_rows[2],
                        'number_odd_d_rows'=>$data_number_rows[3]),array('id'=>$match_id)
                );
            }
        } catch(Exception $e) {
            ResponseBuilder::error($e);
        }
    }
    public function updateMatchStatus()
    {
        $rules=Rules::getInstance()->getAllObjects();
        $array_rules=array();

        foreach ($rules as $rule) {
            $array_rules[$rule->id]=$rule;
        }

        // get all matchs are ok with start_odd value
        $sql="select odds.*,rules.id as rule_id from odds
                inner join rules on rules.start_odd = odds.draw
                where  time in (-1,0,1) and odds.type=rules.type
                group by match_id,rule_id
                order by time, odds.id desc";
        $result1=DBConnection::read()->select($sql);

        $start_odds_matchs=array();

        foreach($result1 as $item) {
            if(!array_key_exists($item->rule_id,$start_odds_matchs)) {
                $start_odds_matchs[$item->rule_id]=array();
            }
            $start_odds_matchs[$item->rule_id][]=$item->match_id;
        }

        $sql2="select odds.*,rules.id as rule_id,rules.type as rule_type,rules.after_odd
                from odds
                inner join rules on (odds.type<=2 and rules.after_odd = odds.draw) or (odds.type=3 and rules.after_odd +odds.score1+odds.score2= odds.draw)
                where  time in (45,-2) and odds.type=rules.type
                group by match_id, rule_id
                order by time desc";

        $result2=DBConnection::read()->select($sql2);

        $after_odds_matchs=array();

        foreach($result2 as $item) {
            if(!array_key_exists($item->rule_id,$after_odds_matchs)) {
                $after_odds_matchs[$item->rule_id]=array();
            }
            $after_odds_matchs[$item->rule_id][]=$item->match_id;
        }

        $finals=array();


        // start get intersection between start and after odd to get final result
        foreach ($array_rules as $rule) {
            if(array_key_exists($rule->id,$start_odds_matchs) &&
                array_key_exists($rule->id,$after_odds_matchs)) {

                $start_matchs=$start_odds_matchs[$rule->id];
                $after_matchs=$after_odds_matchs[$rule->id];

                $final=array_intersect($start_matchs,$after_matchs);

                if(count($final)>0) {
                    $finals[$rule->id]=$final;
                }

            } else {
                continue;
            }
        }

        if(count($finals)==0) return;
        // save data to server.
        //delete all old data
        DBConnection::write()->delete("delete from match_rule_status");

        $status=array();

        foreach ($finals as $key => $match_id) {
            $rule=$array_rules[$key];
            $status[]=array(
                'match_id'=>$match_id,
                'rule_id'=>$key,
                'created_at'=>array('now()'),
                'status_color'=>$rule->color
            );
        }

        if(count($status)>0) {
            Match_Rule_Status::getInstance()->inserts(
                array('match_id',
                    'rule_id',
                    'created_at',
                    'status_color'),$status);
        }
    }
}