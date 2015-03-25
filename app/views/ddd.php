<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="en">
    <title>Phan tich, tong hop, ti le cuoc tra dau</title>
    <mata http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="content-language" content="vi-VN" />
    <link href='http://www.nowgoal.com/style/blue.css' type='text/css' rel='stylesheet' id='cssLink' />
</head>
<body>
<script language="Javascript" type="text/javascript" src="http://www.nowgoal.com/data/public.js"></script>


<div id="main">
    <!--min start -->
    <div id="min">
        <div id="mintable">
            <span id="notify"></span>
            <span id="live"></span>
            <span id="sound"></span>
            <span id="sound2"></span>
        </div>
    </div>
    <!--min end -->
    <span class="clear"></span>
</div>

<span id="allDate"><script language="javascript" type="text/javascript" defer="defer"></script></span>
<span id="span_detail"><script language="javascript" type="text/javascript" defer="defer"></script></span>


<script language="javascript" type="text/javascript">
    var loaded=0,nofityTimer,runtimeTimer,oldXML="";
    var difftime=new Date()-new Date(2015,2,18,14,23,42)
    var loadDetailFileTime=new Date();
    var flash_sound=Array(5);
    flash_sound[0] = "http://www.nowgoal.com/images/sound.swf";
    flash_sound[1] = "http://www.nowgoal.com/images/notice.swf";
    flash_sound[2] = "http://www.nowgoal.com/images/base.swf";
    flash_sound[3] = "http://www.nowgoal.com/images/deep.swf";

    var lastUpdateTime, oldUpdateTime="";
    var lastUpdateFileTime=0;
    var soundid=0,soundid2=0;
    var hiddenID="_",myGamesID="_";
    if(getCookie("TeamOrderCheck")!=null&&parseInt(getCookie("TeamOrderCheck"))==1)
        document.getElementById("TeamOrderCheck").checked=true;

    if(getCookie("RedCheck")!=null&&parseInt(getCookie("RedCheck"))==0)
        document.getElementById("RedCheck").checked=false;

    if(getCookie("YellowCheck")!=null&&parseInt(getCookie("YellowCheck"))==1)
        document.getElementById("YellowCheck").checked=true;

    var windowCheck=true;

    if(getCookie("windowCheck")!=null&&parseInt(getCookie("windowCheck"))==0)
    {
        document.getElementById("windowCheck").checked=false;
        windowCheck=false;
    }

    var soundCheck=true, soundCheck2=true;
    if(getCookie("soundCheck")!=null)
    {
        if(getCookie("soundCheck")==4)
            soundCheck=false;

        document.getElementById("selectsound").value=getCookie("soundCheck");
    }

    if(getCookie("soundCheck2")!=null)
    {
        if(getCookie("soundCheck2")==4)
            soundCheck2=false;

        document.getElementById("selectsound2").value=getCookie("soundCheck2");
    }
    var orderby="league";
    var Bf_simply_disp=false;

    var infoid="";

    var state_ch=Array(18);
    state_ch[0]="Postp.";
    state_ch[1]="Pause";
    state_ch[2]="Abd";
    state_ch[3]="<font color=green>Pend.</font>";
    state_ch[4]="Cancel";
    state_ch[13]="<b>FT</b>";
    state_ch[14]="&nbsp;";
    state_ch[15]="Part1";
    state_ch[16]="<font color=blue>HT</font>";
    state_ch[17]="Part2";
    state_ch[18]="Ot";

    var GoalCn = ["0", "0/0.5", "0.5", "0.5/1", "1", "1/1.5", "1.5", "1.5/2", "2", "2/2.5", "2.5", "2.5/3", "3", "3/3.5", "3.5", "3.5/4", "4", "4/4.5", "4.5", "4.5/5", "5", "5/5.5", "5.5", "5.5/6", "6", "6/6.5", "6.5", "6.5/7", "7", "7/7.5", "7.5", "7.5/8", "8", "8/8.5", "8.5", "8.5/9", "9", "9/9.5", "9.5", "9.5/10", "10", "10/10.5", "10.5", "10.5/11", "11", "11/11.5", "11.5", "11.5/12", "12", "12/12.5", "12.5", "12.5/13", "13", "13/13.5", "13.5", "13.5/14", "14" ];
    var GoalCn2 = ["0", "0/-0.5", "-0.5", "-0.5/-1", "-1", "-1/-1.5", "-1.5", "-1.5/-2", "-2", "-2/-2.5", "-2.5", "-2.5/-3", "-3", "-3/-3.5", "-3.5", "-3.5/-4", "-4", "-4/-4.5", "-4.5", "-4.5/-5", "-5", "-5/-5.5", "-5.5", "-5.5/-6", "-6", "-6/-6.5", "-6.5", "-6.5/-7", "-7", "-7/-7.5", "-7.5", "-7.5/-8", "-8", "-8/-8.5", "-8.5", "-8.5/-9", "-9", "-9/-9.5", "-9.5", "-9.5/-10", "-10" ];
    var week= new Array("Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy");

    function Goal2GoalCn(goal){ //handicap conversion
        if (goal==null || isNaN(goal))
            return "";
        else{
            if(goal>=0)  return GoalCn[parseInt(goal*4)];
            else return GoalCn2[Math.abs(parseInt(goal*4))];
        }
    }

    function ShowBf()
    {
        hiddenID=getCookie("Hidden_MatchID");
        if(hiddenID==null) hiddenID="_";
//	if(orderby=="league"){
//		MakeTable();
//		document.getElementById("li_league").style.display="none";
//		document.getElementById("li_time").style.display="";
//	}
//	else{
        MakeTableByTime();
//		document.getElementById("li_league").style.display="";
//		document.getElementById("li_time").style.display="none";
//	}
        MakeSclass();
        hideSelMatch();

        window.clearTimeout(runtimeTimer);
        runtimeTimer=window.setTimeout("setMatchTime()",1000);

        //if(document.getElementById("TeamOrderCheck").checked) ShowTeamOrder();
        //document.getElementById("loading").style.display="none";

        showMyGameCookie();
    }

    function showMyGameCookie()
    {
        if(getCookie("MyGames_MatchID")!=null)
        {
            try{
                myGamesID=getCookie("MyGames_MatchID");
                for(var i=1;i<=matchcount;i++)
                {
                    if(myGamesID.indexOf(A[i][0])!=-1)
                        document.getElementById("myGamesCount").innerHTML=parseInt(document.getElementById("myGamesCount").innerHTML)+1;
                }

                if(document.getElementById("myGamesCount").innerHTML=="0")
                {
                    myGamesID="_";
                    ShowAllMatch();
                }
            }catch(e){}
        }
    }
    function showYellowCheck()
    {
        if(document.getElementById("YellowCheck").checked)
        {
            writeCookie("YellowCheck", 1);
            for(var i=1;i<=matchcount;i++)
            {
                if(document.getElementById("yellow1_"+A[i][0]))
                    document.getElementById("yellow1_"+A[i][0]).style .display="";

                if(document.getElementById("yellow2_"+A[i][0]))
                    document.getElementById("yellow2_"+A[i][0]).style .display="";
            }
        }
        else
        {
            writeCookie("YellowCheck", 0);
            for(var i=1;i<=matchcount;i++)
            {
                if(document.getElementById("yellow1_"+A[i][0]))
                    document.getElementById("yellow1_"+A[i][0]).style .display="none";

                if(document.getElementById("yellow2_"+A[i][0]))
                    document.getElementById("yellow2_"+A[i][0]).style .display="none";
            }
        }
    }
    function formatTime(t)
    {
        var h=t.getHours();
        var m=t.getMinutes();
        var result="";
        if(h<10) h="0" + h;
        if(m<10) m="0" + m;
        return h+":"+m;
    }

    var searchArray=new Array();
    function MakeTable()
    {
        var state,league="";
        var H_redcard,G_redcard,H_yellow,G_yellow;
        var leagueIndex=0,oldLeagueIndex=0,line=0,ad=1;

        var html=new Array();
        html.push("<table id='table_live' width=634 align=center cellspacing=0 border=0 cellpadding=0><tr id='tr_0' class='scoretitle'>");
        html.push("<td width=4%>&nbsp;</td><td width=6%>Time</td><td  width=8%>Status</td><td width=24% style='text-align:right'>Home</td><td  width=10%>Score</td><td width=24%  style='text-align:left'>Away</td><td width=8%>H-T</td><td  width=15%>Data</td></tr>");
        if(matchcount==0) html.push("<tr><td colspan=8 height=40>No match.</td></tr>");
        for(var i=1; i<=matchcount;i++)
        {
            try{
                leagueIndex=A[i][1];
                if(Bf_simply_disp && B[leagueIndex][4]==0) continue;

                state=parseInt(A[i][8]);
                match_half = "&nbsp;";
                switch(state)
                {
                    case 0:
                        if(A[i][19]=="1") match_score = "Lineup"; else  match_score = "-";
                        break;
                    case 1:
                        match_score = A[i][9] + " - " + A[i][10];
                        break;
                    case -11:
                    case -14:
                        match_score = "&nbsp;";
                        break;
                    default:
                        match_score = A[i][9] + " - " + A[i][10];
                        if(A[i][11]==null) A[i][11]="";
                        if(A[i][12]==null) A[i][12]="";
                        match_half=A[i][11] + " - " + A[i][12];
                        break;
                }
                searchArray[i-1]="<a href='javascript:' onclick='Odds(" + A[i][0] + ")' ><font color=blue>"+ state_ch[state+14]+"</font>&nbsp;&nbsp;"+ A[i][4] +"&nbsp;&nbsp;<font color=blue>" +match_score+"</font>&nbsp;&nbsp;"+ A[i][5]+ "</a>";
                if(A[i][13]!="0") H_redcard = "<img src='http://www.nowgoal.com/images/redcard" + A[i][13] + ".gif'>"; else H_redcard = "";
                if(A[i][14]!="0") G_redcard = "<img src='http://www.nowgoal.com/images/redcard" + A[i][14] +  ".gif'>"; else  G_redcard = "";
                if(A[i][15]!="0") H_yellow = "<img src='http://www.nowgoal.com/images/yellow" + A[i][15] + ".gif'>"; else H_yellow = "";
                if(A[i][16]!="0") G_yellow = "<img src='http://www.nowgoal.com/images/yellow" + A[i][16] +  ".gif'>"; else  G_yellow = "";

                if(i % 2==1) bg=""; else bg="b2";
                ad++;
                var t = A[i][6].split(",");
                var t2 = new Date(t[0],t[1],t[2],t[3],t[4],t[5]);
                t2 = new Date(Date.UTC(t2.getFullYear(),t2.getMonth(),t2.getDate(),t2.getHours(),t2.getMinutes(),t2.getSeconds()));

                if(state ==-1)  classx2 = "red";  else classx2 = "blue";
                if(oldLeagueIndex!=leagueIndex)
                {
                    oldLeagueIndex=leagueIndex;
                    html.push("<tr class='Leaguestitle' id='tr_"+ leagueIndex +"'><td colspan='8'><span class='l1'><a href='javascript:'>" +B[leagueIndex][2] +"</a> " + (t2.getMonth()+1) +"/" + t2.getDate() +"/" + t2.getFullYear()+ " ("+ week[t2.getDay()] +")</span><span class='l2'>");
                    if(B[A[i][1]][5]!="")	html.push("<a href='http://info.nowgoal.com/en/" +B[A[i][1]][5] +"' target=_blank><img src='http://www.nowgoal.com/images/schedule.gif'/></a>");
                    html.push("<a href='javascript:HiddenLeague(" + leagueIndex + ",false)' id='collapse"+ leagueIndex+"'><img src='http://www.nowgoal.com/images/collapse.gif'/></a><a href='javascript:HiddenLeague(" + leagueIndex + ",true)' id='expand"+ leagueIndex+"' style='display:none;'><img src='http://www.nowgoal.com/images/expand.gif'/></a><a href='javascript:CloseLeague(" + leagueIndex + ") '><img src='http://www.nowgoal.com/images/closes.gif'/></a></span></td></tr>");
                }
                html.push("<tr id='tr1_" + A[i][0] +"' class='" + bg +"' index='"  + i + "'>");
                html.push("<td><img src='http://www.nowgoal.com/images/lclose.gif' width='7' height='7' onclick='hidematch(" + i + ");' style='cursor:pointer;display:none;'/><img id='mygame_"+A[i][0]+"' title='Add this game to trò chơi của tôi' src='http://www.nowgoal.com/images/admygame.gif' onclick='mymatch(" + i + ");' style='cursor:pointer;'/><img id='delgame_"+A[i][0]+"' title='Remove this game from  trò chơi của tôi!' src='http://www.nowgoal.com/images/lclose.gif' onclick='myremoveMatch(" + i + ");' style='cursor:pointer;display:none;'/></td>");
                html.push("<td width=0 style='display:none;'></td>");
                html.push("<td class='time' id='mt_" + A[i][0] +"'>" + formatTime(t2) +"</td>");
                html.push("<td class='status' id='time_" + A[i][0] +"' class='td_status'>" +state_ch[state+14] +"</td>");
                html.push("<td style='text-align:right'><span id=horder_" + A[i][0] +"></span><a id='yellow1_" + A[i][0] +"' "+(document.getElementById("YellowCheck").checked?"":"style=\"display:none;\" ")+" >" + H_yellow + "</a><a id='redcard1_" + A[i][0] +"'>" + H_redcard + "</a> <a id='team1_" + A[i][0] +"' href='javascript:' onclick='Team(" +A[i][2] +")'>" + A[i][4] + "</a></td>");
                html.push("<td onclick='showgoallist(" + A[i][0] + ")' class='" + classx2 + "' onmouseover='showdetail(" + i + ",event)' onmouseout='hiddendetail()'>" + match_score + "</td>");
                html.push("<td style='text-align:left'><a id='team2_" + A[i][0] +"' href='javascript:' onclick='Team(" + A[i][3] +")'>" + A[i][5]+ "</a> <a id='redcard2_" + A[i][0] +"'>" + G_redcard + "</a><a id='yellow2_" + A[i][0] +"' "+(document.getElementById("YellowCheck").checked?"":"style=\"display:none;\" ")+" >" + G_yellow + "</a><span id=gorder_" + A[i][0] +"></span></td>");
                html.push("<td class=red2>" + match_half + "</td>");
                html.push("<td class='toolimg' style='text-align:left;'><a href='javascript:Odds(" + A[i][0] +")' title='odds'><img src='http://www.nowgoal.com/images/t1.gif'/></a><a href='javascript:odds1x2(" + A[i][0] +")' title='1x2 odds'><img src='http://www.nowgoal.com/images/t4.gif'/></a><a href='javascript:analysis(" + A[i][0] +")' title='Match analyze'><img src='http://www.nowgoal.com/images/t2.gif' /></a>");
                if(A[i][20]=="True")
                {  html.push("<a href='http://data.nowgoal.com/3in1odds/"+A[i][0]+".html' target='_blank'><img src='http://www.nowgoal.com/images/"+(parseInt(state)>0?"t32":"t3")+".gif' height=10 width=10 title='"+(parseInt(state)>0?"Crown live betting available right now":"live betting available today")+"'></a>");}
                html.push("</td></tr>");

                if((A[i][22] == "" && A[i][24] == "")||(A[i][22] == "" && showExplain(A[i][24],A[i][4],A[i][5])=="")) classx="none"; else classx="";
                html.push("<tr id='tr2_" + A[i][0] +"' style='display:" + classx + "' bgcolor='#FFFFE8'><td colspan=8 align=center height=18 style='color:green;padding-left:10px;'><div id='other_" + A[i][0] +"' style=\"text-align:right;float:left;width:300px;\">");

                if(A[i][24]&&A[i][24] != "")
                    html.push(showExplain(A[i][24],A[i][4],A[i][5]));

                if(showExplain(A[i][24],A[i][4],A[i][5])!="")
                    html.push("<br />"+A[i][22]);
                else
                    html.push(A[i][22]);

                html.push("</div></td></tr>");

                if(ad%2==0)
                {
                    if(line<adinfo1.length)
                        html.push("<tr id=tr_ad"+ line +" bgcolor='#FFFFE8'><td colspan=8 align=center height=20><a href='" + adinfo1[line] + "' target=_blank ><b>" + unescape(adinfo2[line]) + "</b></a></td></tr>");
                    line++;}
            }catch(e){}
        }
        html.push("</table>")
        document.getElementById("live").innerHTML=html.join("");
    }
    function MakeTableByTime()
    {
        var state,day="";
        var H_redcard,G_redcard,H_yellow,G_yellow;
        var showResultTr=false;
        var line=0,ad=1;

        var html=new Array();
        html.push("<table id='table_live' width=634 align=center cellspacing=0 border=0 cellpadding=0><tr id='tr_0' class='scoretitle'>");
        html.push("<td width=3% height=20>&nbsp;</td><td width=9%>Giải đấu</td><td  width=11%>Thời gian</td><td  width=11%>Tình trạng</td><td width=19% align=right>Đội nhà</td><td  width=7%>Hệ số</td><td width=19% align=left>Đội khách</td><td width=6%>H-T</td><td  width=15%>Dữ liệu</td></tr>");
        if(matchcount==0) html.push("<tr><td colspan=9 height=40>Không có trận đấu.</td></tr>");
        for(var i=1; i<=matchcount;i++)
        {
            try{
                if(Bf_simply_disp && B[A[i][1]][4]==0) continue;
                state=parseInt(A[i][8]);
                match_half = "&nbsp;";
                switch(state)
                {
                    case 0:
                        if(A[i][19]=="1") match_score = "Lineup"; else  match_score = "-";
                        break;
                    case 1:
                        match_score = A[i][9] + " - " + A[i][10];
                        break;
                    case -11:
                    case -14:
                        match_score = "&nbsp;";
                        break;
                    default:
                        match_score = A[i][9] + " - " + A[i][10];
                        if(A[i][11]==null) A[i][11]="";
                        if(A[i][12]==null) A[i][12]="";
                        match_half=A[i][11] + " - " + A[i][12];
                        break;
                }
                searchArray[i-1]="<a href='javascript:' onclick='Odds(" + A[i][0] + ")' ><font color=blue>"+ state_ch[state+14]+"</font>&nbsp;&nbsp;"+ A[i][4] +"&nbsp;&nbsp;<font color=blue>" +match_score+"</font>&nbsp;&nbsp;"+ A[i][5]+ "</a>";
                if(A[i][13]!="0") H_redcard = "<img src='http://www.nowgoal.com/images/redcard" + A[i][13] + ".gif'>"; else H_redcard = "";
                if(A[i][14]!="0") G_redcard = "<img src='http://www.nowgoal.com/images/redcard" + A[i][14] +  ".gif'>"; else  G_redcard = "";
                if(A[i][15]!="0") H_yellow = "<img src='http://www.nowgoal.com/images/yellow" + A[i][15] + ".gif'>"; else H_yellow = "";
                if(A[i][16]!="0") G_yellow = "<img src='http://www.nowgoal.com/images/yellow" + A[i][16] +  ".gif'>"; else  G_yellow = "";

                if(i % 2==1) bg=""; else bg="b2";
                ad++;
                var t = A[i][6].split(",");
                var t2 = new Date(t[0],t[1],t[2],t[3],t[4],t[5]);
                t2 = new Date(Date.UTC(t2.getFullYear(),t2.getMonth(),t2.getDate(),t2.getHours(),t2.getMinutes(),t2.getSeconds()));

                if(state ==-1)  classx2 = "red";  else classx2 = "blue";
                if(state<0 && !showResultTr)
                {
                    showResultTr=true;
                    html.push("<tr align=center bgcolor='#ffffcc' height=20><td colspan=9><b>Kết quả</b></td></tr>");
                }
                if(state>=0 && day!=t2.getDate())
                {
                    day=t2.getDate();
                    html.push("<tr class='Leaguestitle'><td colspan=9><b>" + (t2.getMonth()+1) +"/" + t2.getDate() +"/" + t2.getFullYear()+ " ("+ week[t2.getDay()] +")</b></td></tr>");
                }

                html.push("<tr id='tr1_" + A[i][0] +"' class='" + bg +"' index='"  + i + "'>");
                html.push("<td><img src='http://www.nowgoal.com/images/lclose.gif' width='7' height='7' onclick='hidematch(" + i + ");' style='cursor:pointer;display:none;'/><img id='mygame_"+A[i][0]+"' title='Add this game to trò chơi của tôi' src='http://www.nowgoal.com/images/admygame.gif' onclick='mymatch(" + i + ");' style='cursor:pointer;'/><img id='delgame_"+A[i][0]+"' title='Remove this game from  trò chơi của tôi!' src='http://www.nowgoal.com/images/lclose.gif' onclick='myremoveMatch(" + i + ");' style='cursor:pointer;display:none;'/></td>");
                html.push("<td bgcolor=" + B[A[i][1]][3] +" style='color:#ddd;' title='" + B[A[i][1]][2] + "'>");
                if(B[A[i][1]][5]!="")
                    html.push("<a href='http://info.nowgoal.com/en/" +B[A[i][1]][5] +"' target=_blank style='color:white;'>" + B[A[i][1]][1] + "</a></td>");
                else
                    html.push(B[A[i][1]][1] + "</td>");
                html.push("<td class='time' id='mt_" + A[i][0] +"'>" + formatTime(t2) +"</td>");
                html.push("<td class='status' id='time_" + A[i][0] +"' class='td_status'>" +state_ch[state+14] +"</td>");
                html.push("<td style='text-align:right'><span id=horder_" + A[i][0] +"></span><a id='yellow1_" + A[i][0] +"' "+(document.getElementById("YellowCheck").checked?"":"style=\"display:none;\" ")+" >" + H_yellow + "</a><a id='redcard1_" + A[i][0] +"'>" + H_redcard + "</a> <a id='team1_" + A[i][0] +"' href='javascript:' onclick='Team(" +A[i][2] +")'>" + A[i][4] + "</a></td>");
                html.push("<td onclick='showgoallist(" + A[i][0] + ")' class='" + classx2 + "' onmouseover='showdetail(" + i + ",event)' onmouseout='hiddendetail()'>" + match_score + "</td>");
                html.push("<td style='text-align:left'><a id='team2_" + A[i][0] +"' href='javascript:' onclick='Team(" + A[i][3] +")'>" + A[i][5]+ "</a> <a id='redcard2_" + A[i][0] +"'>" + G_redcard + "</a><a id='yellow2_" + A[i][0] +"' "+(document.getElementById("YellowCheck").checked?"":"style=\"display:none;\" ")+" >" + G_yellow + "</a><span id=gorder_" + A[i][0] +"></span></td>");
                html.push("<td class=red2>" + match_half + "</td>");
                html.push("<td class='toolimg' style='text-align:left;'><a href='javascript:Odds(" + A[i][0] +")' title='odds'><img src='http://www.nowgoal.com/images/t1.gif'/></a><a href='javascript:odds1x2(" + A[i][0] +")' title='1x2 odds'><img src='http://www.nowgoal.com/images/t4.gif'/></a><a href='javascript:analysis(" + A[i][0] +")' title='Match analyze'><img src='http://www.nowgoal.com/images/t2.gif' /></a>");

                if(A[i][20]=="True")
                {
                    html.push("<a href='http://data.nowgoal.com/3in1odds/"+A[i][0]+".html' target='_blank'><img src='http://www.nowgoal.com/images/"+(parseInt(state)>0?"t32":"t3")+".gif' height=10 width=10 title='"+(parseInt(state)>0?"Crown live betting available right now":"live betting available today")+"'></a>");
                }
                html.push("</td></tr>");

                if((A[i][22] == "" && A[i][24] == "")||(A[i][22] == "" && showExplain(A[i][24],A[i][4],A[i][5])=="")) classx="none"; else classx="";
                html.push("<tr id='tr2_" + A[i][0] +"' style='display:" + classx + "' bgcolor='#FFFFE8'><td colspan=9 align=center height=18 style='color:green;padding-left:10px;'><div id='other_" + A[i][0] +"' style=\"text-align:center;float:right;width:520px;\">");

                if(A[i][24]&&A[i][24] != "")
                    html.push(showExplain(A[i][24],A[i][4],A[i][5]));

                if(showExplain(A[i][24],A[i][4],A[i][5])!="")
                    html.push("<br />"+A[i][22]);
                else
                    html.push(A[i][22]);

                html.push("</div></td></tr>");

                if(ad%2==0)
                {
                    if(line<adinfo1.length)
                        html.push("<tr id=tr_ad"+ line +" bgcolor='#FFFFE8'><td colspan=9 align=center height=20><a href='" + adinfo1[line] + "' target=_blank ><b>" + unescape(adinfo2[line]) + "</b></a></td></tr>");

                    line++;
                }
            }catch(e){}
        }
        html.push("</table>")
        document.getElementById("live").innerHTML=html.join("");
    }

    //league list
    function MakeSclass()
    {
        var st;
        var leaguehtml=new Array();
        leaguehtml.push("<ul>");
        for(var i=1;i<=sclasscount;i++)
        {
            if(!Bf_simply_disp || B[i][4]==1){
                if(B[i][4]==1)
                    leaguehtml.push("<li><input onclick='CheckLeague(" + i + ")' checked type=checkbox id='myleague_" + i + "'><label style='cursor:pointer;color:red' for='myleague_" + i + "'>" + B[i][2] + "</label></li>");
                else
                    leaguehtml.push("<li><input onclick='CheckLeague(" + i + ")' checked type=checkbox id='myleague_" + i + "'><label style='cursor:pointer' for='myleague_" + i + "'>" + B[i][2] + "</label></li>");
            }
        }
        leaguehtml.push("</ul>");
        //document.getElementById("myleague2").innerHTML=leaguehtml.join("");
    }

    var oXmlHttp = zXmlHttp.createRequest();
    function getxml()
    {
        try{

            oXmlHttp.open("get","http://www.nowgoal.com/data/change_en.xml?" + Date.parse(new Date()),true);
            oXmlHttp.setRequestHeader("Access-Control-Allow-Origin","evil.com");
            //oXmlHttp.setRequestHeader("Access-Control-Allow-Headers","*");
            //oXmlHttp.setRequestHeader("Access-Control-Allow-Methods","GET, POST, PUT, DELETE, OPTIONS");
            oXmlHttp.onreadystatechange = refresh;
            oXmlHttp.send();
            window.setTimeout("getxml()",2000);
        }catch(e){}
    }
    function refresh()
    {
        try{
            if(oXmlHttp.readyState!=4 || (oXmlHttp.status!=200 && oXmlHttp.status!=0)) return;
            lastUpdateTime=new Date();
            var root=oXmlHttp.responseXML.documentElement;

            //alert(oXmlHttp.responseText);
            if(oldXML=="" || oldXML==oXmlHttp.responseText)
            {
                oldXML=oXmlHttp.responseText;
                return;
            }
            oldXML=oXmlHttp.responseText;
            if(root.attributes[0].value!="0")
            {
                window.setTimeout("LoadLiveFile()",Math.floor(20000 * Math.random()));
                return;
            }

            var D=new Array();
            var matchindex,score1change, score2change, scorechange;
            var goTime,hometeam,guestteam,sclassname,score1,score2,tr;
            var matchNum=0;
            var winStr="";
            var notify=document.getElementById("notify").innerHTML;

            for(var i = 0;i<root.childNodes.length;i++)
            {
                if(document.all&&getIENumber()<10)
                    D=root.childNodes[i].text.split("^"); //0:ID,1:state,2:score1,3:score2,4:half1,5:half2,6:card1,7:card2,8:yellow1,9:yellow2,10:time1,11:time2,12:explain,13:lineup
                else
                    D=root.childNodes[i].textContent.split("^");

                tr=document.getElementById("tr1_" + D[0]);
                if(tr==null)  continue;

                D[1]=parseInt(D[1]);
                matchindex=tr.attributes["index"].value;
                score1change=false;
                if(A[matchindex][9]!=D[2])
                {
                    A[matchindex][9]=D[2];
                    score1change=true;
                    tr.cells[4].style.backgroundColor="#bbbb22";
                }
                score2change=false;
                if(A[matchindex][10]!=D[3])
                {
                    A[matchindex][10]=D[3];
                    score2change=true;
                    tr.cells[6].style.backgroundColor="#bbbb22";
                }
                scorechange=score1change || score2change;

                //note
                if(A[matchindex][22]!= D[12]||A[matchindex][24]!= D[14])
                {
                    A[matchindex][22]= D[12];
                    A[matchindex][24]= D[14];
                    var ex=showExplain(D[14],A[matchindex][4],A[matchindex][5])+D[12];
                    document.getElementById("other_" + D[0]).innerHTML=ex;
                    if(D[12]+D[14]=="")
                        document.getElementById("tr2_" + D[0]).style.display="none";
                    else
                        document.getElementById("tr2_" + D[0]).style.display="";
                }

                //red card
                if(D[6]!=A[matchindex][13])
                {
                    A[matchindex][13]=D[6];
                    if(D[6]=="0")
                        document.getElementById("redcard1_" + D[0]).innerHTML="";
                    else
                        document.getElementById("redcard1_" + D[0]).innerHTML= "<img src=http://www.nowgoal.com/images/redcard" + D[6] + ".gif border='0'>";
                    if(document.getElementById("RedCheck").checked) tr.cells[4].style.backgroundColor="#ff8888";
                    window.setTimeout("timecolors(" + D[0] +","+ matchindex + ")",12000);
                }
                if(D[7]!=A[matchindex][14])
                {
                    A[matchindex][14]=D[7];
                    if(D[7]=="0")
                        document.getElementById("redcard2_" + D[0]).innerHTML="";
                    else
                        document.getElementById("redcard2_" + D[0]).innerHTML= "<img src=http://www.nowgoal.com/images/redcard" + D[7] + ".gif border='0'>";
                    if(document.getElementById("RedCheck").checked) tr.cells[6].style.backgroundColor="#ff8888";
                    window.setTimeout("timecolors(" + D[0] +","+ matchindex + ")",12000);
                }
                //yellow card
                if(D[8]!=A[matchindex][15])
                {
                    A[matchindex][15]=D[8];
                    if(D[8]=="0")
                        document.getElementById("yellow1_" + D[0]).innerHTML="";
                    else
                        document.getElementById("yellow1_" + D[0]).innerHTML= "<img src=http://www.nowgoal.com/images/yellow" + D[8] + ".gif border='0'>";
                }
                if(D[9]!=A[matchindex][16])
                {
                    A[matchindex][16]=D[9];
                    if(D[9]=="0")
                        document.getElementById("yellow2_" + D[0]).innerHTML="";
                    else
                        document.getElementById("yellow2_" + D[0]).innerHTML= "<img src=http://www.nowgoal.com/images/yellow" + D[9] + ".gif border='0'>";
                }

                //time
                if(A[matchindex][6]!=D[10])
                {
                    var t = D[10].split(",");
                    var t2 = new Date(t[0],t[1],t[2],t[3],t[4],t[5]);
                    t2 = new Date(Date.UTC(t2.getYear(),t2.getMonth(),t2.getDate(),t2.getHours(),t2.getMinutes(),t2.getSeconds()));
                    tr.cells[2].innerHTML=formatTime(t2);
                }
                A[matchindex][6]=D[10];
                A[matchindex][7]=D[11];

                //h-t
                A[matchindex][11]=D[4];
                A[matchindex][12]=D[5];

                //status
                if(A[matchindex][8]!= D[1])
                {
                    A[matchindex][8]=D[1];
                    switch(A[matchindex][8])
                    {
                        case 0:
                            tr.cells[3].innerHTML="";
                            break;
                        case 1:
                            var t = A[matchindex][7].split(",");
                            var t2 = new Date(t[0],t[1],t[2],t[3],t[4],t[5]);
                            goTime = Math.floor((new Date()-t2-difftime)/60000);
                            if(goTime>45) goTime = "45+"
                            if(goTime<1) goTime = "1";
                            tr.cells[3].innerHTML = goTime + "<img src='http://www.nowgoal.com/images/in.gif'>";
                            break;
                        case 2:
                            tr.cells[3].innerHTML=state_ch[D[1]+14];
                            break;
                        case 3:
                        case 4:
                            var t = A[matchindex][7].split(",");
                            var t2 = new Date(t[0],t[1],t[2],t[3],t[4],t[5]);
                            goTime = Math.floor((new Date()-t2-difftime)/60000)+46;
                            if(goTime>90) goTime = "90+";
                            if(goTime<46) goTime = "46";
                            tr.cells[3].innerHTML = goTime + "<img src='http://www.nowgoal.com/images/in.gif'>";
                            break;
                        case -1:
                            tr.cells[3].innerHTML=state_ch[D[1]+14];
                            tr.cells[5].style.color = "red";
                            if(orderby=="time") window.setTimeout("MoveToBottom(" + D[0] + ")",25000);
                            break;
                        case -10:
                            tr.cells[3].innerHTML=state_ch[D[1]+14];
                            break;
                        default:
                            tr.cells[3].innerHTML=state_ch[D[1]+14];
                            if(orderby=="time") MoveToBottom(D[0]);
                            break;
                    }
                }

                //score
                switch(A[matchindex][8])
                {
                    case 0:
                        if(D[11]=="1")
                            tr.cells[5].innerHTML="Lineup";
                        else
                            tr.cells[5].innerHTML="-";
                        break;
                    case 1:
                        tr.cells[5].innerHTML=(score1change?"<font color=red>"+A[matchindex][9]+"</font>":A[matchindex][9]) + " - " + (score2change?"<font color=red>"+A[matchindex][10]+"</font>":A[matchindex][10]);
                        break;
                    case -11:
                    case -14:
                        tr.cells[5].innerHTML="-";
                        tr.cells[7].innerHTML="-";
                        break;
                    default:  //2 3 -1 -12 -13
                        tr.cells[5].innerHTML=(score1change?"<font color=red>"+A[matchindex][9]+"</font>":A[matchindex][9]) + " - " + (score2change?"<font color=red>"+A[matchindex][10]+"</font>":A[matchindex][10]);
                        tr.cells[7].innerHTML=A[matchindex][11] + " - " + A[matchindex][12];
                        break;
                }

                if(scorechange)
                {
                    if(score1change)
                        ShowFlash(D[0],matchindex);

                    if(score2change)
                        ShowFlash2(D[0],matchindex);

                    if(tr.style.display!="none")
                    {
                        hometeam=A[matchindex][4].replace("<font color=#880000>(N)</font>","").substring(0,20);
                        guestteam=A[matchindex][5].substring(0,20);
                        sclassname=B[A[matchindex][1]][1];
                        if(score1change){
                            hometeam="<font color=red>" + hometeam +"</font>";
                            score1="<font color=red>" + D[2] +"</font>";
                            score2="<font color=blue>" + D[3] +"</font>";
                        }
                        if(score2change){
                            guestteam="<font color=red>" + guestteam + "</font>";
                            score1="<font color=blue>" + D[2]+"</font>";
                            score2="<font color=red>" + D[3] +"</font>";
                        }
                        window.clearTimeout(nofityTimer);
                        if(notify=="") notify="<font color=#6666FF><B>Goal notes：</b></font>";
                        notify+= sclassname +": "+ hometeam + " <font color=blue>" + score1 +"-" + score2 + "</font> " +guestteam +" &nbsp; ";
                        nofityTimer=window.setTimeout("clearNotify()",20000);

                        if(windowCheck && D[1]>=-1){
                            if(matchNum % 2==0)
                                winStr+= "<tr bgcolor=#ffffff align=center class=line><td><font color=#1705B1>" + sclassname +"</font></td><td> " + tr.cells[3].innerHTML + "</td><td><b>"+ hometeam +"</b></td><td width=11% style='font-size: 16px;font-weight:bold;'>" + score1 + " - " + score2 + "</td><td><b>" + guestteam +"</b></td></tr>";
                            else
                                winStr+= "<tr bgcolor=#FDF1E7 align=center class=line><td><font color=#1705B1>" + sclassname +"</font></td><td> " + tr.cells[3].innerHTML + "</td><td><b>"+ hometeam +"</b></td><td width=11% style='font-size: 16px;font-weight:bold;'>" + score1 + " - " + score2 + "</td><td><b>" + guestteam +"</b></td></tr>";
                            matchNum=matchNum+1
                        }
                    }
                }//scorechange
            }
            if(matchNum>0)
            {
                if (window.ActiveXObject)
                    ShowCHWindow(winStr,matchNum);
                else
                    ShowCHWindow123(winStr,matchNum);
            }
            document.getElementById("notify").innerHTML=notify;
        }catch(e){}
    }

    function ShowFlash(id,n){
        try{
            if(soundCheck && parseInt(A[n][8])>=-1){
                if(document.getElementById("tr1_" + id).style.display!="none"){
                    document.getElementById("sound").innerHTML="<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0' width='1' height='1' id='image1'><param name='movie' value='"+flash_sound[soundid]+"'><param name='quality' value='high'><param name='wmode' value='transparent'><embed src='" + flash_sound[soundid] +"' quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash' width='1' height='1'></embed></object>";
                }
            }
        }
        catch(e){};
        window.setTimeout("timecolors(" + id +","+ n+")",120000);
    }

    function ShowFlash2(id,n){
        try{
            if(soundCheck2 && parseInt(A[n][8])>=-1){
                if(document.getElementById("tr1_" + id).style.display!="none"){
                    document.getElementById("sound2").innerHTML="<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0' width='1' height='1' id='image1'><param name='movie' value='"+flash_sound[soundid2]+"'><param name='quality' value='high'><param name='wmode' value='transparent'><embed src='" + flash_sound[soundid2] +"' quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash' width='1' height='1'></embed></object>";
                }
            }
        }
        catch(e){};
        window.setTimeout("timecolors(" + id +","+ n+")",120000);
    }

    function CheckSound(n){
        writeCookie("soundCheck", n);
        if(parseInt(n)==4)
            soundCheck=false;
        else
            soundCheck=true;

        soundid=n;
        document.getElementById("sound").innerHTML="<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0' width='1' height='1' id='image1'><param name='movie' value='"+flash_sound[soundid]+"'><param name='quality' value='high'><param name='wmode' value='transparent'><embed src='" + flash_sound[soundid] +"' quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash' width='1' height='1'></embed></object>";
    }

    function CheckSound2(n){
        writeCookie("soundCheck2", n);
        if(parseInt(n)==4)
            soundCheck2=false;
        else
            soundCheck2=true;

        soundid2=n;
        document.getElementById("sound2").innerHTML="<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0' width='1' height='1' id='image1'><param name='movie' value='"+flash_sound[soundid2]+"'><param name='quality' value='high'><param name='wmode' value='transparent'><embed src='" + flash_sound[soundid2] +"' quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash' width='1' height='1'></embed></object>";
    }


    function timecolors(matchid,matchindex){
        try{
            var tr=document.getElementById("tr1_" + matchid);
            tr.cells[4].style.backgroundColor="";
            tr.cells[5].innerHTML=A[matchindex][9] +" - "+ A[matchindex][10];
            tr.cells[6].style.backgroundColor="";
        }
        catch(e){}
    }

    function clearNotify(){
        document.getElementById("notify").innerHTML="";
    }

    function ShowAllMatch(){
        try{
            var i,j,inputs;
            inputs=document.getElementById("myleague2").getElementsByTagName("input");
            for(var i=0; i<inputs.length;i++)
                inputs[i].checked=true;

            inputs=document.getElementById("table_live").getElementsByTagName("tr");
            for(var i=0; i<inputs.length;i++)
                if(inputs[i].getAttribute("index")!=null) inputs[i].style.display="";

            for(var i=1;i<=matchcount;i++)
            {
                document.getElementById("mygame_" +  A[i][0]).style.display="";
                document.getElementById("delgame_" +  A[i][0]).style.display="none";
                if(A[i][22]!="" || A[i][24] != ""&& (Bf_simply_disp==false || B[A[i][1]][4]==1)) document.getElementById("tr2_" +  A[i][0]).style.display="";
            }

            if(orderby=="league"){
                for(var i=1;i<=sclasscount;i++)
                {
                    if(Bf_simply_disp && B[i][4]==0) continue;
                    document.getElementById("tr_" + i).style.display="";
                    document.getElementById("expand" +  i).style.display="none";
                    document.getElementById("collapse" +  i).style.display="";
                }
            }
            document.getElementById("hiddencount").innerHTML="0";
            //document.getElementById("myGamesCount").innerHTML="0";
            hiddenID="_";
            //myGamesID="_";
            writeCookie("Hidden_MatchID", hiddenID);
            //writeCookie("MyGames_MatchID", myGamesID);
        }
        catch(e){}
    }

    //dispaly by status
    function ShowMatchByMatchState(n){
        var i,j;
        var hh=0;
        var trs=document.getElementById("table_live").getElementsByTagName("tr");
        for(var i=1; i<trs.length;i++){
            if(trs[i].getAttribute("index")!=null){
                trs[i].style.display="none";
                trs[i+1].style.display="none";
            }
        }
        for(var i=1;i<=matchcount;i++){
            if(Bf_simply_disp && B[A[i][1]][4]==0) continue;
            if(n==1 && parseInt(A[i][8])>0 || n==2 && A[i][8]=="-1" || n==3 && A[i][8]=="0" || n==4 && A[i][20]=="True")
            {
                document.getElementById("tr1_" +  A[i][0]).style.display="";
                document.getElementById("mygame_" +  A[i][0]).style.display="";
                document.getElementById("delgame_" +  A[i][0]).style.display="none";
                if(A[i][22]!="" || A[i][24] != "") document.getElementById("tr2_" +  A[i][0]).style.display="";
            }
            else
                hh=hh+1;
        }
        document.getElementById("hiddencount").innerHTML=hh;

        if(orderby=="league"){
            for(var i=1;i<=sclasscount;i++)
            {
                var show=false;
                if(Bf_simply_disp && B[i][4]==0) continue;
                for(var j=1;j<=matchcount;j++){
                    if(A[j][1]!=i) continue;
                    if(n==1 && parseInt(A[j][8])>0 || n==2 && A[j][8]=="-1" || n==3 && A[j][8]=="0" || n==4 && A[j][20]=="True") show=true;
                }
                if(show)
                    document.getElementById("tr_" + i).style.display="";
                else
                    document.getElementById("tr_" + i).style.display="none";
            }
        }
    }
    function mymatch(i){
        document.getElementById("tr1_" +  A[i][0]).style.display="none";
        document.getElementById("mygame_" +  A[i][0]).style.display="none";
        document.getElementById("delgame_" +  A[i][0]).style.display="";
        if(document.getElementById("tr2_" +  A[i][0]))
            document.getElementById("tr2_" +  A[i][0]).style.display="none";


        if(myGamesID.indexOf("_"+A[i][0] + "_")==-1)
        { myGamesID+=A[i][0] + "_";
            document.getElementById("myGamesCount").innerHTML=parseInt(document.getElementById("myGamesCount").innerHTML)+1;
        }

        writeCookie("MyGames_MatchID", myGamesID);
    }

    function myremoveMatch(i){
        document.getElementById("tr1_" +  A[i][0]).style.display="none";
        document.getElementById("mygame_" +  A[i][0]).style.display="";
        document.getElementById("delgame_" +  A[i][0]).style.display="none";

        if(document.getElementById("tr2_" +  A[i][0]))
            document.getElementById("tr2_" +  A[i][0]).style.display="none";//Remove this games!

        if(myGamesID.indexOf("_"+A[i][0] + "_")!=-1)
        {
            myGamesID=myGamesID.replace(A[i][0] + "_","");
            document.getElementById("myGamesCount").innerHTML=parseInt(document.getElementById("myGamesCount").innerHTML)-1;
        }

        writeCookie("MyGames_MatchID", myGamesID);
    }

    function ShowMyGames(){
        try{
            document.getElementById("li_AllOrSimply").innerHTML="<a href='javascript:ShowAllMatch();'>Show All</a>";
            var i,j,inputs;
            inputs=document.getElementById("myleague2").getElementsByTagName("input");
            for(var i=0; i<inputs.length;i++)
                inputs[i].checked=true;

            inputs=document.getElementById("table_live").getElementsByTagName("tr");
            for(var i=0; i<inputs.length;i++)
                if(inputs[i].getAttribute("index")!=null) inputs[i].style.display="none";

            for(var i=1;i<=matchcount;i++)
                if((A[i][22]!=""|| A[i][24] != "") && (Bf_simply_disp==false || B[A[i][1]][4]==1)&& document.getElementById("tr2_" +  A[i][0])) document.getElementById("tr2_" +  A[i][0]).style.display="none";

            if(orderby=="league"){
                for(var i=1;i<=sclasscount;i++)
                {
                    try{
                        if(Bf_simply_disp && B[i][4]==0) continue;
                        document.getElementById("tr_" + i).style.display="none";
                        document.getElementById("expand" +  i).style.display="none";
                        document.getElementById("collapse" +  i).style.display="none";
                    }catch(e){}
                }
            }

            myGamesID=getCookie("MyGames_MatchID");
            if(myGamesID=="_") return;
            var hh=0;
            var id=myGamesID.split("_");
            for(var i=1;i<id.length-1;i++){
                if(document.getElementById("tr1_" +  id[i])!=null){
                    document.getElementById("tr1_" +  id[i]).style.display="";
                    document.getElementById("mygame_" +  id[i]).style.display="none";
                    document.getElementById("delgame_" +  id[i]).style.display="";
                    if(document.getElementById("tr2_" +  id[i]))
                        document.getElementById("tr2_" +  id[i]).style.display="none";
                    hh++;
                }
            }
            document.getElementById("myGamesCount").innerHTML=hh;
        }catch(e){}

    }
    function ShowTeamOrder(){
        if(document.getElementById("TeamOrderCheck").checked){
            writeCookie("TeamOrderCheck", 1);
            for(var i=1;i<=matchcount;i++){
                if(Bf_simply_disp && B[A[i][1]][4]==0) continue;
                var reg=/[\u4E00-\u9FA5]/g;
                if(A[i][17]!="") document.getElementById("horder_" + A[i][0]).innerHTML="<font color=#880000>["+ A[i][17].toString().replace(reg,"") +"]</font>";
                if(A[i][18]!="") document.getElementById("gorder_" + A[i][0]).innerHTML="<font color=#880000>["+ A[i][18].toString().replace(reg,"") +"]</font>";
            }
        }
        else{
            writeCookie("TeamOrderCheck", 0);
            for(var i=1;i<=matchcount;i++){
                if(Bf_simply_disp && B[A[i][1]][4]==0) continue;
                if(A[i][17]!="") document.getElementById("horder_" +  A[i][0]).innerHTML="";
                if(A[i][18]!="") document.getElementById("gorder_" +  A[i][0]).innerHTML="";
            }
        }
    }
    function showWindowCheck()
    {
        if(document.getElementById("windowCheck").checked)
        {
            windowCheck=true;
            writeCookie("windowCheck", 1);
        }
        else
        {
            windowCheck=false;
            writeCookie("windowCheck", 0);
        }
    }

    function showRedCheck()
    {
        if(document.getElementById("RedCheck").checked)
        {
            writeCookie("RedCheck", 1);
        }
        else
        {
            writeCookie("RedCheck", 0);
        }
    }
    function hidematch(i){
        document.getElementById("tr1_" +  A[i][0]).style.display="none";
        if(document.getElementById("tr2_" +  A[i][0]))
            document.getElementById("tr2_" +  A[i][0]).style.display="none";
        document.getElementById("hiddencount").innerHTML=parseInt(document.getElementById("hiddencount").innerHTML)+1;
        if(hiddenID.indexOf("_"+A[i][0] + "_")==-1) hiddenID+=A[i][0] + "_";
        writeCookie("Hidden_MatchID", hiddenID);
    }

    function hideSelMatch(){
        if(hiddenID=="_") return;
        var hh=0;
        var id=hiddenID.split("_");
        for(var i=1;i<id.length-1;i++){
            if(document.getElementById("tr1_" +  id[i])!=null){
                document.getElementById("tr1_" +  id[i]).style.display="none";
                if(document.getElementById("tr2_" + id[i]))
                    document.getElementById("tr2_" +  id[i]).style.display="none";
                hh++;
            }
        }
        document.getElementById("hiddencount").innerHTML=hh;
    }


    function SelectOtherLeague(){
        var inputs=document.getElementById("myleague2").getElementsByTagName("input");
        var hh=0;
        for(var i=1;i<=sclasscount;i++){
            if(Bf_simply_disp && B[i][4]==0) continue;
            var obj=document.getElementById("myleague_" + i);
            obj.checked=!obj.checked;
            if(obj.checked){
                if(orderby=="league") document.getElementById("tr_" + i).style.display="";
                for(var j=1;j<=matchcount;j++){
                    if(A[j][1]==i){
                        document.getElementById("tr1_" +  A[j][0]).style.display="";
                        if(A[j][22]!="" || A[j][24] != "") document.getElementById("tr2_" +  A[j][0]).style.display="";
                        hiddenID=hiddenID.replace("_"+A[j][0] + "_","_")
                    }
                }
            }
            else{
                if(orderby=="league") document.getElementById("tr_" + i).style.display="none";
                for(var j=1;j<=matchcount;j++){
                    if(A[j][1]==i){
                        document.getElementById("tr1_" +  A[j][0]).style.display="none";
                        if(A[j][22]!="" || A[j][24] != "") document.getElementById("tr2_" +  A[j][0]).style.display="none";
                        hh=hh+1;
                        if(hiddenID.indexOf("_"+A[j][0] + "_")==-1) hiddenID+=A[j][0] + "_";
                    }
                }
            }
        }
        document.getElementById("hiddencount").innerHTML=hh;
        writeCookie("Hidden_MatchID", hiddenID);
    }

    function CheckLeague(i){
        var hh=parseInt(document.getElementById("hiddencount").innerHTML);
        if(document.getElementById("myleague_" +  i).checked){
            if(orderby=="league") document.getElementById("tr_" + i).style.display="";
            for(var j=1;j<=matchcount;j++){
                if(A[j][1]==i){
                    document.getElementById("tr1_" +  A[j][0]).style.display="";
                    if(A[j][22]!="" || A[j][24] != "") document.getElementById("tr2_" +  A[j][0]).style.display="";
                    if(hiddenID.indexOf("_"+A[j][0] + "_")!=-1){
                        hiddenID=hiddenID.replace("_"+A[j][0] + "_","_")
                        hh--;
                    }
                }
            }
        }
        else{
            if(orderby=="league") document.getElementById("tr_" + i).style.display="none";
            for(var j=1;j<=matchcount;j++){
                if(A[j][1]==i){
                    document.getElementById("tr1_" +  A[j][0]).style.display="none";
                    if(A[j][22]!="" || A[j][24] != "") document.getElementById("tr2_" +  A[j][0]).style.display="none";
                    if(hiddenID.indexOf("_"+A[j][0] + "_")==-1){
                        hiddenID+=A[j][0] + "_";
                        hh++;
                    }
                }
            }
        }
        document.getElementById("hiddencount").innerHTML=hh;
        writeCookie("Hidden_MatchID", hiddenID);
    }

    function CloseLeague(i){
        document.getElementById("myleague_" +  i).checked=false;
        CheckLeague(i);
    }

    function HiddenLeague(i,b){
        document.getElementById("myleague_" +  i).checked=b;
        if(b){
            document.getElementById("expand" +  i).style.display="none";
            document.getElementById("collapse" +  i).style.display="";
        }
        else{
            document.getElementById("expand" +  i).style.display="";
            document.getElementById("collapse" +  i).style.display="none";
        }
        CheckLeague(i);
        document.getElementById("tr_" + i).style.display="";
    }
    function MoveToBottom(m){
        try{
            document.getElementById("tr1_" +  m).parentElement.insertAdjacentElement("beforeEnd",document.getElementById("tr1_" +  m));
            document.getElementById("tr2_" +  m).parentElement.insertAdjacentElement("beforeEnd",document.getElementById("tr2_" +  m));
            for(var i=0;i<adinfo1.length;i++)
            {
                document.getElementById("table_live").rows((i+1)*5-1).insertAdjacentElement("beforeBegin",  document.getElementById("tr_ad" + i));
            }
        }catch(e){}
    }


    //update running time
    function setMatchTime(){
        for(var i=1;i<=matchcount;i++){
            try{
                if(A[i][8]=="1"){  //part 1
                    var t = A[i][7].split(",");
                    var t2 = new Date(t[0],t[1],t[2],t[3],t[4],t[5]);
                    goTime = Math.floor((new Date()-t2-difftime)/60000);
                    if(goTime>45) goTime = "45+";
                    if(goTime<1)  goTime = "1";
                    document.getElementById("time_" +  A[i][0]).innerHTML = goTime +  "<img src='http://www.nowgoal.com/images/in.gif' border=0>";
                }
                if(A[i][8]=="3"){  //part 2
                    var t = A[i][7].split(",");
                    var t2 = new Date(t[0],t[1],t[2],t[3],t[4],t[5]);
                    goTime = Math.floor((new Date()-t2-difftime)/60000)+46;
                    if(goTime>90) goTime = "90+";
                    if(goTime<46) goTime = "46";
                    document.getElementById("time_" +  A[i][0]).innerHTML = goTime +  "<img src='http://www.nowgoal.com/images/in.gif' border=0>";
                }
            }catch(e){}
        }
        runtimeTimer=window.setTimeout("setMatchTime()",30000);
    }

    var bgcolor1 = "#FFFFFF";
    var bgcolor2 = "#F4F4F4";
    var txt =["Kick-off", "First Corner Kick", "First Yellow Card", "Shots", "Shots on Goal", "Fouls", "Corner Kicks",
        "Corner Kicks(Extra time)", "Free Kicks", "Offsides", "Own Goals", "Yellow Cards", "Yellow Cards(Extra time)", "Red Cards", "Ball Possession", "Headers",
        "Saves", "Goalkeeper off his line", "Balls lost", "Successful tackles", "Interceptions", "Long balls", "Short passes", "Assists", "Successful crosses",
        "First Substitution", "Last Substitution", "First Offside", "Last Offside", "Substitutions", "Last Corner Kick", "Last Yellow Card", "Substitutions(Extra time)", "Offsides(Extra time)","",""];
    function showdetail(n,event)
    {
        if(A[n][8]=="0") return;
        try{
            if(Math.floor((new Date()-loadDetailFileTime)/600)>6) LoadDetailFile();
            var R=new Array();
            var html="<table width=350 bgcolor=#E1E1E1 cellpadding=0 cellspacing=1 style='border:solid 1px #666;'>";
            html+="<tr><td height=20 colspan=5 bgcolor=#666699 align=center><font color=white><b>Handicap：" +Goal2GoalCn(A[n][21]) +"</b></font></td></tr>";
            html+="<tr bgcolor=#D5F2B7 align=center><td height=20 colspan=2 width=44%><font color=#006600><b>" + A[n][4]+ "</b></font></td><td width=12% bgcolor=#CCE8B5><b>Min</b></td><td colspan=2 width=44%><font color=#006600><b>" + A[n][5]+"</b></font></td></tr>";
            for(var i=0; i<rq.length;i++){
                R=rq[i].split('^');
                if(R[0]!=A[n][0]) continue;
                if(R[1]=="1")
                    html+="<tr bgcolor=white align=center><td width=6% height=18><img src='http://www.nowgoal.com/images/" + R[2]+ ".gif'></td><td width=38%>" + R[4]+ "</td><td width=12% bgcolor=#EFF4EA>" + R[3]+ "'</td><td width=38%></td><td width=6%></td></tr>";
                else
                    html+="<tr bgcolor=white align=center><td width=6% height=18></td><td width=38%></td><td width=12% bgcolor=#EFF4EA>" + R[3]+ "'</td><td width=38%>" + R[4]+ "</td><td width=6%><img src='http://www.nowgoal.com/images/" + R[2]+ ".gif'></td></tr>";
            }
            html+="<tr><td colspan=5>";
            var T=new Array();
            for(var i=0; i<tc.length;i++){
                T=tc[i].split('^');
                if(T[0]!=A[n][0]) continue;
                var tech = T[1].replace(/\＊/gi, "*").replace(/\*/gi, "<img src=http://www.nowgoal.com/images/55.gif width=11 height=11>").split(';');
                html+="<table width=100% bgcolor=#E1E1E1 cellpadding=0 cellspacing=1>";
                html+="<tr><td colspan=3 align=center bgcolor=#D5F2B7 height=20><font color=#006600><b>Match Stats</b></font></td></tr>";

                for (j = 0; j < tech.length - 1; j++)
                {
                    if (parseInt(tech[j].split(',')[0],10) > 34) continue;
                    bgcolor = j % 2 == 0 ? bgcolor1 : bgcolor2;
                    html+="<tr height=18 bgcolor=" + bgcolor1 + " align=center>";
                    html+="<td width='25%'>" + tech[j].split(',')[1] + "</td>";
                    html+="<td bgcolor=" + bgcolor2 + ">" + txt[parseInt(tech[j].split(',')[0])] + "</td>";
                    html+="<td width='25%'>" + tech[j].split(',')[2] + "</td></tr>";
                }
                html+="</table>";
            }
            html+="</td></tr></table>";
            document.getElementById('winScore').style.left =(document.body.clientWidth/2-200) +"px";
            document.getElementById('winScore').style.top = (getTopHeight() + event.clientY+15)+"px";
            document.getElementById("winScore").innerHTML=html;
            document.getElementById("winScore").style.display="";
        }catch(e){}
    }

    function hiddendetail()
    {
        document.getElementById("winScore").innerHTML="";
        document.getElementById("winScore").style.display="none";
    }

    function check(){
        if (oldUpdateTime == lastUpdateTime && oldUpdateTime !=""){
            if (confirm("Due to procedural busyness or other network problems, you have been disconnected with the server more than 5 minutes, whether re-link to continue your watching score or not?")) window.location.reload();
        }
        oldUpdateTime = lastUpdateTime;
        window.setTimeout("check()" , 300000);
    }

    function setOrderby(a)
    {
        orderby=a
        writeCookie("orderby", orderby);
        LoadLiveFile();
    }
    function ReplaceStyle(css)
    {
        document.getElementById("cssLink").href="http://www.nowgoal.com/style/" + css +".css";
        writeCookie("css", css);
    }
    function LoadLiveFile()
    {
        var allDate=document.getElementById("allDate");
        var  s=document.createElement("script");
        s.type="text/javascript";
        //if(infoid!="")
        //{
        ////    s.src="http://data.nowgoal.com/MatchByCountry.aspx?infoid=" +infoid+"&orderby="+orderby+"&t=" +Date.parse(new Date());
        //  if(infoid!=53 && infoid!=54 && infoid!=55 && infoid!=56 && infoid!=97)	document.getElementById("li_"+infoid).className="select";
        //}
        //else
        //{
//		if(orderby=="league")
//			s.src="data/bf_en1.js?" +Date.parse(new Date());
//		else
        s.src="http://www.nowgoal.com/data/bf_vn.js?" +Date.parse(new Date());
        //}
        allDate.removeChild(allDate.firstChild);
        allDate.appendChild(s,"script");
        window.setTimeout("LoadLiveFile()",3600*1000);
    }
    function LoadDetailFile()
    {
        var detail=document.getElementById("span_detail");
        var  s=document.createElement("script");
        s.type="text/javascript";
        s.src="http://www.nowgoal.com/data/detail.js?" +Date.parse(new Date());

        detail.removeChild(detail.firstChild);
        detail.appendChild(s,"script");
        loadDetailFileTime=new Date();
    }
    function changeFontSize(obj,size){
        for(var i=1;i<=matchcount;i++){
            if(Bf_simply_disp==false || A[i][26]==1){
                document.getElementById("team1_"+ A[i][0]).style.fontSize=size+"px";
                document.getElementById("team2_"+ A[i][0]).style.fontSize=size+"px";
            }
        }
    }

    orderby=getCookie("orderby");
    if(orderby==null) orderby="time";
    LoadLiveFile();

    window.setTimeout("getxml()",2000);
    window.setTimeout("check()" , 3000);

    var testBeginTime;
    var oXmlTest = zXmlHttp.createRequest();
    function test()
    {
        testBeginTime=new Date();
        oXmlTest.open("get","http://www.nowgoal.com/test/text.txt?" + Date.parse(new Date()),true);
        oXmlTest.onreadystatechange = test2;
        oXmlTest.send(null);
    }
    function test2()
    {
        if(oXmlTest.readyState!=4 || (oXmlTest.status!=200 && oXmlTest.status!=0)) return;
        var runTime=new Date() -testBeginTime;
        var result=512*1000/runTime;
        oXmlTest.open("get","http://www.nowgoal.com/test/testAddDb.aspx?result=" + result,true);
        oXmlTest.send(null);
    }
    //window.setTimeout("test()",60000);
