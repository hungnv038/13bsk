@extends('admin.layouts.client')
@section('header')
    <title>The Match list</title>
@stop
@section('content')
    <ul class="nav nav-tabs">
        <li class="active"><a href="#A" data-toggle="tab">Section 1</a></li>
        <li><a href="#B" data-toggle="tab">Section 2</a></li>
        <li><a href="#C" data-toggle="tab">Section 3</a></li>
    </ul>
    <div class="tabbable">
        <div class="tab-content">
            <div class="tab-pane active" id="A">
                <p></p>
                <p>I'm in Section A.</p>
            </div>
            <div class="tab-pane" id="B">
                <p>Howdy, I'm in Section B.</p>
            </div>
            <div class="tab-pane" id="C">
                <p>What up girl, this is Section C.</p>
            </div>
        </div>
    </div>
@stop