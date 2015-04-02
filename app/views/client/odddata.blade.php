<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">Crown 1X2 Odds</div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr class="active" style="background-color: #2a6496;">
                        <td style="text-align: center;">Time</td>
                        <td style="text-align: center;">Score</td>
                        <td style="text-align: center;">Home </td>
                        <td style="text-align: center;">Draw</td>
                        <td style="text-align: center;">Away</td>
                        <td style="text-align: center;">Status</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($table1 as $item)
                        <?php
                        $time="-";
                        $score="-";
                        $home="<font color=green>Closed</font>";
                        $draw="<font color=green>Closed</font>";
                        $alway="<font color=green>Closed</font>";
                        if($item->time>=0) {
                            $time=$item->time;
                            $score=$item->score1." - ".$item->score2;
                        } elseif($item->time==-2) {
                            $time="<font color=blue>HT</font>";
                            $score=$item->score1." - ".$item->score2;
                        } elseif ($item->time==-3) {
                            $time="<font color=blue>FT</font>";
                            $score=$item->score1." - ".$item->score2;
                        }

                        if($item->home!=-999) {
                            $home=$item->home;
                        }
                        if($item->draw!=-999) {
                            $draw=$item->draw;
                        }
                        if($item->away!=-999) {
                            $alway=$item->away;
                        }
                        $color="";

                        if(strtoupper($item->status)=="LIVE") {
                            $color="background-color: red;";
                        } elseif(strtoupper($item->status)=="EAR") {
                            $color="background-color: green;";
                        } elseif(strtoupper($item->status)=="RUN") {
                            $color="background-color: blue;";
                        }
                        ?>
                        <td style="text-align: center; color: blue">{{$time}}</td>
                        <td style="text-align: center; color: green" >{{$score}}</td>
                        <td style="text-align: center;">{{$home}}</td>
                        <td style="text-align: center; color: red">{{$draw}}</td>
                        <td style="text-align: center;">{{$alway}}</td>
                        <td style="text-align: center; color: #ffffff; {{$color}}">{{$item->status}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">Crown Handicap Odds</div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr class="active" style="background-color: #2a6496;">
                        <td style="text-align: center;">Time</td>
                        <td style="text-align: center;">Score </td>
                        <td style="text-align: center;">Home</td>
                        <td style="text-align: center;">Handicap</td>
                        <td style="text-align: center;">Away</td>
                        <td style="text-align: center;">Status</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($table2 as $item)
                        <?php
                        $time="-";
                        $score="-";
                        $home="<font color=green>Closed</font>";
                        $draw="<font color=green>Closed</font>";
                        $alway="<font color=green>Closed</font>";

                        if($item->time>=0) {
                            $time=$item->time;
                            $score=$item->score1." - ".$item->score2;
                        } elseif($item->time==-2) {
                            $time="<font color=blue>HT</font>";
                            $score=$item->score1." - ".$item->score2;
                        } elseif ($item->time==-3) {
                            $time="<font color=blue>FT</font>";
                            $score=$item->score1." - ".$item->score2;
                        }

                        if($item->home!=-999) {
                            $home=$item->home;
                        }
                        if($item->draw!=-999) {
                            $draw=$item->draw;
                        }
                        if($item->away!=-999) {
                            $alway=$item->away;
                        }
                        $color="";

                        if(strtoupper($item->status)=="LIVE") {
                            $color="background-color: red;";
                        } elseif(strtoupper($item->status)=="EAR") {
                            $color="background-color: green;";
                        } elseif(strtoupper($item->status)=="RUN") {
                            $color="background-color: blue;";
                        }
                        ?>
                        <td style="text-align: center; color: blue">{{$time}}</td>
                        <td style="text-align: center; color: green" >{{$score}}</td>
                        <td style="text-align: center;">{{$home}}</td>
                        <td style="text-align: center; color: red">{{$draw}}</td>
                        <td style="text-align: center;">{{$alway}}</td>
                        <td style="text-align: center; color: #ffffff; {{$color}}">{{$item->status}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">Crown Over/Under Odds</div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr class="active" style="background-color: #2a6496;">
                        <td style="text-align: center;">Time</td>
                        <td style="text-align: center;">Score </td>
                        <td style="text-align: center;">Over </td>
                        <td style="text-align: center;">O/U</td>
                        <td style="text-align: center;">Under </td>
                        <td style="text-align: center;">Status</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($table3 as $item)
                        <?php
                        $time="-";
                        $score="-";
                        $home="<font color=green>Closed</font>";
                        $draw="<font color=green>Closed</font>";
                        $alway="<font color=green>Closed</font>";
                        if($item->time>=0) {
                            $time=$item->time;
                            $score=$item->score1." - ".$item->score2;
                        } elseif($item->time==-2) {
                            $time="<font color=blue>HT</font>";
                            $score=$item->score1." - ".$item->score2;
                        } elseif ($item->time==-3) {
                            $time="<font color=blue>FT</font>";
                            $score=$item->score1." - ".$item->score2;
                        }

                        if($item->home!=-999) {
                            $home=$item->home;
                        }
                        if($item->draw!=-999) {
                            $draw=$item->draw;
                        }
                        if($item->away!=-999) {
                            $alway=$item->away;
                        }
                        $color="";

                        if(strtoupper($item->status)=="LIVE") {
                            $color="background-color: red;";
                        } elseif(strtoupper($item->status)=="EAR") {
                            $color="background-color: green;";
                        } elseif(strtoupper($item->status)=="RUN") {
                            $color="background-color: blue;";
                        }
                        ?>
                        <tr>
                            <td style="text-align: center; color: blue">{{$time}}</td>
                            <td style="text-align: center; color: green" >{{$score}}</td>
                            <td style="text-align: center;">{{$home}}</td>
                            <td style="text-align: center; color: red">{{$draw}}</td>
                            <td style="text-align: center;">{{$alway}}</td>
                            <td style="text-align: center; color: #ffffff; {{$color}}">{{$item->status}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>