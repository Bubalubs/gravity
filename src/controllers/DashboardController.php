<?php

namespace Bubalubs\LaravelGravity\Controllers;

use Illuminate\Http\Request;
use Bubalubs\LaravelGravity\Page;

class DashboardController extends Controller
{
    public function view()
    {
        return view('laravel-gravity::dashboard');
    }
}
