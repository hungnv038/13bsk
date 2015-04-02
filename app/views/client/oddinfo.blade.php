@extends('admin.layouts.client')
@section('header')
    <title>{{$title}}</title>
@stop
@section('content')
    <script>
        var urlApi = '<?php echo URL::to('/') ?>/matchs/'+'<?php echo $match_id ?>/odds/data';

        $(document).ready(function () {
            $('#result').html("Loading....");
            refresh();
        });
        function refresh() {
            $.ajax({
                url: urlApi,
                type: "GET",
                success:function(result) {
                    $('#result').html(result);
                },
                error: function(jqXHR){
                    $('#result').html(jqXHR.responseText);
                }
            });

            setTimeout("refresh()",1000*60);
        }
    </script>
    <h3 style="width: 100%; text-align: center; color: blue">{{$title}}</h3>

    <div id="result">

    </div>
@stop