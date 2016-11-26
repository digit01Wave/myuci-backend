@extends('layouts.master')

@section('head')
    @parent
    <title>myUCI Register</title>
@stop

@section('content')
    <div class="container">
        <h1>Register</h1>
        <form role="form" method="post" action="{{URL::route('postCreate')}}">
            <div class="form-group{{  $errors->has('username') ? 'has-error':'' }}">
                <label for="username">Username: </label>
                <input id="username" name="username" type="text" class="form-control">
                @if($errors->has('username'))
                    {{ $errors->first('username')}}
                @endif
            </div>
            <div class="form-group{{  $errors->has('email') ? 'has-error':'' }}">
                <label for="email">Email: </label>
                <input id="email" name="email" type="text" class="form-control">
                @if($errors->has('email'))
                    {{ $errors->first('email')}}
                @endif
            </div>
            <div class="form-group{{  $errors->has('pass1') ? 'has-error':'' }}">
                <label for="pass1">Password: </label>
                <input id="pass1" name="pass1" type="password" class="form-control">
                @if($errors->has('pass1'))
                    <?php
                    $errmsg=str_replace('pass1','password',$errors->first('pass1'));
                    echo $errmsg;?>
                @endif
            </div>
            <div class="form-group{{  $errors->has('pass2') ? 'has-error':'' }}">
                <label for="pass2">Confirm Password: </label>
                <input id="pass2" name="pass2" type="password" class="form-control">
                @if($errors->has('pass2'))
                    {{ 'Passwords must match.' }}
                @endif
            </div>
             <!--echo a hidden input field containing a random string of characters used by csrf filter to make sure post comes from page-->
            <div class="form-group">
                <input type="submit" value="Register" class="btn-btn-default">
            </div>
        </form>
    </div>
@stop
