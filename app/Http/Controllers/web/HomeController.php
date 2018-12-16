<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show home page
     *
     * @return string
     */
    public function homePage() {

        return 'Home Page ... !';
    }

    /**
     * Get login page
     */
    public function getLogin() {

    }

    /**
     * Login user
     */
    public function postLogin(Request $request) {

    }
}