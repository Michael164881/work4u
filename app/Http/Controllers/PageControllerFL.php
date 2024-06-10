<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageControllerFL extends Controller
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
        if (view()->exists("freelancer.pages.{$page}")) {
            return view("freelancer.pages.{$page}");
        }

        return abort(404);
    }
}
