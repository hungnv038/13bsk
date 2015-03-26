@extends('admin.layouts.client')
@section('header')
<title>The Match list</title>
@stop
@section('content')
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
                $start_time=DateTime::createFromFormat('Y-m-j H:i:s',$match->time_1)->format("M-j H:i");
                    $minute="";
                    $time_color=0x000;
                if(intval($match->status)==-1) {
                    $minute="FT";
                    $time_color=0xff0000;
                }elseif(intval($match->status)==2) {
                    $minute="HT";
                    $time_color=0x0000ff;
                }elseif(intval($match->status)==1) {
                    $minute=floor((time()-strtotime($match->time_2))/60);
                    if($minute<1) $minute=1;
                    if($minute>45) $minute="45+";
                    $time_color=0x0000ff;
                }elseif(intval($match->status)==3) {
                    $minute=floor(46+(time()-strtotime($match->time_2))/60);
                    if($minute<46) $minute=46;
                    if($minute>90) $minute="90+";
                    $time_color=0x0000ff;
                }
            ?>
            <tr>
                <td style="background-color: {{$match->color}}}; color: #ffffff">{{$match->code}}</td>
                <td>{{DateTime::createFromFormat('Y-m-j H:i:s',$match->time_1)->format("M-j H:i")}}</td>
                <td style="color: {{$time_color}} !important;">
                    {{$minute}}
                </td>
                <td>{{$match->h_team}}</td>
                <td>{{$match->h_goal." - ".$match->g_goal}}</td>
                <td>{{$match->g_team}}</td>
                <td>{{$match->ht_h_goal." - ".$match->ht_g_goal}}</td>
                <td>
                    @if($match->have_odd)
                        <a href="{{$match->odd_link}}"><image src="http://www.nowgoal.com/images/t3.gif"/></a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop