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

    // pricing table
    public function pricingTable()
    {
        return view('frontend.pricing');
    }

    // licencing
    public function licenceInfo()
    {
        return view('frontend.licencing');
    }

    // terms of use 
    public function termsofUse()
    {
        return view('frontend.termsofuse');
    }

    // privacy policy
    public function privacyPolicy()
    {
        return view('frontend.privacypolicy');
    }

    // contact us
    public function contactUs()
    {
        return view('frontend.contact');
    }

    // search tips
    public function searchTips()
    {
        return view('frontend.searchtips');
    }

    // faq 
    public function faqs()
    {
        return view('frontend.faq');
    }

    // technicals
    public function technicals()
    {
        return view('frontend.technical');
    }

}
