<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;

use App\UciEvents;
use Illuminate\Support\Facades\DB;
/*
Handles logic for the homepage
*/

class RestController extends BaseController
{
    //gets the view for page containing links to many REST pages
    public function getRest(){
        return view('rest.rest');
    }

    //get JSON for users
    public function getUsersJSON(){
        $a = DB::table('users')->select('id', 'email');
        return response()-> json($a);
    }

    //get JSON for events given last updated
    public function oldGetEventsJSON(){
        $events = DB::table('uci_events')->select('event_id', 'title', 'start_time', 'end_time', 'lat', 'lon', 'location', 'description', 'link', 'image_link', 'source_type', 'source_subtype')->get();
        return response()->json($events);
    }

    //get JSON for events given last updated
    //if no last updated, just assume we want everything
    public function getEventsJSON($date_data){
        $date = json_decode($date_data);
        $events = DB::table('uci_events')->select('event_id', 'title', 'start_time', 'end_time', 'lat', 'lon', 'location', 'description', 'link', 'image_link', 'source_type', 'source_subtype')->where('last_updated','>', $date->last_updated)->get();
        return response()->json($events);
    }
}
