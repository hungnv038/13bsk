<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 3/20/15
 * Time: 14:12
 */

class MatchController extends BaseController {

    public function postMatchs()
    {
        try {
            $input=Input::all();
            $data=$input['data'];
            $json=json_decode($data);

            $matchs=$json->a_array;
            $leags=$json->b_array;

            $this->updateMatchs($matchs,$leags);

            $this->updateLeagues($leags);

        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }
    private function updateMatchs($matchs,$leagues) {
        $match_objs=array();



        $match_ids=array();

        $match_odds=array();

        foreach ($matchs as $match) {
            if($match==null) continue;
            $id=$match[0];

            $match_ids[]=$id;

            $link="http://data.nowgoal.com/3in1odds/{$id}.html";
            $h_team=$match[4];

            $pos=strpos($h_team,'<');
            if($pos>0) {
                $h_team=substr($h_team,0,$pos);
            }
            $g_team=$match[5];

            $pos=strpos($g_team,'<');
            if($pos>0) {
                $g_team=substr($g_team,0,$pos);
            }

            $times1=explode(",",$match[6]);

            $time_1=new DateTime();
            $time_1->setDate($times1[0],$times1[1]+1,$times1[2]);
            $time_1->setTime($times1[3],$times1[4],$times1[5]);

            $times2=explode(",",$match[7]);

            $time_2=new DateTime();
            $time_2->setDate($times2[0],$times2[1]+1,$times2[2]);
            $time_2->setTime($times2[3],$times2[4],$times2[5]);

            $match_objs[$id]=array(
                'id'=>$id,
                'league_id'=>$leagues[$match[1]][0],
                'time_1'=>$time_1,
                'time_2'=>$time_2,
                'h_goal'=>$match[9],
                'g_goal'=>$match[10],
                'h_read_card'=>$match[13],
                'g_read_card'=>$match[14],
                'h_yellow_card'=>$match[15],
                'g_yellow_card'=>$match[16],
                'status'=>$match[8],
                'ht_h_goal'=>$match[11]==null?0:$match[11],
                'ht_g_goal'=>$match[12]==null?0:$match[12],
                'created_at'=>array('now()'),
                'h_team'=>$h_team,
                'g_team'=>$g_team,
                'have_odd'=>$match[20]=='True'?1:0,
                'odd_link'=>$match[20]=='True'?$link:""

            );
            if($match[20]=='True') {
                $match_odds[$id]=$link;
            }
        }

        Match::getInstance()->updates(array('id'=>$match_ids,'objs'=>$match_objs));

        $exist=Match::getInstance()->getObjectsByFields(array('id'=>$match_ids));

        $existing_ids=array();

        foreach ($exist as $item) {
            $existing_ids[]=$item->id;
        }

        $new_ids=array_diff($match_ids,$existing_ids);

        $new_objs=array();

        foreach ($new_ids as $item_id) {
            $new_objs[]=$match_objs[$item_id];
        }


        Match::getInstance()->inserts(
            array('id','league_id','time_1','time_2','h_goal','g_goal','h_read_card',
                'g_read_card','h_yellow_card','g_yellow_card','status','ht_h_goal',
                'ht_g_goal','created_at','h_team','g_team','have_odd','odd_link'),
            $new_objs);

        // create BG process to update data every minute
        $commands=array();
        $parameters=array();
        foreach ($match_odds as $match_id=>$odd_link) {
            $commands[]="/background/updateodd";
            $parameters[]=array('match_id'=>$match_id,'odd_link'=>$odd_link);
        }

        BackgroundProcess::getInstance()->throwMultipleProcesses(array('command'=>$commands,'parameter'=>$parameters));
    }
    private function updateLeagues($leagues) {
        $league_objs=array();
        $league_ids=array();
        foreach ($leagues as $leag) {

            if($leag==null) continue;

            $league_ids[]=$leag[0];

            $league_objs[$leag[0]]=array(
                'id'=>$leag[0],
                'created_at'=>array('now()'),
                'code'=>$leag[1],
                'name'=>$leag[2],
                'color'=>$leag[3],
                'link'=>$leag[5]
            );
        }
        //League::getInstance()->updates($league_ids);

        $exist=League::getInstance()->getObjectsByFields(array('id'=>$league_ids));

        $existing_ids=array();

        foreach ($exist as $item) {
            $existing_ids[]=$item->id;
        }

        $new_ids=array_diff($league_ids,$existing_ids);

        $new_ids=array_unique($new_ids);

        $new_objs=array();

        foreach ($new_ids as $item_id) {
            $new_objs[]=$league_objs[$item_id];
        }
        League::getInstance()->inserts(array('id','created_at','code','name','color','link'),$new_objs);

    }
}