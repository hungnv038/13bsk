@extends('admin.layouts.client')
@section('header')
<title>The Match list</title>
@stop
@section('content')
    <table class="table table-bordered">
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
            <tr class="success">
                <td style="background-color: {{$match->color}}}; color: #ffffff">{{$match->code}}</td>
                <td>{{DateTime::createFromFormat('Y-m-j H:i:s',$match->time_1)->format("M-j H:i")}}</td>
                <td>
                    @if(intval($match->status)==-1)
                        FT
                    @elseif(intval($match->status)==2)
                        HT
                    @elseif(intval($match->status)==1 || intval($match->status)==3)


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