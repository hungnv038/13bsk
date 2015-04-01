@extends('admin.layouts.client')
@section('header')
    <title>The Match list</title>
@stop
@section('content')
    <script>
        var urlApi = '<?php echo URL::to('/') ?>/';

        $(document).ready(function () {
            //$('#result').html("Loading....");
            //refresh();
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
    <div>
        <p class="text-center">sssss v ffffff</p>
    </div>
    <div id="result">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>Thời gian</td>
                            <td>Tỉ số </td>
                            <td>Chủ </td>
                            <td>Tỉ lệ</td>
                            <td>Khách</td>
                            <td>Trạng thái</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class=" gt1">
                            <td  style="color:#663333;">75</td>
                            <td  >1-3</td>
                            <td ></td>
                            <td style="color:green;">Closed</td>
                            <td></td>
                            <td class="hg_blue">Run</td>
                        </tr>

                        <tr class=" gt2">
                            <td  style="color:#663333;">64</td>
                            <td  >1-3</td>
                            <td style="color:red;">55.00</td>
                            <td style="color:red;">9.00</td>
                            <td >1.03</td>
                            <td class="hg_blue">Run</td>
                        </tr>

                        <tr class=" gt1">
                            <td  style="color:#663333;">63</td>
                            <td  >1-3</td>
                            <td>33.00</td>
                            <td>8.50</td>
                            <td style="color:green;">1.03</td>
                            <td class="hg_blue">Run</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td>Thời gian</td>
                        <td>Tỉ số </td>
                        <td>Chủ </td>
                        <td>Tỉ lệ</td>
                        <td>Khách</td>
                        <td>Trạng thái</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class=" gt1">
                        <td  style="color:#663333;">75</td>
                        <td  >1-3</td>
                        <td ></td>
                        <td style="color:green;">Closed</td>
                        <td></td>
                        <td class="hg_blue">Run</td>
                    </tr>

                    <tr class=" gt2">
                        <td  style="color:#663333;">64</td>
                        <td  >1-3</td>
                        <td style="color:red;">55.00</td>
                        <td style="color:red;">9.00</td>
                        <td >1.03</td>
                        <td class="hg_blue">Run</td>
                    </tr>

                    <tr class=" gt1">
                        <td  style="color:#663333;">63</td>
                        <td  >1-3</td>
                        <td>33.00</td>
                        <td>8.50</td>
                        <td style="color:green;">1.03</td>
                        <td class="hg_blue">Run</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td>Thời gian</td>
                        <td>Tỉ số </td>
                        <td>Chủ </td>
                        <td>Tỉ lệ</td>
                        <td>Khách</td>
                        <td>Trạng thái</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class=" gt1">
                        <td  style="color:#663333;">75</td>
                        <td  >1-3</td>
                        <td ></td>
                        <td style="color:green;">Closed</td>
                        <td></td>
                        <td class="hg_blue">Run</td>
                    </tr>

                    <tr class=" gt2">
                        <td  style="color:#663333;">64</td>
                        <td  >1-3</td>
                        <td style="color:red;">55.00</td>
                        <td style="color:red;">9.00</td>
                        <td >1.03</td>
                        <td class="hg_blue">Run</td>
                    </tr>

                    <tr class=" gt1">
                        <td  style="color:#663333;">63</td>
                        <td  >1-3</td>
                        <td>33.00</td>
                        <td>8.50</td>
                        <td style="color:green;">1.03</td>
                        <td class="hg_blue">Run</td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

@stop