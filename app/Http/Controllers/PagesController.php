<?php

namespace Helpsmile\Http\Controllers;

use Illuminate\Http\Request;
use Helpsmile\Http\Controllers\Controller;
use Auth;

class PagesController extends Controller
{
    /**
     * Instantiate a new PagesController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['only' => ['getHome','getAbout']]);
    }

    /**
     * Present the home page
     * 
     * @return \Illuminate\Http\Response
     */
    public function getHome()
    {
        if($user = Auth::user())
            return $this->redirectRoute($user->getHomeRoute());
        
        return view('pages.home');
    }

    /**
     * Present the about page
     * 
     * @return \Illuminate\Http\Response
     */
    public function getAbout()
    {
        return view('pages.about');
    }

    /**
     * Present the pricing page
     * 
     * @return \Illuminate\Http\Response
     */
    public function getPricing()
    {
        return view('pages.pricing');
    }

    /**
     * Present the contact page
     * 
     * @return \Illuminate\Http\Response
     */
    public function getContact()
    {
        return view('pages.contact');
    }

    /**
     * Present the support page
     * 
     * @return \Illuminate\Http\Response
     */
    public function getSupport()
    {
        return view('pages.support');
    }
}
