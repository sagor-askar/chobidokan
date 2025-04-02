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
        return view('frontend.menu.info');
    }

    // customization
    public function customization()
    {
        return view('frontend.menu.customize');
    }

    // signin
    public function signin()
    {
        return view('frontend.auth.signin');
    }

    // signup
    public function signup()
    {
        return view('frontend.auth.signup');
    }

    // uploads
    public function uploadImages()
    {
        return view('frontend.menu.upload');
    }

    // about us
    public function aboutUs()
    {
        return view('frontend.footer.about');
    }

    // testimonial
    public function testimonial()
    {
        return view('frontend.footer.testimonial');
    }

    // image research
    public function imageResearch()
    {
        return view('frontend.footer.imageResearch');
    }

    // pricing table
    public function pricingTable()
    {
        return view('frontend.footer.pricing');
    }

    // licencing
    public function licenceInfo()
    {
        return view('frontend.footer.licencing');
    }

    // terms of use 
    public function termsofUse()
    {
        return view('frontend.footer.termsofuse');
    }

    // privacy policy
    public function privacyPolicy()
    {
        return view('frontend.footer.privacypolicy');
    }

    // contact us
    public function contactUs()
    {
        return view('frontend.footer.contact');
    }

    // search tips
    public function searchTips()
    {
        return view('frontend.footer.searchtips');
    }

    // faq 
    public function faqs()
    {
        return view('frontend.footer.faq');
    }

    // technicals
    public function technicals()
    {
        return view('frontend.footer.technical');
    }

}
