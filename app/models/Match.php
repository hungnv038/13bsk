<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 3/21/15
 * Time: 11:47
 */

class Match extends DBAccess {

    private static $instance;

    public static function getInstance()
    {
        if(self::$instance==null) {
            self::$instance=new Match();
        }
        return self::$instance;
    }

    public function __construct()
    {
        parent::__construct('matchs'); // TODO: Change the autogenerated stub
    }

    public function updates($field_values)
    {
        $match_ids=$field_values['id'];
        $match_objs=$field_values['objs'];

        $keys=array('h_goal','g_goal','h_read_card','g_read_card','h_yellow_card','g_yellow_card',
            'status','ht_h_goal','ht_g_goal','have_odd','time_2');

        //$keys=array('h_goal','g_goal');

        $sql="UPDATE {$this->table_name} SET ";

        $first=true;

        foreach ($keys as $key) {
            if(!$first) {
                $sql.=" , ";
            }
            $sql.=" ".$key.' = CASE ';

            foreach($match_objs as $obj) {
                $sql.=" WHEN id={$obj['id']} THEN '".$obj[$key]."'";
            }
            $sql.=" END ";

            $first=false;
        }

        $sql.=" WHERE (id in ('".implode("','",$match_ids)."'))";
        DBConnection::write()->update($sql);
    }
    public function getAllMatchsInTime() {
        $sql="  select matchs.*,code,color,name from matchs
                inner join leagues on leagues.id=league_id
                where to_days(now())-to_days(time_1)<2 and to_days(now())-to_days(time_1)>-2
                order by status desc, time_2 asc ";
        $results=DBConnection::read()->select($sql);

        return $results;
    }


}