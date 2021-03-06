<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class WebController extends Controller
{
    public function homePage()
    {
        return view('front.home');
    }

    public function loginPage()
    {        
        if(!session()->has('url.intended'))
        {
            session(['url.intended' => url()->previous()]);
        }
        return view('front.auth.login');
    }

    public function joinPage()
    {
        return view('front.auth.join');
    }
    

    public function showResetForm(Request $request)
    {

    }

    public function profilePage()
    {
        return view('front.pages.my.profile');
    }

    public function editAccountPage()
    {
        return view('front.pages.my.edit-account');
    }

    public function doLogin()
    {
    // validate the info, create rules for the inputs
        $rules = array(
            'email'    => 'required|email', // make sure the email is an actual email
            'password' => 'required|alphaNum|min:3'
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('login')
                ->withErrors($validator) // send back all errors to the login form
                ->withInput(Input::except('password'));
        } else {

            // create our user data for the authentication
            $userdata = array(
                'email'     => Input::get('email'),
                'password'  => Input::get('password')
            );

            // attempt to do the login
            if (Auth::attempt($userdata)) {

                // return Redirect::to('/profile');
                return redirect(session('url.intended'));

            } else {

                // validation not successful, send back to form
                // return Redirect::to('login');
                return Redirect::back()->withErrors('Incorrect email or password');

            }

        }
    }
    public function doLogout()
    {
        Auth::logout();

        return redirect('/login');
    }

    public function myEventsPage()
    {
        return view('front.pages.my.my-events');
    }

    public function myDesignsPage()
    {
        return view('front.pages.my.my-designs');
    }

    // Menu Header Pages
    public function techPage()
    {
        return view('front.pages.cms.tech');
    }

    public function apparelPage()
    {
        return view('front.pages.apparel.apparel');
    }

    public function sponsorsPage()
    {
        return view('front.pages.cms.sponsors');
    }

    public function racesPage()
    {
        return view('front.pages.cms.races');
    }

    public function charityPage()
    {
        return view('front.pages.charities.charity');
    }

    public function designDemo() {
        return view('front.pages.design.designdemo');
    }
}
