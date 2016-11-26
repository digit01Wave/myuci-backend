@extends('layouts.master')

@section('head')
    @parent
    <title>View Users</title>
    <link rel="stylesheet" href="/css/tables.css"/>
@stop

@section('content')

<center>
    <div class="header">
    Android SQLite and MySQL Sync - View Events
    </div>
</center>

@if(count($events)!=0)
<table>
    <tr id="header"><td>Id</td><td>Event Title</td><td>Hoster</td><td>Start Time</td>
    <td>End Time</td><td>Latitude</td><td>Longitude</td><td>Location</td><td>
    Description</td><td>Link</td><td>Image Link</td><td>Source Type</td><td>Source Subtype</td><td>Last Updated</td></tr>
    @foreach($events as $event)
        <tr>
        <td><span>{{$event->event_id }}</span></td>
        <td><span>{{$event->title }}</span></td>
        <td><span>{{$event->hoster }}</span></td>
        <td><span>{{$event->start_time }}</span></td>
        <td><span>{{$event->end_time }}</span></td>
        <td><span>{{$event->lat }}</span></td>
        <td><span>{{$event->lng }}</span></td>
        <td><span>{{$event->location }}</span></td>
        <td><span>{{$event->description }}</span></td>
        <td><span>{{$event->link }}</span></td>
        <td><span>{{$event->image_link }}</span></td>
        <td><span>{{$event->source_type }}</span></td>
        <td><span>{{$event->source_subtype }}</span></td>
        <td><span>{{$event->last_updated }}</span></td>
        </tr>
    @endforeach
</table>
@else
<div id="norecord">
    No records in MySQL DB
</div>
@endif

@stop
