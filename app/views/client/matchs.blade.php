@extends('admin.layouts.client')
@section('header')
<title>The Match list</title>
@stop
@section('content')
    <script>
        var urlApi = '<?php echo URL::to('/') ?>/';

        $(document).ready(function () {
            $('#result').html("Loading....");
            refresh();
        });
        function refresh() {
            $.ajax({
                url: urlApi + 'matchs/data',
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
    <div id="result">
    </div>

@stop