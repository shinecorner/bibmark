<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FooterPageController extends Controller
{
    
    public function storyPage() {
        return view('front.pages.cms.story');
    }

    public function contactPage() {
        return view('front.pages.contact.contact');
    }

    public function pressPage() {
        return view('front.pages.press.press');
    }

    public function blogPage() {
        return view('front.pages.blog.blog');
    }

    public function termsPrivacyPage() {
        return view('front.pages.cms.terms-privacy');
    }

    public function sizingPage() {
        return view('front.pages.cms.sizing');
    }

    public function groupOrdersPage() {
        return view('front.pages.cms.group-orders');
    }

    public function ShippingDeliveryPage() {
        return view('front.pages.Shipping-delivery');
    }

    public function partnershipsPage() {
        return view('front.pages.cms.partnerships');
    }

    public function socialResponsibilityPage() {
        return view('front.pages.cms.social-responsibility');
    }
}
