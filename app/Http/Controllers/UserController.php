<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Validator;
use Request;
use Hash;
use Auth;
use App\User;

class UserController extends BaseController
{
    //gets the view for register (sign in) page
    public function getCreate(){
        return view('user.register');
    }

    //get view for login page
    public function getLogin(){
        return view('user.login');
    }

    //performs task when user submits registration form
    public function postCreate(){
        //validates fields
        $validate = Validator::make(Request::all(), [
            'username' => 'required|unique:users|min:4',
            'email' => 'required|Email|unique:users|min:4',
            'pass1' => 'required|min:6',
            'pass2' => 'required|same:pass1',
        ]);

        //if fails, return to page with errors
        if($validate->fails()){
            return redirect()->route('getCreate')->withErrors($validate)->withInput();
        }
        else{
            $user = new User(); //in app/User.php
            $user->username=Request::get('username');
            $user->email = Request::get('email');
            $user->password=\Illuminate\Support\Facades\Hash::make(Request::get('pass1'));

            if($user->save()){
                return redirect()->route('home')->with('success', 'You registered successfully. You can now log in.');
            }
            else{
                //if there was an error with connection to database or laravel
                //built query wrong
                return redirect()->route('home')->with('fail', 'An error occured while creating the user. Please try again.');
            }
        }
    }

    //performs task when user submits login form (validation and redirection)
    public function postLogin(){
        $validator = Validator::make(Request::all(), [
            'username' => 'required',
            'pass1' => 'required'
        ]);

        if($validator->fails()){
            return redirect()->route('getLogin')->withErrors($validator)->withInput();
        }
        else{
            $remember = (Request::has('remember')) ? true:false;

            $auth = Auth::attempt([
                'username' => Request::get('username'),
                'password' => Request::get('pass1')
            ], $remember);

            if($auth){
                return redirect()->intended('/'); //checks if session set with specific route (yes: lets you in page, no:return to homepage)
            }
            else{
                //if username not worked, try email
                $auth = Auth::attempt([
                    'email' => Request::get('username'),
                    'password' => Request::get('pass1')
                ], $remember);
                if($auth){
                    return redirect()->intended('/'); //checks if session set with specific route (yes: lets you in page, no:return to homepage)
                }
                else{
                    return redirect()->route('getLogin')->with('fail', 'You entered the wrong login credentials. Please try again');
                }
            }
        }
    }

    //performs task when user wishes to logout
    public function getLogout(){
        Auth::logout();
        return redirect()->route('home');
    }

}
