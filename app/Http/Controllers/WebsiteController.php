<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    // homepage
    public function index()
    {
        return view('welcome');
    }

    // info page
    public function info()
    {
        return view('frontend.info');
    }

    // customization
    public function customization()
    {
        return view('frontend.customize');
    }

    // signin
    public function signin()
    {
        return view('frontend.signin');
    }

    // signup
    public function signup()
    {
        return view('frontend.signup');
    }

    // uploads
    public function uploadImages()
    {
        return view('frontend.upload');
    }

    // about us
    public function aboutUs()
    {
        return view('frontend.about');
    }

    // testimonial
    public function testimonial()
    {
        return view('frontend.testimonial');
    }

    // image research
    public function imageResearch()
    {
        return view('frontend.imageResearch');
    }






}
