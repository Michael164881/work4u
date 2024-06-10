<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageControllerCust extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display all the static pages when authenticated
     *
     * @param string $page
     * @return \Illuminate\View\View
     */
    public function index(string $page)
    {
        if (view()->exists("customer.pages.{$page}")) {
            return view("customer.pages.{$page}");
        }

        return abort(404);
    }
}
