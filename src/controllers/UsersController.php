<?php

namespace Bubalubs\LaravelGravity\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Bubalubs\LaravelGravity\Page;

class UsersController extends Controller
{
    private $userModel;

    function __construct() {
        $this->userModel = config('auth.providers.users.model');
    }

    public function manage()
    {
        $users = $this->userModel::all();

        return view('laravel-gravity::manage-users')->with(compact(
            'users'
        ));
    }
}
