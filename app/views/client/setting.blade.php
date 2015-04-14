<?php
?>
@extends('admin.layouts.client')
@section('header')
    <title>Odd Settings</title>

@stop
@section('content')
    <ul class="nav nav-tabs">
        <li class="active"><a href="#ruleSetting" data-toggle="tab"><span class="glyphicon glyphicon-certificate"></span> Cài đặt các luật </a></li>
        <li><a href="#soundSetting" data-toggle="tab"><span class="glyphicon glyphicon-bell"></span>Cài đặt âm thanh </a></li>
    </ul>
    <div class="tabbable">
        <div class="tab-content">
            <div class="tab-pane active" id="ruleSetting">
                <div class="row" style="padding-top: 10px;">
                    <div class="col-lg-3 col-md-3 col-xs-12 col-sm-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Loại luật
                            </div>
                            <div class="panel-body">
                                <div class="list-group" id="rule_type_list">
                                    <a href="#" class="list-group-item"
                                       onclick="SettingModule.LoadRuleData(this,2); return false;">
                                        <span class="glyphicon glyphicon-chevron-right"></span>
                                        Crown Handicap Odds
                                        <span class="badge"><?php if (array_key_exists(2, $cnts)) echo $cnts[2]; else echo 0; ?></span>
                                    </a>
                                    <a href="#" class="list-group-item"
                                       onclick="SettingModule.LoadRuleData(this,3); return false;">
                                        <span class="glyphicon glyphicon-chevron-right"></span>
                                        Crown Over/Under Odds
                                        <span class="badge"><?php if (array_key_exists(3, $cnts)) echo $cnts[3]; else echo 0; ?></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-xs-12 col-sm-12">
                        <span id="spanError" style="background-color: #ce8483"></span>

                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Danh sách các luật
                                <div class="btn-group navbar-right" role="group" aria-label="...">
                                    <button type="button" class="btn btn-small btn-sm btn-success" id="btnAdd" onclick="SettingModule.showAddDialog(this)"><span
                                                class="fa fa-plus"></span> Tạo mới
                                    </button>
                                </div>
                            </div>
                            <div class="panel-body" id="rule_data">

                            </div>
                        </div>

                        <!-- Add Modal -->
                        <div class="modal fade" id="addrule" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span aria-hidden="true">&times;</span>
                                        </button>
                                        <h4 class="modal-title" id="myModalLabel">Tạo mới luật </h4>
                                    </div>
                                    <div class="modal-body" id="newbody">

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Huỷ
                                        </button>
                                        <button type="button" class="btn btn-primary"
                                                onclick="SettingModule.addRule(this,'insert'); return false;">
                                            Lưu
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- EDIT Modal -->
                        <div class="modal fade" id="editrule" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span aria-hidden="true">&times;</span>
                                        </button>
                                        <h4 class="modal-title" id="myModalLabel">Cập nhật luật </h4>
                                    </div>
                                    <div class="modal-body" id="editbody">

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Huỷ
                                        </button>
                                        <button type="button" class="btn btn-primary"
                                                onclick="SettingModule.saveRule(this); return false;">
                                            Lưu
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="soundSetting">
                <div class="row" style="padding-top: 10px;">
                    <div class="col-lg-12 col-sm-12 col-xs-6" id="divSoundSetting">


                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
@section('footer')
    <script src="<?php echo URL::to('/') ?>/client/js/settingModule.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#btnAdd").hide();
            $("#spanError").hide();
            $("#spanError1").hide();
            $("#spanError2").hide();
            SettingModule.loadSoundSetting(null);
        });
    </script>
@stop