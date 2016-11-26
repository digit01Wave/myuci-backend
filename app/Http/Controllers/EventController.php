<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;

use App\UciEvents;

/*
Handles logic for the homepage
*/

class EventController extends BaseController
{
    //gets the view for event page
    public function getEvents(){
        $events = UciEvents::all();
        return view('event.events')->with('events', $events);
    }
}
