<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FooterPageController extends Controller
{
    
    public function storyPage() {
        return view('front.pages.story');
    }

    public function contactPage() {
        return view('front.pages.contact');
    }

    public function pressPage() {
        return view('front.pages.press');
    }

    public function blogPage() {
        return view('front.pages.blog');
    }

    public function termsPrivacyPage() {
        return view('front.pages.terms-privacy');
    }

    public function sizingPage() {
        return view('front.pages.sizing');
    }

    public function groupOrdersPage() {
        return view('front.pages.group-orders');
    }

    public function ShippingDeliveryPage() {
        return view('front.pages.Shipping-delivery');
    }

    public function partnershipsPage() {
        return view('front.pages.partnerships');
    }

    public function socialResponsibilityPage() {
        return view('front.pages.social-responsibility');
    }
}
