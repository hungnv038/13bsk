<?php
$state_ch=array(
        0=>"<font color=red>Postp.</font>",
        1=>"<font color=red>Pause</font>",
        2=>"<font color=red>Abd</font>",
        3=>"<font color=red>Pend.</font>",
        4=>"<font color=red>Cancel</font>",
        13=>"<b>FT</b>",
        14=>"&nbsp",15=>"Part1",
        16=>"<font color=blue>HT</font>",
        17=>"Part2",18=>"Ot");
?>
<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th style="width:10%;">Giải đấu </th>
        <th style="width:10%;">Thời gian </th>
        <th style="width:10%;">Tình trạng </th>
        <th style="width:25%;">Đội nhà </th>
        <th style="width:5%;">Tỉ số</th>
        <th style="width:25%;">Đội khách </th>
        <th style="width:10%;">H-T </th>
        <th style="width:5%;">Dữ liệu </th>
    </tr>
    </thead>
    <tbody>
    @foreach($matchs as $match)
        <?php

        if(intval($match->h_read_card)!=0) $h_redcard = "<img src='http://www.nowgoal.com/images/redcard".$match->h_read_card.".gif'>"; else $h_redcard = "";
        if(intval($match->g_read_card)!=0) $g_redcard = "<img src='http://www.nowgoal.com/images/redcard".$match->g_read_card.".gif'>"; else  $g_redcard = "";
        if(intval($match->h_yellow_card)!=0) $h_yellowcard = "<img src='http://www.nowgoal.com/images/yellow".$match->h_yellow_card.".gif'>"; else $h_yellowcard = "";
        if(intval($match->g_yellow_card)!=0) $g_yellowcard = "<img src='http://www.nowgoal.com/images/yellow".$match->g_yellow_card.".gif'>"; else  $g_yellowcard = "";


        $start_time=DateTime::createFromFormat('Y-m-j H:i:s',$match->time_1);
        $start_time->setTimezone(new DateTimeZone("Asia/Ho_Chi_Minh"));
        $start_time=$start_time->format("M-j H:i");
        $minute="";
        $time_color="";
        $ht_score='';
        $score='<font color="blue"> - </font>';
        if(intval($match->status)==-1) {
            $time_color='<font color="0x0066ff">FT</font>';

            $ht_score='<font color="red">'.$match->ht_h_goal.' - '.$match->ht_g_goal.'</font>';

            $score='<font color="red">'.$match->h_goal.' - '.$match->g_goal.'</font>';

        }elseif(intval($match->status)==2) {
            $time_color='<font color="blue">HT</font>';

            $score='<font color="blue">'.$match->h_goal.' - '.$match->g_goal.'</font>';
        }elseif(intval($match->status)==1) {
            $minute=floor((time()-strtotime($match->time_2))/60);
            if($minute<1) $minute=1;
            if($minute>45) $minute="45+";
            $time_color='<font color="0x0066ff">'.$minute.'</font><image src="http://www.nowgoal.com/images/in.gif" border="0"/>';

            $score='<font color="blue">'.$match->h_goal.' - '.$match->g_goal.'</font>';
        }elseif(intval($match->status)==3) {
            $minute=floor(46+(time()-strtotime($match->time_2))/60);
            if($minute<46) $minute=46;
            if($minute>90) $minute="90+";
            $time_color='<font color="0x0066ff">'.$minute.'</font><image src="http://www.nowgoal.com/images/in.gif" border="0"/>';

            $ht_score='<font color="red">'.$match->ht_h_goal.' - '.$match->ht_g_goal.'</font>';

            $score='<font color="blue">'.$match->h_goal.' - '.$match->g_goal.'</font>';
        } else {
            $time_color=$state_ch[$match->status+14];
        }
        ?>
        <tr>
            <td style="background-color: {{$match->color}}}; color: #ffffff; text-align: center">
                {{$match->code}}
            </td>
            <td style="text-align: center">{{$start_time}}</td>
            <td style="text-align: center">
                {{$time_color}}
            </td>
            <td style="text-align: right"><?php echo $h_yellowcard; echo $h_redcard; echo $match->h_team; ?></td>
            <td style="text-align: center">{{$score}}</td>
            <td style="text-align: left"><?php echo $match->g_team; echo $g_yellowcard; echo $g_redcard;?></td>
            <td style="text-align: center">{{$ht_score}}</td>
            <td style="text-align: center">
                @if($match->have_odd)
                    <a href="{{$match->odd_link}}"><image src="http://www.nowgoal.com/images/t3.gif"/></a>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>