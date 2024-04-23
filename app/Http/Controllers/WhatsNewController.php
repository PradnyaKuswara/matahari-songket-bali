<?php

namespace App\Http\Controllers;

class WhatsNewController extends Controller
{
    public function index()
    {
        return view('pages.whats-new');
    }

    public function detail()
    {
        return view('pages.whats-new-detail');
    }
}
