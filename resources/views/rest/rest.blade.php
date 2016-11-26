@extends('layouts.master')

@section('head')
    @parent
    <title>myUCI REST</title>
@stop

@section('content')
<center>
    <h1 class="center_title" id="rest_title">REST</h1>
    <div class="center-list">
        <li><a href="{{URL::route('rest-users')}}">USERS List</a></li>
        <li><a href="{{URL::route('rest-events')}}">Event List</a></li>
        <li><a href="#">Calendar Events</a></li>
        <li><a href="#">Watch Later Events</a></li>
    </div>
</center>
@stop
