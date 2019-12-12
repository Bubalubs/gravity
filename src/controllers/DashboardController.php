<?php

namespace Bubalubs\Gravity\Controllers;

use Illuminate\Http\Request;
use Bubalubs\Gravity\Page;

class DashboardController extends Controller
{
    public function view()
    {
        return view('gravity::dashboard');
    }
}
