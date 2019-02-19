<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Show admin login
     * 
     * @return view
     */
    public function login()
    {
    	return view('admin.pages.login');
    }

    /**
     * Show admin reset password
     * 
     * @return view
     */
    public function resetPassword($token)
    {
    	return view('admin.pages.reset-password',[
            'token' => $token
        ]);
    }

    /**
     * Show admin dashboard
     * 
     * @return view
     */
    public function dashboard()
    {
        return view('admin.pages.dashboard.dashboard', [
            'isAdmin' => Auth::user()->isSuperAdmin(),
            'userId' => Auth::user()->id
        ]);
    }

    /**
     * Show detailed page account
     *
     * @param integer $accountId
     * @return view
     */
    public function dashboardAccount($accountId)
    {
        return view('admin.pages.dashboard.account', [
            'accountId' => $accountId
        ]);
    }

    /**
     * Show detailed page charity
     *
     * @param integer $charityId
     * @return view
     */
    public function dashboardCharity($charityId)
    {
        return view('admin.pages.dashboard.charity', [
            'charityId' => $charityId
        ]);
    }

    /**
     * Show detailed page event
     *
     * @param integer $eventId
     * @return view
     */
    public function dashboardEvent($eventId)
    {
        return view('admin.pages.dashboard.event', [
            'eventId' => $eventId
        ]);
    }
}