</script>

<div id="div_h" style="float:left; width:300px">
    <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#DDDDDD"  class="gts">
        <tr>
            <td colspan="7" ><script language="Javascript" type="text/javascript">document.write(companyName[3]);</script> 1X2 Odds</td></tr>
        <tr class="gta">
            <td width="9%" >Time</td>
            <td width="15%" >Score</td>
            <td width="17%">Home</td>
            <td width="17%">Draw</td>
            <td width="17%">Away</td>
            <td width="16%">Update</td>
            <td width="9%">Status</td>
        </tr>

        <tr class=" gt1">
            <td  ></td>
            <td  >-</td>
            <td style="color:green;">2.11</td>
            <td style="color:;">3.40</td>
            <td style="color:red;">3.00</td>
            <td style="line-height:16px;"><script>showDate(2015,03-1,24,04,05,00)</script></td>
            <td class="hg_red">Live</td>
        </tr>

        <tr class=" gt2">
            <td  ></td>
            <td  >-</td>
            <td style="color:green;">2.12</td>
            <td style="color:;">3.40</td>
            <td style="color:red;">2.95</td>
            <td style="line-height:16px;"><script>showDate(2015,03-1,24,03,59,00)</script></td>
            <td class="hg_green">Ear</td>
        </tr>

        <tr class=" gt1">
            <td  ></td>
            <td  >-</td>
            <td style="color:red;">2.16</td>
            <td style="color:;">3.40</td>
            <td style="color:green;">2.90</td>
            <td style="line-height:16px;"><script>showDate(2015,03-1,24,03,56,00)</script></td>
            <td class="hg_green">Ear</td>
        </tr>

        <tr class=" gt2">
            <td  ></td>
            <td  >-</td>
            <td style="color:green;">2.12</td>
            <td style="color:;">3.40</td>
            <td style="color:red;">2.95</td>
            <td style="line-height:16px;"><script>showDate(2015,03-1,24,03,54,00)</script></td>
            <td class="hg_green">Ear</td>
        </tr>

        <tr class=" gt1">
            <td  ></td>
            <td  >-</td>
            <td style="color:red;">2.16</td>
            <td style="color:;">3.40</td>
            <td style="color:;">2.90</td>
            <td style="line-height:16px;"><script>showDate(2015,03-1,24,03,30,00)</script></td>
            <td class="hg_green">Ear</td>
        </tr>

        <tr class=" gt2">
            <td  ></td>
            <td  >-</td>
            <td style="color:green;">2.15</td>
            <td style="color:;">3.40</td>
            <td style="color:;">2.90</td>
            <td style="line-height:16px;"><script>showDate(2015,03-1,24,03,28,00)</script></td>
            <td class="hg_green">Ear</td>
        </tr>

        <tr class=" gt1">
            <td  ></td>
            <td  >-</td>
            <td style="color:red;">2.16</td>
            <td style="color:;">3.40</td>
            <td style="color:;">2.90</td>
            <td style="line-height:16px;"><script>showDate(2015,03-1,24,03,26,00)</script></td>
            <td class="hg_green">Ear</td>
        </tr>

        <tr class=" gt2">
            <td  ></td>
            <td  >-</td>
            <td style="color:;">2.15</td>
            <td style="color:red;">3.40</td>
            <td style="color:red;">2.90</td>
            <td style="line-height:16px;"><script>showDate(2015,03-1,24,03,11,00)</script></td>
            <td class="hg_green">Ear</td>
        </tr>

        <tr class=" gt1">
            <td  ></td>
            <td  >-</td>
            <td style="color:green;">2.15</td>
            <td style="color:;">3.30</td>
            <td style="color:red;">2.85</td>
            <td style="line-height:16px;"><script>showDate(2015,03-1,24,01,01,00)</script></td>
            <td class="hg_green">Ear</td>
        </tr>

        <tr class=" gt2">
            <td  ></td>
            <td  >-</td>
            <td style="color:green;">2.20</td>
            <td style="color:;">3.30</td>
            <td style="color:red;">2.75</td>
            <td style="line-height:16px;"><script>showDate(2015,03-1,23,09,23,00)</script></td>
            <td class="hg_green">Ear</td>
        </tr>

        <tr class=" gt1">
            <td  ></td>
            <td  >-</td>
            <td style="color:red;">2.25</td>
            <td style="color:;">3.30</td>
            <td style="color:green;">2.70</td>
            <td style="line-height:16px;"><script>showDate(2015,03-1,23,09,22,00)</script></td>
            <td class="hg_green">Ear</td>
        </tr>

        <tr class=" gt2">
            <td  ></td>
            <td  >-</td>
            <td style="color:green;">2.20</td>
            <td style="color:;">3.30</td>
            <td style="color:red;">2.75</td>
            <td style="line-height:16px;"><script>showDate(2015,03-1,23,09,19,00)</script></td>
            <td class="hg_green">Ear</td>
        </tr>

        <tr class=" gt1">
            <td  ></td>
            <td  >-</td>
            <td style="color:;">2.25</td>
            <td style="color:;">3.30</td>
            <td style="color:;">2.70</td>
            <td style="line-height:16px;"><script>showDate(2015,03-1,23,08,37,00)</script></td>
            <td class="hg_green">Ear</td>
        </tr>

    </table>
</div>


</body>
</html>