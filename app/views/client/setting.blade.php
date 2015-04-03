@extends('admin.layouts.client')
@section('header')
    <title>Odd Settings</title>
@stop
@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-3 col-xs-12 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Rule types
                                    </div>
                <div class="panel-body">
                    <div class="list-group">
                        <a href="#" class="list-group-item active">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                            Crown 1X2 Odds
                            <span class="badge">14</span>
                        </a>
                        <a href="#" class="list-group-item">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                            Crown Handicap Odds
                            <span class="badge">14</span>
                        </a>
                        <a href="#" class="list-group-item">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                            Crown Over/Under Odds
                            <span class="badge">14</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 col-xs-12 col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Rules
                    <div class="btn-group navbar-right" role="group" aria-label="...">
                        <button type="button" class="btn btn-small btn-sm btn-success" data-toggle="modal" data-target="#myModal"><span class="fa fa-plus"></span> Add New</button>
                    </div>
                </div>
                <div class="panel-body">



                </div>

                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

@stop