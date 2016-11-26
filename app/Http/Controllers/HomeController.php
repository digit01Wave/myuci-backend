<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;

/*
Handles logic for the homepage
*/

class HomeController extends BaseController
{
    //gets the view for home page
    public function getHome(){
        return view('home');
    }
}
