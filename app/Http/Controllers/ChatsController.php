<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Auth\Guard;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Hash;

class ChatsController extends Controller
{
    protected $auth;

    /**
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;

//        $this->middleware('guest', ['except' => 'logout']);
    }

    public function index()
    {
        $user = $this->auth->user();
        return view('chat', ['username' => $user->username]);
    }
}
