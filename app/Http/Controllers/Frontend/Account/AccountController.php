<?php


namespace App\Http\Controllers\Frontend\Account;


use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class AccountController extends Controller
{
    /**
     * @return View
     */
    public function dashboard()
    {
        return view('frontend.account.dashboard', [

        ]);
    }

    /**
     * @return View
     */
    public function garage()
    {
        return view('frontend.account.garage', [

        ]);
    }

    /**
     * @return View
     */
    public function orders()
    {
        return view('frontend.account.orders', [

        ]);
    }

    /**
     * @return View
     */
    public function profile()
    {
        return view('frontend.account.profile', [

        ]);
    }

    /**
     * @return View
     */
    public function password()
    {
        return view('frontend.account.password', [

        ]);
    }
}
