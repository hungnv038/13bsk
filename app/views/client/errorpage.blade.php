@extends('admin.layouts.client')
@section('header')
    <title>Error</title>
@stop
@section('content')
    <h1 style="width: 100%;text-align: center">Oops, Error!</h1>
    <h4 style="width: 100%; text-align: center;color: red">
        {{$error_text}}
    </h4>
@stop